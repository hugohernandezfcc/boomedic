<?php 
namespace App\Http\Controllers;
use ZipArchive;
use RarArchive;
use Aws\S3\S3Client;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use League\Flysystem\Filesystem;
use Illuminate\Support\Facades\Storage;

//Class where extract attachment of email pop3 domain
class ImapPop3 extends Controller {
	
	public function __construct() {

	}

	public function connect($host, $port, $email, $pass){
		$imbox = imap_open("{". $host .":".$port."/pop3/novalidate-cert}INBOX", $email, $pass) or die('Cannot connect to Gmail: ' . imap_last_error());
		return $imbox;
	}

	public function count($imbox){
	    if ($hdr = imap_check($imbox)) 
		    {
		    	//Number mails in imbox
		        $msgCount = $hdr->Nmsgs;
		        return 'Mensajes recibidos: ' . $msgCount;
		    }
	    else 
		    {
		        return "Failed to get mail";
		    }
	}

	public function attachment($imbox, $user){
			$emails = imap_search($imbox, 'ALL', SE_UID);
						        $array = array();

		/* if any emails found, iterate through each email */
		if($emails) {

		    $count = 1;

		    /* put the newest emails on top */
		    rsort($emails);

			    /* for every email... */
			    foreach($emails as $email_number) 
			    {
			        /* get information specific to this email */
			        $header = imap_headerinfo($imbox, $email_number);
			        $emailFrom = $header->from[0]->mailbox . '@' . $header->from[0]->host;
			        $subject = $header->subject;
			        $date = $header->date;
			        //int_r($cabecera->from[0]->mailbox . '@' . $cabecera->from[0]->host);
			        $overview = imap_fetch_overview($imbox,$email_number,0);
			        $message2 = imap_fetchbody($imbox,$email_number,1.2);
			        $message = imap_fetchbody($imbox,$email_number,2);
			        $body = imap_fetchbody($imbox,$email_number,1);
			        /* get mail structure */
			        $structure = imap_fetchstructure($imbox, $email_number);
			        $attachments = array();

			        /* if any attachments found... */
			        if(isset($structure->parts) && count($structure->parts)) 
			        {
			            for($i = 0; $i < count($structure->parts); $i++) 
			            {
			                $attachments[$i] = array(
			                    'is_attachment' => false,
			                    'filename' => '',
			                    'name' => '',
			                    'attachment' => ''
			                );

			                if($structure->parts[$i]->ifdparameters) 
			                {
			                    foreach($structure->parts[$i]->dparameters as $object) 
			                    {
			                        if(strtolower($object->attribute) == 'filename') 
			                        {
			                            $attachments[$i]['is_attachment'] = true;
			                            $attachments[$i]['filename'] = $object->value;
			                        }
			                    }
			                }

			                if($structure->parts[$i]->ifparameters) 
			                {
			                    foreach($structure->parts[$i]->parameters as $object) 
			                    {
			                        if(strtolower($object->attribute) == 'name') 
			                        {
			                            $attachments[$i]['is_attachment'] = true;
			                            $attachments[$i]['name'] = $object->value;
			                        }
			                    }
			                }

			                if($attachments[$i]['is_attachment']) 
			                {
			                    $attachments[$i]['attachment'] = imap_fetchbody($imbox, $email_number, $i+1);

			                    /* 3 = BASE64 encoding */
			                    if($structure->parts[$i]->encoding == 3) 
			                    { 
			                        $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
			                    }
			                    /* 4 = QUOTED-PRINTABLE encoding */
			                    elseif($structure->parts[$i]->encoding == 4) 
			                    { 
			                        $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
			                    }
			                }
			            }
			        }

			        /* iterate through each attachment and save it */

			        foreach($attachments as $attachment)
			        {
			            if($attachment['is_attachment'] == 1)
			            {

			                $filename = $attachment['name'];
			                if(empty($filename)) $filename = $attachment['filename'];

			                if(empty($filename)) $filename = time() . ".dat";

			                $name = "imbox/". $user ."-". $date. "-". $emailFrom. "/" .$filename;
			                Storage::disk('s3')->put($name,  (string) $attachment['attachment'], 'public');
					        $path = Storage::cloud()->url($name);
					        array_push($array, ['path' => $path, 'filename' => $filename, 'from' =>  $emailFrom, 'subject' => $subject, 'message' => $message2, 'date' => $date, 'header' => $header, 'structure' => $structure, 'body' => $body]);
			            }
			        }
			    }
			} 
			/* close the connection */
			imap_close($imbox);
			return $array;

	}

}

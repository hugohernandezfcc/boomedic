<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use \PDF;


class medicalPrescription extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
       
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('medicalPrescription', [
                'userId'    => Auth::id(),
                'username'  => DB::table('users')->where('id', Auth::id() )->value('name'),
                'mode'      => 'Index'
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    public function redirecting($page)
    {
        switch ($page) {
            case 'index':
                return redirect('medicalPrescription/index'); //show
                break;
            
            default:
                return redirect('/medicalconsultations'); //medicalconsultations
                break;
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

   
    }


        public function PDFGenerator (Request $request){

            /* Cuerpo del Xml CFDI de petición */
$cfd = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<cfdi:Comprobante LugarExpedicion="CIUDAD DE MEXICO - D.F." metodoDePago="NO IDENTIFICADO"
  tipoDeComprobante="egreso" total="208197.77" Moneda="MXP" TipoCambio="1.0000" subTotal="208197.77"
  condicionesDePago="PAGO EN UNA SOLA EXHIBICION"
  certificado="MIIEdDCCA1ygAwIBAgIUMjAwMDEwMDAwMDAxMDAwMDU4NjcwDQYJKoZIhvcNAQEFBQAwggFvMRgwFgYDVQQDDA9BLkMuIGRlIHBydWViYXMxLzAtBgNVBAoMJlNlcnZpY2lvIGRlIEFkbWluaXN0cmFjacOzbiBUcmlidXRhcmlhMTgwNgYDVQQLDC9BZG1pbmlzdHJhY2nDs24gZGUgU2VndXJpZGFkIGRlIGxhIEluZm9ybWFjacOzbjEpMCcGCSqGSIb3DQEJARYaYXNpc25ldEBwcnVlYmFzLnNhdC5nb2IubXgxJjAkBgNVBAkMHUF2LiBIaWRhbGdvIDc3LCBDb2wuIEd1ZXJyZXJvMQ4wDAYDVQQRDAUwNjMwMDELMAkGA1UEBhMCTVgxGTAXBgNVBAgMEERpc3RyaXRvIEZlZGVyYWwxEjAQBgNVBAcMCUNveW9hY8OhbjEVMBMGA1UELRMMU0FUOTcwNzAxTk4zMTIwMAYJKoZIhvcNAQkCDCNSZXNwb25zYWJsZTogSMOpY3RvciBPcm5lbGFzIEFyY2lnYTAeFw0xMjA3MjcxNzAyMDBaFw0xNjA3MjcxNzAyMDBaMIHbMSkwJwYDVQQDEyBBQ0NFTSBTRVJWSUNJT1MgRU1QUkVTQVJJQUxFUyBTQzEpMCcGA1UEKRMgQUNDRU0gU0VSVklDSU9TIEVNUFJFU0FSSUFMRVMgU0MxKTAnBgNVBAoTIEFDQ0VNIFNFUlZJQ0lPUyBFTVBSRVNBUklBTEVTIFNDMSUwIwYDVQQtExxBQUEwMTAxMDFBQUEgLyBIRUdUNzYxMDAzNFMyMR4wHAYDVQQFExUgLyBIRUdUNzYxMDAzTURGUk5OMDkxETAPBgNVBAsTCFVuaWRhZCAxMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC2TTQSPONBOVxpXv9wLYo8jezBrb34i/tLx8jGdtyy27BcesOav2c1NS/Gdv10u9SkWtwdy34uRAVe7H0a3VMRLHAkvp2qMCHaZc4T8k47Jtb9wrOEh/XFS8LgT4y5OQYo6civfXXdlvxWU/gdM/e6I2lg6FGorP8H4GPAJ/qCNwIDAQABox0wGzAMBgNVHRMBAf8EAjAAMAsGA1UdDwQEAwIGwDANBgkqhkiG9w0BAQUFAAOCAQEATxMecTpMbdhSHo6KVUg4QVF4Op2IBhiMaOrtrXBdJgzGotUFcJgdBCMjtTZXSlq1S4DG1jr8p4NzQlzxsdTxaB8nSKJ4KEMgIT7E62xRUj15jI49qFz7f2uMttZLNThipunsN/NF1XtvESMTDwQFvas/Ugig6qwEfSZc0MDxMpKLEkEePmQwtZD+zXFSMVa6hmOu4M+FzGiRXbj4YJXn9Myjd8xbL/c+9UIcrYoZskxDvMxc6/6M3rNNDY3OFhBK+V/sPMzWWGt8S1yjmtPfXgFs1t65AZ2hcTwTAuHrKwDatJ1ZPfa482ZBROAAX1waz7WwXp0gso7sDCm2/yUVww=="
  noCertificado="20001000000100005867" formaDePago="CONTADO"
  sello=""
  fecha="2014-08-18T11:11:59" folio="1" serie="EDR" version="3.2"
  xsi:schemaLocation="http://www.buzonfiscal.com/ns/addenda/bf/2 http://www.buzonfiscal.com/schema/xsd/Addenda_BF_v20.xsd http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv32.xsd http://www.sat.gob.mx/consumodecombustibles http://www.sat.gob.mx/sitio_internet/cfd/consumodecombustibles/consumodecombustibles.xsd"
  xmlns:bfa2="http://www.buzonfiscal.com/ns/addenda/bf/2" xmlns:cfdi="http://www.sat.gob.mx/cfd/3"
  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
  xmlns:consumodecombustibles="http://www.sat.gob.mx/consumodecombustibles">
  <cfdi:Emisor nombre="EMISOR DEMO S.A. DE C.V." rfc="AAA010101AAA">
    <cfdi:DomicilioFiscal codigoPostal="64000" pais="México" estado="Nuevo León"
      municipio="Monterrey" colonia="Centro" noInterior="4to Piso" noExterior="1921"
      calle="Diego Rivera"/>
    <cfdi:RegimenFiscal Regimen="Regimen General de Ley Personas Morales"/>
  </cfdi:Emisor>
  <cfdi:Receptor nombre="EMPRESA RECEPTORA S.A." rfc="BBB010101BBB">
    <cfdi:Domicilio codigoPostal="64000" pais="México" estado="Nuevo León"
      municipio="San Pedro Garza García" colonia="Magistrales" noInterior="3C" noExterior="1432"
      calle="Insurgentes"/>
  </cfdi:Receptor>
  <cfdi:Conceptos>
    <cfdi:Concepto importe="0.00" valorUnitario="0.00" descripcion="COMBUSTIBLE"
      unidad="PZA" cantidad="1"/>
  </cfdi:Conceptos>
  <cfdi:Impuestos totalImpuestosTrasladados="0.00">
    <cfdi:Traslados>
      <cfdi:Traslado importe="0.00" tasa="16" impuesto="IVA"/>
    </cfdi:Traslados>
  </cfdi:Impuestos>
</cfdi:Comprobante>
EOF;
            /* Petición al Pac de facturación */

                            $request_options = array(
                              'http' => array(
                                'method' => "POST",
                                'header' => "Content-Type: text/xml\r\n"."x-auth-token: ABCD1234\r\n",
                                'content' => $cfd,
                                'ignore_errors' => true

                            ));
                            $stream_context = stream_context_create($request_options);
                            $response = file_get_contents('https://staging.diverza.com/issue', false, $stream_context);
                            $response_code = $http_response_header[0];
                            $stamp = $response;

        $data =  array(
                        'medico' => $request->medico,
                        'response' => $response_code,
                        'stamp'  => $stamp
                    ); 

        $pdf = \PDF::loadView('medicalPrescriptionPDF', $data);
        return $pdf->stream('RESULT.pdf');
 
}
}
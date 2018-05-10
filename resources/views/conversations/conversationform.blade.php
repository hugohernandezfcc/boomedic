<style type="text/css">
  .box.box-warning {
    border-top-color: #0e0e0e !important;
}
.direct-chat-warning .right>.direct-chat-text {
    background: #000000;
    border-color: #000000;
    color: #fff;
}
.direct-chat-warning .right>.direct-chat-text:after, .direct-chat-warning .right>.direct-chat-text:before {
    border-left-color: #000000 !important;
}
</style>


              <!-- DIRECT CHAT -->
              <div class="box box-warning direct-chat direct-chat-warning">
                <div class="box-header with-border">
                  <h3 class="box-title"></h3>

                  <div class="box-tools pull-right">
                    <span data-toggle="tooltip" title="" class="badge bg-black" data-original-title="" id="count"></span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="Contacts" id="contacts">
                      <i class="fa fa-comments"></i></button>
                  </div>
                  <input type="hidden" id="userOrDr" value="1">
                  <input type="hidden" id="mid" value="">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <!-- Conversations are loaded here -->
                  <div class="direct-chat-messages" id="message">


                  </div>
                  <!--/.direct-chat-messages-->

                  <!-- Contacts are loaded here -->
                  <div class="direct-chat-contacts">
                    <ul class="contacts-list">
                      <li>
                        <a href="#">
                          <img class="contacts-list-img" src="https://s3.amazonaws.com/abiliasf/profile-42914_640.png" alt="User Image">

                          <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                  Count Dracula
                                  <small class="contacts-list-date pull-right">2/28/2015</small>
                                </span>
                            <span class="contacts-list-msg">How have you been? I was...</span>
                          </div>
                          <!-- /.contacts-list-info -->
                        </a>
                      </li>
                      <!-- End Contact Item -->

                    </ul>
                    <!-- /.contatcts-list -->
                  </div>
                  <!-- /.direct-chat-pane -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <form action="#" method="post">
                    <div class="input-group">
                      <input type="text" name="message" placeholder="Escriba su mensaje..." class="form-control textbody" autocomplete="off">
                      <span class="input-group-btn">
                            <button type="button" class="btn btn-secondary btn-flat" onclick="send();">Enviar</button>
                          </span>
                    </div>
                  </form>
                </div>
                <!-- /.box-footer-->
              </div>
              <!--/.direct-chat -->



<script type="text/javascript">
     $(function(){
             $.ajax({
                type: "GET",    
                url: "{{ url('Conversations/messages') }}", 
                success: function(result){
                  console.log(result[0].length);
                  console.log(result[1].length);
                  if(result[1].length == 0){
                    $("#contacts").css("display", "none");
                    $("#userOrDr").val(result[1].length);
                  }
                  if(result[0].length == 0){
                    $("#count").html("0");
                    $("#count").attr("data-original-title", "0 mensajes");
                    $(".direct-chat-messages").text('');
                    $(".direct-chat-messages").append('<div align="center">No se ha empezado ninguna conversación</div>');
                  }
                  else{
                   for(var z = 0; z < result[0].length; z++){ 
                      $(".direct-chat-messages").append('<div class="direct-chat-msg right"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-right">'+ result[0][z]['name'] +'</span><span class="direct-chat-timestamp pull-left">23 Jan 6:10 pm</span></div><img class="direct-chat-img" src="'+ result[0][z]['profile_photo'] +'" alt="Imagen de usuario"><div class="direct-chat-text">'+ result[0][z]['text_body'] +'</div></div>');
                      $("#mid").val(result[0][z]['id_record']);
                     }
                     count();
                    }
                }
              });
  function count(){
     var count = $("#message .direct-chat-msg.right").length;
     $("#count").html(count);
         if(count == 1){
             $("#count").attr("data-original-title", count + " nuevo mensaje");
               } 
         else{
              $("#count").attr("data-original-title", count + " nuevos mensajes");
            }
          }
     })

     function send(){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    //Valido para saber de que página envía los datos y si es paciente o doctor
                    if(window.location.href == "{{ url('clinicHistory/index') }}"){
                    var data = { 
                                  "doc"       : $(".in .middr").val(),
                                  "table"     : $(".in .mtable").val(),
                                  "id_record" : $(".in .midfield").val(),
                                  "name_mess" : $(".in .mname").val(),
                                  "textbody"  : $(".in .textbody").val()
                                };
                                console.log(data);
                              }else {
                             var data = { 
                                  "id_record" : $("#mid").val(),
                                  "textbody"  : $(".textbody").val()
                                };
                              }
                    //fin validación y datos          
                           $.ajax({     
                             type: "POST",                 
                             url: "{{ url('Conversations/sendMessages') }}",  
                              data: data, 
                              dataType: 'json',                
                             success: function(result)             
                             {
                            console.log(result);
                              for(var z = 0; z < result.length; z++){ 
                                $(".direct-chat-messages").append('<div class="direct-chat-msg right"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-right">Sarah Bullock</span><span class="direct-chat-timestamp pull-left">23 Jan 6:10 pm</span></div><img class="direct-chat-img" src="'+ result[z]['profile_photo'] +'" alt="message user image"><div class="direct-chat-text">'+ result[z]['text_body'] +'</div></div>');
                               }
                              }
                         });
     }
</script>          

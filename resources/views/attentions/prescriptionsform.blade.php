<style type="text/css">
   @if(!$isMobile)
      .modal-dialog {
         width: 90%;
         margin: 30px auto;
      }
   @endif

   .progress-bar {
      background-color: #3E3E3E;
   }
</style>

<input type="hidden" id="load-medicines" value="" />

<div class="modal fade" id="prescription-form-modal">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"> <i class="fa fa-edit"></i> Receta médica</h4>
         </div>
         <div class="modal-body">

            <div class="row">
               
               <div class="col-md-6">
                  <div style="padding: 3px;">
                     <select class="form-control" id="currentMedicalAppointment" style="width: 100%;">
                        @if(count($medAppointments) == 0)
                           
                           <option value="notUserSelected"> -- No hay citas para prescribit -- </option>

                        @else

                           @foreach($medAppointments as $medApp)
                              <option value="{{$medApp->user}}">
                                 {{$medApp->firstname}} {{$medApp->lastname}} / {{ trans('adminlte::adminlte.' . $medApp->gender) }}  / {{$medApp->age}} años 
                              </option>
                           @endforeach

                        @endif
                     </select>
                  </div>
               </div>

               <div class="col-md-6">
                  <div style="padding: 3px;">
                     <div class="progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="5" style="width: 50%;"> 50% </div>
                  </div>
               </div>

            </div>
            <br />
            <div class="row">
               <div class="col-md-12">
                  
                  <div id="wizardPrescription">
                     <h3>Receta </h3>
                     <section>
                           <!-- The validation is to change the cols number in textarea -->
                           <div class="form-group">
                              @if($isMobile)
                                 <textarea class="form-control" id="receta" rows="10" cols="33" placeholder="Describe la prescripción médica ..."></textarea>
                              @else
                                 <textarea class="form-control" id="receta" rows="10" cols="30" placeholder="Describe la prescripción médica ..."></textarea>
                              @endif
                           </div>
                     </section>
                     <h3>PDF </h3>
                     <section>
                           <p>The next and previous buttons help you to navigate through your content.</p>
                     </section>
                     
                  </div>

                  
               </div>
            </div>
            <script type="text/javascript">

               var words = [];
               var medicinesSelected = [];

              $(document).ready(function(){
                  jQuery.noConflict(false);

                  $("#wizardPrescription").steps({
                        headerTag: "h3",
                        bodyTag: "section",
                        transitionEffect: "slideLeft",
                        cssClass: "wizard",
                        autoFocus: true,
                        labels: {
                           pagination: "Paginación",
                           finish:     "Terminar",
                           next:       "Revisar",
                           previous:   "Redactar",
                           loading:    "Cargando"
                        },
                        showFinishButtonAlways: true,
                        onStepChanged: function (event, currentIndex, priorIndex) { 

                           console.log(currentIndex); // 1
                           console.log(priorIndex); // 0
                        },
                        onFinished: function (event, currentIndex) { 
                           console.log('terminado...' + event);
                           console.log('terminado...' + currentIndex);
                        }

                     });
                  

                  $('#currentMedicalAppointment').select2({ width: "100%" });

                  var getLinks = document.getElementsByTagName('a');
                  for (var i = getLinks.length - 1; i >= 0; i--) {

                     console.log(getLinks[i].href);

                     if(getLinks[i].href == "#finish"){
                        getLinks[i].setAttribute('id', "linkfinish");
                        console.log('entre');
                     }
                  }

                  document.getElementById('linkfinish').parentNode.setAttribute('id', "optionlinkfinish");
                  document.getElementById('optionlinkfinish').className = "disabled";
                  

               });
              
               function loadMedicines() {
                  if (document.getElementById('load-medicines').value == "") {

                     $.ajax({
                        method: "get",
                        url: "{{ url('prescriptions/medicinescatalogue')}}",
                        success: function( data ){
                           console.log('Submission was success.');
                           medicinesSelected = data;
                           
                           $.map(data, function (word) {
                              words.push(word.name);
                           });

                           $.map(medicinesSelected, function (word) { 
                              medicinesSelected[word.name] = word.medicine; 
                           });

                           console.log(medicinesSelected);
                           document.getElementById('load-medicines').value = true;

                           $('#receta').textcomplete([{
                              match: /(^|\b)(\w{2,})$/,
                              search: function (term, callback) {
                                 
                                 callback(
                                    $.map(words, function (word) {
                                       document.getElementById('textcomplete-dropdown-1').style.zIndex = "1100";

                                       if(word.indexOf(term) === 0){
                                          return word;
                                       }else
                                          return null;
                                    }
                                 ));
                              }, replace: function (word) {
                                 console.log('word selected: '+ word);
                                 return word + ' ';
                              }
                           }]);

                        }, error: function( data ){
                           console.log('Submission was error.');
                           console.log(data);

                           if(data.error == "Unauthenticated.")
                              window.location.href = "{{ url('/login') }}";
                           
                        }
                     });
                  }
               }               
            </script>
         </div>
         <!-- <div class="modal-footer">
            <div class="row">
               <div class="col-md-6">
               </div>
               <div class="col-md-6">
                  <a href="#next" role="menuitem" ></a>
               </div>
            </div>
            
         </div> -->
      </div>
   </div>
</div>


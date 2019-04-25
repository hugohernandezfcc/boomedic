@extends('adminlte::page')

@section('title', 'Boomedic')

<style type="text/css">

    .morris-hover.morris-default-style {
      background: rgba(84, 84, 84, 0.8)  !important;
      border: none !important; 
    }
    .morris-hover-row-label{
      color: black !important;
    }

</style>

@section('content')

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>



  	<div class="box-header">
	    <h3 class="box-title">Reportes</h3>
  	</div>
  	<div class="box-body">
      <section class="connectedSortable ui-sortable col-md-12">
        @php
        $r = json_decode($report);
        @endphp
  			<div class="box box-secondary">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Polígono de Enfermedades</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-secondary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body border-radius-none">
         @if(count($r) > 0)
              <div class="chart" id="line-chart" style="height: 250px;"></div>
          @else
                   No hay diagnósticos registrados aún, por tanto no se puede generar la gráfica
          @endif
            </div>
            <!-- /.box-body -->
            
            <!-- /.box-footer -->
          </div>

        </section>
            <!-- /.box-footer -->
      <section class="connectedSortable ui-sortable col-md-6">
         <div class="box box-secondary">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Pacientes por género</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-default btn-sm" onclick="changeGender();"><i class="fa fa-bar-chart gendericon"></i>
                </button>
                <button type="button" class="btn btn-secondary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body border-radius-none">
            <canvas id="myChart" class="chartjs" style="height: 250px;"></canvas>
            </div>
          </div>
        </section>

                    <!-- /.box-footer -->
      <section class="connectedSortable ui-sortable col-md-6">
         <div class="box box-secondary">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Pacientes por edades</h3>

              <div class="box-tools pull-right">
               <button type="button" class="btn btn-default btn-sm" onclick="changeAges();"><i class="fa fa-pie-chart ageicon"></i>
                </button>
                <button type="button" class="btn btn-secondary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>

              </div>
            </div>
            <div class="box-body border-radius-none">
            <canvas id="myChart2" class="chartjs" style="height: 250px;"></canvas>

            <!-- /.box-body -->
            
            <!-- /.box-footer -->
          </div>
        </div>
       </section>   
      <section class="connectedSortable ui-sortable col-md-6">
         <div class="box box-secondary">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Citas</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-default btn-sm" onclick="changeAppo();"><i class="fa fa-bar-chart appoicon"></i>
                </button>
                <button type="button" class="btn btn-secondary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body border-radius-none">
            <canvas id="myChartAppointments" class="chartjs" style="height: 250px;"></canvas>
            </div>
          </div>
        </section>
      <section class="connectedSortable ui-sortable col-md-6">
         <div class="box box-secondary">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Saldos</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-default btn-sm" onclick="changeBalance();"><i class="fa fa-bar-chart balicon"></i>
                </button>
                <button type="button" class="btn btn-secondary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body border-radius-none">
            <canvas id="myChartBalance" class="chartjs" style="height: 250px;"></canvas>
            </div>
      </div> 
      </section> 
      <section class="connectedSortable ui-sortable col-md-6">
         <div class="box box-secondary">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Citas por consultorios</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-default btn-sm" onclick="changeWorkplace();"><i class="fa fa-bar-chart workicon"></i>
                </button>
                <button type="button" class="btn btn-secondary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body border-radius-none">
            <canvas id="myChartWorkplace" class="chartjs" style="height: 250px;"></canvas>
            </div>
          </div>
        </section> 
  </div>

<script type="text/javascript">
	

          var dis = @php echo $dis; @endphp;
          var fem = @php echo $fem; @endphp;
          var mas = @php echo $mas; @endphp;
          var oth = @php echo $oth; @endphp;
          var age = @php echo $arrayA; @endphp;
          var count = @php echo $count; @endphp;
          var appointments = @php echo $arrayAppo; @endphp;
          var countAppo = @php echo $countAppo; @endphp;
          var balancedates = @php echo $balancedates; @endphp;
          var balance = @php echo $balances; @endphp;
          var report = @php echo $report; @endphp;
          var workplaces = @php echo $workplaces; @endphp;
          var places = @php echo $places; @endphp;         
          var arrayBalance = [0,0];
          var arrayworkplace = [0,0];
          var title = '0';

                     function colorRandom(){
                            var value = Math.random() * 0xFF | 0;
                            var grayscale = (value << 16) | (value << 8) | value;
                            var color = '#' + grayscale.toString(16);
                            return color;      
                        }


          var arraycolorAge = Array();
              for(var x = 0; x < count.length; x++){
                       arraycolorAge.push(colorRandom());
                    }

          var arraycolorAppo = Array();
              for(var z = 0; z < countAppo.length; z++){
                       arraycolorAppo.push(colorRandom());
                    }   

          var arraycolorWork = Array();
              for(var z = 0; z < places.length; z++){
                       arraycolorWork.push(colorRandom());
                    }   
 
            /*Balance*/
            if(balance.length > 0){

                            arrayBalance = Array();
                            var countOwed = 0;
                            var countPaid = 0;
                                for(var z=0; z < balance.length; z++){
                             
                                                if(balance[z]['type_doctor'] == 'Owed'){
                                                      var mount = balance[z]['amount'];
                                                      countOwed = parseFloat(countOwed) + parseFloat(mount); 
                                                }

                                                if(balance[z]['type_doctor'] == 'Paid'){
                                                      var mountpaid = balance[z]['amount'];
                                                      countPaid = parseFloat(countPaid) + parseFloat(mountpaid);
                                                }
                                      }

                            arrayBalance.push(countPaid.toFixed(2));
                            arrayBalance.push(countOwed.toFixed(2));

                            if(countPaid > countOwed)
                                  title = '$' + countPaid.toFixed(2) +' Pagado';
                            else 
                                  title = '$' + countOwed.toFixed(2) +' Pendiente';    
            }
            /*Workplace*/
            if(workplaces.length > 0){

                            arrayworkplace = Array();
                              for(var pl = 0; pl < places.length; pl++){
                                  var variable = {};
                                   variable[pl] = 0;
                                    for(var w=0; w < workplaces.length; w++){
                                                    if(workplaces[w]['place'] == places[pl]){
                                                        variable[pl]  = parseFloat(variable[pl]) + 1;
                                                    }
                                          }
                                    arrayworkplace.push(variable[pl]);       
                              }
                              console.log(arrayworkplace);
            }            



              /********** Diagnostics  ********s*/

              if(report.length > 0){
                        var months = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];

                          var line = new Morris.Line({
                            element          : 'line-chart',
                            resize           : true,
                            data             : report,
                            xkey             : 'y',
                            ykeys            : dis,
                            labels           : dis,
                            lineColors       : ['#555', 'black', '#ff508c'],
                            hideHover        : 'auto',
                            pointSize        : 6,
                            pointStrokeColors: ['#555', 'black', '#ff508c'],
                            gridTextFamily   : 'Open Sans',
                            gridTextSize     : 13,
                          });
              }



            /****** SET DATA ******/
              var data = {
                  datasets: [{
                      data: [fem.toFixed(), mas.toFixed(), oth.toFixed()],
                      label: 'Generos',
                      backgroundColor: ['black', 'gray', '#677']
                  }],

                  // These labels appear in the legend and in the tooltips when hovering different arcs
                  labels: [
                      'Femenino',
                      'Masculino',
                      'Otro'
                  ]
              };

              var data2 = {
                  datasets: [{
                      data: count,
                      label: 'Edad paciente',
                      backgroundColor: arraycolorAge

                  }],
                  labels: age
              };

             var dataAppo = {
                    datasets: [{
                        data: countAppo,
                        label: 'Estatus Citas',
                        backgroundColor: arraycolorAppo

                    }],
                    labels: appointments
                }; 

              var dataBalance = {
                  datasets: [{
                      data: arrayBalance,
                      label: 'Saldos',
                      backgroundColor: ['#96da99', '#e46f6f']

                  }],
                  labels: ["Pagado", "Pendiente"]
              };

              var dataworkplace = {
                  datasets: [{
                      data: arrayworkplace,
                      label: 'Citas por consultorios',
                      backgroundColor: arraycolorWork

                  }],
                  labels: places
              };              


                 
                var options = {
                    responsive: true,   
                    scales: {
                        yAxes: [{
                            ticks: {
                              min: 0,
                              stepSize: 1
                            }
                        }]
                    }
                };

             /****** SET DATA ******/   


      /*Edades*/
      var myBarChartAges;
      var chartType = 'bar';
      AgesGr();

   function AgesGr(){

  
        myBarChartAges = new Chart(document.getElementById('myChart2'), {     
            type: chartType,
            data: data2,
            options: options
        });
            if(this.chartType == 'bar')
              $('.ageicon').removeClass('fa-bar-chart').addClass('fa-pie-chart');
            else
              $('.ageicon').removeClass('fa-pie-chart').addClass('fa-bar-chart');
    }    

  function changeAges(){
      myBarChartAges.destroy();
  //change chart type: 
            this.chartType = (this.chartType == 'bar') ? 'doughnut' : 'bar';
            //restart chart:
            AgesGr();
  }  

    var myDoughnutChartGender;
    var chartTypeGender = 'doughnut';
    genderGr();

        function genderGr(){

            myDoughnutChartGender = new Chart(document.getElementById('myChart'), {
                type: chartTypeGender ,
                data: data
            });
           if(this.chartTypeGender == 'bar')
              $('.gendericon').removeClass('fa-bar-chart').addClass('fa-pie-chart');
            else
              $('.gendericon').removeClass('fa-pie-chart').addClass('fa-bar-chart');
        }

      function changeGender(){

            myDoughnutChartGender.destroy();
             //change chart type: 
            this.chartTypeGender = (this.chartTypeGender == 'bar') ? 'doughnut' : 'bar';
            //restart chart:
            genderGr();
       }  


      var myChartAppo;
      var chartTypeAppo = 'doughnut';
      appoGr();

      function appoGr(){

            myChartAppo = new Chart(document.getElementById('myChartAppointments'), {
                type: chartTypeAppo,
                data: dataAppo,
                options: options
            });
           if(this.chartTypeAppo == 'horizontalBar')
              $('.appoicon').removeClass('fa-bar-chart').addClass('fa-pie-chart');
            else
              $('.appoicon').removeClass('fa-pie-chart').addClass('fa-bar-chart');
        }

      function changeAppo(){

             myChartAppo.destroy();
             //change chart type: 
            this.chartTypeAppo = (this.chartTypeAppo == 'horizontalBar') ? 'doughnut' : 'horizontalBar';
            //restart chart:
            appoGr();
       }  

    var myChartBal;
    var chartTypeBal = 'doughnut';
    balanceGr();

      function balanceGr(){

            myChartBal = new Chart(document.getElementById('myChartBalance'), {
                type: chartTypeBal,
                data: dataBalance,
                options: {
                    responsive: true
                }
            });

           if(this.chartTypeBal == 'horizontalBar')
              $('.balicon').removeClass('fa-bar-chart').addClass('fa-pie-chart');
            else
              $('.balicon').removeClass('fa-pie-chart').addClass('fa-bar-chart');
        }
      function changeBalance(){
       myChartBal.destroy();
       //change chart type: 
            this.chartTypeBal = (this.chartTypeBal == 'horizontalBar') ? 'doughnut' : 'horizontalBar';
            //restart chart:
            balanceGr();
       }  


      var myChartWorkplace;
      var chartTypeWork = 'bar';
      workGr();

      function workGr(){

            myChartWorkplace = new Chart(document.getElementById('myChartWorkplace'), {
                type: chartTypeWork,
                data: dataworkplace
            });
           if(this.chartTypeWork == 'bar')
              $('.workicon').removeClass('fa-bar-chart').addClass('fa-pie-chart');
            else
              $('.workicon').removeClass('fa-pie-chart').addClass('fa-bar-chart');
        }

      function changeWorkplace(){

             myChartWorkplace.destroy();
             //change chart type: 
            this.chartTypeWork = (this.chartTypeWork == 'bar') ? 'doughnut' : 'bar';
            //restart chart:
            workGr();
       }  



</script>

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
     var j$132 = jQuery.noConflict();
     (function(jQuery) {
   
        // Make the dashboard widgets sortable Using jquery UI
        jQuery('.connectedSortable').sortable({
          placeholder         : 'sort-highlight',
          connectWith         : '.connectedSortable',
          handle              : '.box-header',
          forcePlaceholderSize: true,
          zIndex              : 999999
        });
       jQuery('.connectedSortable .box-header').css('cursor', 'move');
          })(j$132);
    </script>
@stop
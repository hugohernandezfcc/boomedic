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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Knob/1.2.13/jquery.knob.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<div class="box">

  	<div class="box-header with-border">
	    <h3 class="box-title">Reportes</h3>
  	</div>
  	<div class="box-body">
      <div class="col-md-12">
        @php
        $r = json_decode($report);
        @endphp
  			<div class="box box-solid bg-teal-gradient">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Polígono de Enfermedades</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
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

        </div>
            <!-- /.box-footer -->
      <div class="col-md-6">
         <div class="box box-secondary">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Género</h3>

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
        </div>

                    <!-- /.box-footer -->
       <div class="col-md-6">
         <div class="box box-secondary">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Edades</h3>

              <div class="box-tools pull-right">
               <button type="button" class="btn btn-default btn-sm" onclick="changeAges();"><i class="fa fa-pie-chart ageicon"></i>
                </button>
                <button type="button" class="btn btn-secondary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>

              </div>
            </div>
            <div class="box-body border-radius-none">
            <canvas id="myChart2" class="chartjs" style="height: 250px;"></canvas>
            </div>
            <!-- /.box-body -->
            
            <!-- /.box-footer -->
          </div>
        </div>
      <div class="col-md-6">
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
        </div>
        <div class="col-md-6">
         <div class="box box-secondary">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Saldos</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-default btn-sm" onclick="changeBalance();"><i class="fa fa-bar-chart baricon"></i>
                </button>
                <button type="button" class="btn btn-secondary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body border-radius-none">
            <canvas id="myChartBalance" class="chartjs" style="height: 250px;"></canvas>
            </div>
          </div>
        </div> 
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
          var arrayBalance = [0,0];


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
          var title = '0';
 
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



              /*Enfermedades*/

              if(report.length > 0){
                        var months = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];

                          var line = new Morris.Line({
                            element          : 'line-chart',
                            resize           : true,
                            data             : report,
                            xkey             : 'y',
                            ykeys            : dis,
                            labels           : dis,
                            lineColors       : ['#efefef', 'black', '#ff508c'],
                            lineWidth        : 2,
                            hideHover        : 'auto',
                            gridTextColor    : '#fff',
                            gridStrokeWidth  : 0.3,
                            pointSize        : 6,
                            fillOpacity: 0.1,
                            pointStrokeColors: ['#efefef', 'black', '#ff508c'],
                            gridLineColor    : ['#efefef', 'black', '#ff508c'],
                            gridTextFamily   : 'Open Sans',
                            gridTextSize     : 12,
                            hideHover: 'auto'
                          });
              }
              /*generos*/

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
 



  /*edades*/
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

</script>

@stop
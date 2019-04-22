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
        <!--<div class="col-md-12">
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
              <div class="chart">
              <canvas id="myChart3" height="200" style="height: 250px"></canvas>
            </div>
            </div>

          </div>
        </div>-->
          </div>

<script type="text/javascript">
	
$(function() {
  var dis = @php echo $dis; @endphp;
  var fem = @php echo $fem; @endphp;
  var mas = @php echo $mas; @endphp;
  var oth = @php echo $oth; @endphp;
  var age = @php echo $arrayA; @endphp;
  var count = @php echo $count; @endphp;

  var report =JSON.stringify(@php echo $report; @endphp);
  report =JSON.parse(report);
  console.log(report);

  /* Morris.js Charts */
  // Sales chart
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
    lineColors       : ['#efefef', 'black'],
    lineWidth        : 2,
    hideHover        : 'auto',
    gridTextColor    : '#fff',
    gridStrokeWidth  : 0.4,
    pointSize        : 3,
    fillOpacity: 0.1,
    pointStrokeColors: ['#efefef','black'],
    gridLineColor    : ['#efefef','black'],
    gridTextFamily   : 'Open Sans',
    gridTextSize     : 10,
    hideHover: 'auto',
    xLabels: "month",
    xLabelFormat: function (x) { return months[x.getMonth()]; }
  });
}
/*generos*/

data = {
    datasets: [{
        data: [fem.toFixed(2), mas.toFixed(2), oth.toFixed(2)],
        backgroundColor: ['black', 'gray', '#777']
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
        'Femenino',
        'Masculino',
        'Otro'
    ]
};



    var arraycolorAge = Array();
        for(var x = 0; x < count.length; x++){
              var value = Math.random() * 0xFF | 0;
              var grayscale = (value << 16) | (value << 8) | value;
              var color = '#' + grayscale.toString(16);
              arraycolorAge.push(String(color));
      }
    

var ctx = document.getElementById('myChart').getContext('2d');

var myPieChart = new Chart(ctx,{
    type: 'pie',
    data: data
});
// And for a doughnut chart

var myDoughnutChart = new Chart(ctx, {
    type: 'doughnut',
    data: data
});
/*edades*/
data2 = {
    datasets: [{
        data: count,
        label: 'Edad paciente',
        backgroundColor: arraycolorAge

    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: age
};
 
var options = {
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
var ctz = document.getElementById('myChart2').getContext('2d');
var myBarChart = new Chart(ctz, {
    type: 'bar',
    data: data2,
    options: options 
});

/*var cty = document.getElementById('myChart3').getContext('2d');
var myLineChart = new Chart(cty, {
    type: 'line',
  data: {
   labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'],
    datasets: [{ 
        data: [860,114,1060,106,1070],
        label: "Cancer",
        borderColor: "black",
        backgroundColor: "black",
        pointBorderWidth: 2,
        fill: false,
        borderWidth: 2,
        yAxisID: 'y-axis-1'
      }, { 
        data: [2500,350,411,809,635],
        label: "Hepatitis",
        borderColor: "#8e5ea2",
        backgroundColor: "#8e5ea2",
        pointBorderWidth: 2,
        fill: false,
        borderWidth: 2,
        yAxisID: 'y-axis-1'
      }, { 
        data: [168,1700,2965,190,2000],
        label: "Dengue",
        borderColor: "white",
        backgroundColor: "white",
        pointBorderWidth: 2,
        fill: false,
        borderWidth: 2,
        yAxisID: 'y-axis-1'
      }, { 
        data: [40,20,38,74,167],
        label: "Otras",
        borderColor: "#FF9EDA",
        backgroundColor: "#FF9EDA",
        pointBorderWidth: 2,
        fill: false,
        borderWidth: 2,
        yAxisID: 'y-axis-2'
      },

    ]
  },
  options: {
    responsive: true,
     scales: {


    xAxes: [{
      ticks:{
        fontColor:"white",
        fontSize: 10,
        fontStyle: "normal",
         beginAtZero: true
      },
       gridLines:{ 
          display: false
        }
    }],
    yAxes: [{
      type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
              display: true,
              position: 'left',
              id: 'y-axis-1',
                ticks:{
              fontColor:"white",
              fontSize: 10,
              fontStyle: "normal",
               beginAtZero: true
            },
             gridLines:{
                display: false
            }}, {
              type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
              display: true,
              position: 'right',
              id: 'y-axis-2',
      ticks:{
        fontColor:"white",
        fontSize: 10,
        fontStyle: "normal",
         beginAtZero: true
      },
       gridLines:{
          display: false
        }
    }]
  }
}
});*/


});



</script>

@stop
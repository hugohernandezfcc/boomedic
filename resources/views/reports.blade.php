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
              <div class="chart" id="line-chart" style="height: 250px;"></div>
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
  console.log(@php echo $report; @endphp);
  var fem = @php echo $fem; @endphp;
  var mas = @php echo $mas; @endphp;
  var age = @php echo $arrayA; @endphp;
  var count = @php echo $count; @endphp;
  console.log(count);
  /* Morris.js Charts */
  // Sales chart
/*Enfermedades*/
var months = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];

  var line = new Morris.Line({
    element          : 'line-chart',
    resize           : true,
    data             : [
      { y: '2018-01', Cancer: 2666, Hepatitis: 0, Dengue: 1500 },
      { y: '2018-02', Cancer: 2778, Hepatitis: 1200, Dengue: 2000  },
      { y: '2018-03', Cancer: 4912, Hepatitis: 1500, Dengue: 6500  },
      { y: '2018-04', Cancer: 3767, Hepatitis: 356, Dengue: 7800 },
      { y: '2018-05', Cancer: 870, Hepatitis: 8432, Dengue: 2500 },
      { y: '2018-06', Cancer: 3010, Hepatitis: 2432, Dengue: 4500 }

    ],
    xkey             : 'y',
    ykeys            : ['Cancer', 'Hepatitis','Dengue'],
    labels           : ['Cancer', 'Hepatitis','Dengue'],
    lineColors       : ['#efefef','#FF9EDA', 'black'],
    lineWidth        : 2,
    hideHover        : 'auto',
    gridTextColor    : '#fff',
    gridStrokeWidth  : 0.4,
    pointSize        : 3,
    fillOpacity: 0.1,
    pointStrokeColors: ['#efefef','#FF9EDA','black'],
    gridLineColor    : ['#efefef','#FF9EDA','black'],
    gridTextFamily   : 'Open Sans',
    gridTextSize     : 10,
    hideHover: 'auto',
    xLabels: "month",
    xLabelFormat: function (x) { return months[x.getMonth()]; }
  });
/*generos*/
data = {
    datasets: [{
        data: [fem.toFixed(2), mas.toFixed(2)],
        backgroundColor: ['black', 'gray']
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
        'Femenino',
        'Masculino',
    ]
};
/*edades*/
data2 = {
    datasets: [{
        data: count,
        backgroundColor: '#656565',
        label: 'Edad paciente'

    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: age
};
 
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
/*Edades*/
var ctz = document.getElementById('myChart2').getContext('2d');
var myBarChart = new Chart(ctz, {
    type: 'bar',
    data: data2,
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
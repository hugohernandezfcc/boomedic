@extends('adminlte::page')

@section('title', 'Boomedic')

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
          </div>

<script type="text/javascript">
	
$(function() {
  var fem = @php echo $fem; @endphp;
  var mas = @php echo $mas; @endphp;
  console.log(fem.toFixed(2) + ', '+ mas.toFixed(2));
  /* Morris.js Charts */
  // Sales chart
/*Enfermedades*/
  var line = new Morris.Line({
    element          : 'line-chart',
    resize           : true,
    data             : [
      { y: '2011 Q1', item1: 2666 },
      { y: '2011 Q2', item1: 2778 },
      { y: '2011 Q3', item1: 4912 },
      { y: '2011 Q4', item1: 3767},
      { y: '2012 Q1', item1: 6810},
      { y: '2012 Q2', item1: 5670 },
      { y: '2012 Q3', item1: 4820 },
      { y: '2012 Q4', item1: 15073},
      { y: '2013 Q1', item1: 10687 },
      { y: '2013 Q2', item1: 8432},
      { y: '2011 Q1',  item2:0 },
      { y: '2011 Q2', item2:1200 },
      { y: '2011 Q3',  item2: 1500 },
      { y: '2011 Q4', item2: 356 },
      { y: '2012 Q1', item2:2500 },
      { y: '2012 Q2',  item2:7800  },
      { y: '2012 Q3',  item2: 3200 },
      { y: '2012 Q4', item2:11000 },
      { y: '2013 Q1',item2:6305 },
      { y: '2013 Q2', item2:7552 },
      { y: '2011 Q1',  item3:15000 },
      { y: '2011 Q2', item3:2000 },
      { y: '2011 Q3',  item3: 6500 },
      { y: '2011 Q4', item3: 7800},
      { y: '2012 Q1', item3:2500 },
      { y: '2012 Q2',  item3:9000 },
      { y: '2012 Q3',  item3: 3200 },
      { y: '2012 Q4', item3:16000},
      { y: '2013 Q1', item3:5600 },
      { y: '2013 Q2', item3:7300 }
    ],
    xkey             : 'y',
    ykeys            : ['item1', 'item2','item3'],
    labels           : ['Item 1', 'item 2', 'item 3'],
    lineColors       : ['#efefef','#FF9EDA', 'black'],
    lineWidth        : 2,
    hideHover        : 'auto',
    gridTextColor    : '#fff',
    gridStrokeWidth  : 0.4,
    pointSize        : 4,
    pointStrokeColors: ['#efefef','#FF9EDA','black'],
    gridLineColor    : ['#efefef','#FF9EDA','black'],
    gridTextFamily   : 'Open Sans',
    gridTextSize     : 10
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
        data: [40, 60, 15 ,3, 18, 24],
        backgroundColor: '#656565',
        label: 'Edad paciente'

    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
        '40', '60', '15' ,'3', '18', '24'
    ]
};
/*generos*/
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


});



</script>

@stop
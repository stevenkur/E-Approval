@extends('layouts.backend')

@section('content')
  
    <section class="content">
    
    <div class="col-md-12">
        <div class="col-lg-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Summary Claim Graphic Per Program</h3>
                </div>
                <div id="charts" style="width: 500px; height: 500px; position: relative; margin: 0 auto; font-size: 8px;">
                  <div id="chartProgram1" class="chartdiv" style="width: 500px; height: 500px; position: absolute; top: 0; left: 0;"></div>  
                  <div id="chartProgram2" class="chartdiv" style="width: 500px; height: 500px; position: absolute; top: 0; left: 0;"></div>  
                  <div id="chartProgram3" class="chartdiv" style="width: 500px; height: 500px; position: absolute; top: 0; left: 0;"></div> 
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Summary Claim Graphic Per Category</h3>
                </div>
                <div id="charts" style="width: 500px; height: 500px; position: relative; margin: 0 auto; font-size: 8px;">
                  <div id="chartCategory1" class="chartdiv" style="width: 500px; height: 500px; position: absolute; top: 0; left: 0;"></div>  
                  <div id="chartCategory2" class="chartdiv" style="width: 500px; height: 500px; position: absolute; top: 0; left: 0;"></div>  
                  <div id="chartCategory3" class="chartdiv" style="width: 500px; height: 500px; position: absolute; top: 0; left: 0;"></div> 
                </div>
            </div>
        </div>
        <div class="col-lg-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Summary Claim Report Per Program</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Nama Distributor</th>
                        <th>Program Name</th>
                        <th>Entitlement</th>
                        <th>Max Claim Date</th>
                        <th>Pending</th>
                        <th>Closed</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($marketing as $marketings)
                    <tr>
                        <td>{{ $marketings->nama_distributor }}</td>
                        <td>{{ $marketings->nama_program }}</td>
                        <td>{{ $marketings->entitlement }}</td>
                        <td>{{ $marketings->maxclaim_date }}</td>
                        <td>{{ $marketings->Pending  }} </td>
                        <td> {{ $marketings->Closed  }}  </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
         <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Summary Claim Report Per Category</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Nama Distributor</th>
                        <th>Category Name</th>
                        <th>Entitlement</th>
                        <th>Pending</th>
                        <th>Closed</th>
                    </tr>
                    </thead>
                    <tbody>                   
                    @foreach($market as $markets)
                    <tr>
                        <td>{{ $markets->nama_distributor }}</td>
                        <td>{{ $markets->nama_category }}</td>
                        <td>{{ $markets->entitlement }}</td>
                        <td> {{ $markets->Pending }} </td>
                        <td> {{ $markets->Closed }} </td>
                    </tr>
                    @endforeach   
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        </div>
    </div>

    
    </section>

@stop

<!-- Charts -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/pie.js"></script>
<!-- jQuery 3 -->
<script src="{{ URL::asset('public/adminlte/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ URL::asset('public/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ URL::asset('public/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('public/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ URL::asset('public/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ URL::asset('public/adminlte/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ URL::asset('public/adminlte/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ URL::asset('public/adminlte/dist/js/demo.js') }}"></script>
<script type="text/javascript">
AmCharts.addInitHandler(function(chart) {
  
  // init holder for nested charts
  if (AmCharts.nestedChartHolder === undefined)
    AmCharts.nestedChartHolder = {};

  if (chart.bringToFront === true) {
    chart.addListener("init", function(event) {
      // chart inited
      var chart = event.chart;
      var div = chart.div;
      var parent = div.parentNode;
      
      // add to holder
      if (AmCharts.nestedChartHolder[parent] === undefined)
        AmCharts.nestedChartHolder[parent] = [];
      AmCharts.nestedChartHolder[parent].push(chart);
      
      // add mouse mouve event
      chart.div.addEventListener('mousemove', function() {
        
        // calculate current radius
        var x = Math.abs(chart.mouseX - (chart.realWidth / 2));
        var y = Math.abs(chart.mouseY - (chart.realHeight / 2));
        var r = Math.sqrt(x*x + y*y);
        
        // check which chart smallest chart still matches this radius
        var smallChart;
        var smallRadius;
        for(var i = 0; i < AmCharts.nestedChartHolder[parent].length; i++) {
          var checkChart = AmCharts.nestedChartHolder[parent][i];
          
          if((checkChart.radiusReal < r) || (smallRadius < checkChart.radiusReal)) {
            checkChart.div.style.zIndex = 1;
          }
          else {
            if (smallChart !== undefined)
              smallChart.div.style.zIndex = 1;
            checkChart.div.style.zIndex = 2;
            smallChart = checkChart;
            smallRadius = checkChart.radiusReal;
          }
          
        }
      }, false);
    });
  }

}, ["pie"]);

/**
 * Create the charts
 */
AmCharts.makeChart("chartProgram1", {
  "type": "pie",
  "bringToFront": true,
  "dataProvider": [{
    "title": "Total",
    "value": 100,
    "color": "#090E0F"
  }],
  "startDuration": 0,
  "pullOutRadius": 0,
  "color": "#fff",
  "fontSize": 14,
  "titleField": "title",
  "valueField": "value",
  "colorField": "color",
  "labelRadius": -25,
  "labelColor": "#fff",
  "radius": 25,
  "innerRadius": 0,
  "labelText": "[[title]]",
  "balloonText": "[[title]]: [[value]]"
});

AmCharts.makeChart("chartProgram2", {
  "type": "pie",
  "bringToFront": true,
  "dataProvider": [{
    "title": "Marketing",
    "value": 33,
    "color": "#BA3233"
  }, {
    "title": "Production",
    "value": 33,
    "color": "#624B6A"
  }, {
    "title": "R&D",
    "value": 33,
    "color": "#6179C0"
  }],
  "startDuration": 1,
  "pullOutRadius": 0,
  "color": "#fff",
  "fontSize": 9,
  "titleField": "title",
  "valueField": "value",
  "colorField": "color",
  "labelRadius": -28,
  "labelColor": "#fff",
  "radius": 80,
  "innerRadius": 27,
  "outlineAlpha": 1,
  "outlineThickness": 4,
  "labelText": "[[title]]",
  "balloonText": "[[title]]: [[value]]"
});

AmCharts.makeChart("chartProgram3", {
  "type": "pie",
  "bringToFront": true,
  "dataProvider": [{
    "title": "Online",
    "value": 11,
    "color": "#BA3233"
  }, {
    "title": "Print",
    "value": 11,
    "color": "#BA3233"
  }, {
    "title": "Other",
    "value": 11,
    "color": "#BA3233"
  }, {
    "title": "Equipment",
    "value": 16.5,
    "color": "#624B6A"
  }, {
    "title": "Materials",
    "value": 16.5,
    "color": "#624B6A"
  }, {
    "title": "Labs",
    "value": 16.5,
    "color": "#6179C0"
  }, {
    "title": "Patents",
    "value": 16.5,
    "color": "#6179C0"
  }],
  "startDuration": 1,
  "pullOutRadius": 0,
  "color": "#fff",
  "fontSize": 8,
  "titleField": "title",
  "valueField": "value",
  "colorField": "color",
  "labelRadius": -27,
  "labelColor": "#fff",
  "radius": 135,
  "innerRadius": 82,
  "outlineAlpha": 1,
  "outlineThickness": 4,
  "labelText": "[[title]]",
  "balloonText": "[[title]]: [[value]]"
});
    
AmCharts.makeChart("chartCategory1", {
  "type": "pie",
  "bringToFront": true,
  "dataProvider": [{
    "title": "Total",
    "value": 100,
    "color": "#090E0F"
  }],
  "startDuration": 0,
  "pullOutRadius": 0,
  "color": "#fff",
  "fontSize": 14,
  "titleField": "title",
  "valueField": "value",
  "colorField": "color",
  "labelRadius": -25,
  "labelColor": "#fff",
  "radius": 25,
  "innerRadius": 0,
  "labelText": "[[title]]",
  "balloonText": "[[title]]: [[value]]"
});

AmCharts.makeChart("chartCategory2", {
  "type": "pie",
  "bringToFront": true,
  "dataProvider": [{
    "title": "Marketing",
    "value": 33,
    "color": "#BA3233"
  }, {
    "title": "Production",
    "value": 33,
    "color": "#624B6A"
  }, {
    "title": "R&D",
    "value": 33,
    "color": "#6179C0"
  }],
  "startDuration": 1,
  "pullOutRadius": 0,
  "color": "#fff",
  "fontSize": 9,
  "titleField": "title",
  "valueField": "value",
  "colorField": "color",
  "labelRadius": -28,
  "labelColor": "#fff",
  "radius": 80,
  "innerRadius": 27,
  "outlineAlpha": 1,
  "outlineThickness": 4,
  "labelText": "[[title]]",
  "balloonText": "[[title]]: [[value]]"
});

AmCharts.makeChart("chartCategory3", {
  "type": "pie",
  "bringToFront": true,
  "dataProvider": [{
    "title": "Online",
    "value": 11,
    "color": "#BA3233"
  }, {
    "title": "Print",
    "value": 11,
    "color": "#BA3233"
  }, {
    "title": "Other",
    "value": 11,
    "color": "#BA3233"
  }, {
    "title": "Equipment",
    "value": 16.5,
    "color": "#624B6A"
  }, {
    "title": "Materials",
    "value": 16.5,
    "color": "#624B6A"
  }, {
    "title": "Labs",
    "value": 16.5,
    "color": "#6179C0"
  }, {
    "title": "Patents",
    "value": 16.5,
    "color": "#6179C0"
  }],
  "startDuration": 1,
  "pullOutRadius": 0,
  "color": "#fff",
  "fontSize": 8,
  "titleField": "title",
  "valueField": "value",
  "colorField": "color",
  "labelRadius": -27,
  "labelColor": "#fff",
  "radius": 135,
  "innerRadius": 82,
  "outlineAlpha": 1,
  "outlineThickness": 4,
  "labelText": "[[title]]",
  "balloonText": "[[title]]: [[value]]"
});
</script>
@extends('layouts.backend')

@section('content')
  
    <!-- Main content -->
    <section class="content">
        <div class="col-md-12">
        <div class="box box-primary">        
        <h1><center>Welcome to Philips E-Approval Application</center></h1>
            <div class="box-header with-border">
                <h3 class="box-title">Pending Approval</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Pending On</th>
                        @foreach($category as $categories) 
                        <th>{{ $categories->nama_category }}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>                   
                    
                    <tr>
                        <td>Release</td>
                        <td>Rp 10.000</td>
                        <td>Rp 10.000</td>
                        <td>Rp 10.000</td>
                        <td>Rp 10.000</td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>Rp 10.000</td>
                        <td>Rp 10.000</td>
                        <td>Rp 10.000</td>
                        <td>Rp 10.000</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        </div>
    </section>
    <!-- /.content -->

@stop

<!-- jQuery 3 -->
<script src="public/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="public/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="public/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="public/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="public/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="public/adminlte/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="public/adminlte/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="public/adminlte/dist/js/demo.js"></script>
<!-- page script -->
<script>
$(function() {
    $('#table').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  });
</script>
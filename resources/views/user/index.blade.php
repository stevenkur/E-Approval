@extends('layouts.backend')

@section('content')

<?php  
    $category_length = sizeof(Session::get('nama_category'));
    $category = Session::get('nama_category');
    $category_now = Session::get('categories');
?>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">        
        <h1><center>Welcome to Philips E-Approval Application</center></h1>
            <div class="box-header with-border">
                <h3 class="box-title">Pending Approval</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                    <tr style="font-size: 20px;">
                        <th>Pending On</th>
                        @for($i=0;$i<$category_length;$i++)
                            <th><a href="{{route('changearea',$category[$i])}}"><u>{{ $category[$i] }}</u></a></th>                    
                        @endfor
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>DM</td>
                        <td>Rp 10.000</td>
                        <td>Rp 12.000</td>
                        <td>Rp 14.000</td>
                        <td>Rp 16.000</td>
                    </tr>
                    <tr>
                        <td>Finance</td>
                        <td>Rp 10.000</td>
                        <td>Rp 12.000</td>
                        <td>Rp 14.000</td>
                        <td>Rp 16.000</td>
                    </tr>
                    <tr>
                        <td><b>Release</b></td>
                        <td>Rp 100.000</td>
                        <td>Rp 120.000</td>
                        <td>Rp 130.000</td>
                        <td>Rp 140.000</td>
                    </tr>
                    <tr>
                        <td><b>Total</b></td>
                        <td>Rp 150.000</td>
                        <td>Rp 170.000</td>
                        <td>Rp 190.000</td>
                        <td>Rp 180.000</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </section>
    <!-- /.content -->

@stop

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
<!-- page script -->
<script>
$(function() {
    $('#table').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : false,
      'info'        : false,
      'autoWidth'   : false
    })
  });
</script>
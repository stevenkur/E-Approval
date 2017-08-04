@extends('layouts.backend')

@section('content')
  
    <section class="content">
    

    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Summary Claim Report per Program</h3>
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
                   
                    <tr>
                        <td>PT Sejahtera </td>
                        <td>program a</td>
                        <td>300000</td>
                        <td>09-08-2017 </td>
                        <td>10000</td>
                        <td>10000</td>
                    </tr>
                    <tr>
                        <td>PT Sejahtera </td>
                        <td>program a</td>
                        <td>300000</td>
                        <td>09-08-2017 </td>
                        <td>10000</td>
                        <td>10000</td>
                    </tr>
                    
                    
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
         <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Summary Claim Report per Category</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Nama Distributor</th>
                        <th>Category Name</th>
                        <th>Entitlement</th>
                        <th>Max Claim Date</th>
                        <th>Pending</th>
                        <th>Closed</th>
                    </tr>
                    </thead>
                    <tbody>
                   
                    <tr>
                        <td>PT Sejahtera </td>
                        <td>Marcom</td>
                        <td>300000</td>
                        <td>09-08-2017 </td>
                        <td>10000</td>
                        <td>10000</td>
                    </tr>
                    <tr>
                        <td>PT Sejahtera </td>
                        <td>RDP</td>
                        <td>300000</td>
                        <td>09-08-2017 </td>
                        <td>10000</td>
                        <td>10000</td>
                    </tr>
                    
                    
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    </div>

    
    </section>

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
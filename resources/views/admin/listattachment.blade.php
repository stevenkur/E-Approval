@extends('layouts.backend-admin')

@section('content')

    <!-- Main content -->
    <section class="content">
    <div class="row">
    

    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">List Attachment</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Distributor</th>
                        <th>Payment Requistion Form</th>
                        <th>Airway Bill Number</th>
                        <th>Original tax & supplier invoices</th>
                        <th>Other Document</th>
                        
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listattachment as $listattachments)
                    <tr>
                        <td>{{ $listattachments->id_claim }}</td>
                        <td>{{ $listattachments->nama_distributor }}</td>
                        <td>{{ $listattachments->airwaybill }}</td>
                        <td>{{ $listattachments->payment_form }}</td>
                        <td>{{ $listattachments->original_tax }}</td>
                        <td>{{ $listattachments->nama_attachment }}</td>
                        
                        
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
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  });
</script>
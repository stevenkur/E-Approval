@extends('layouts.backend')

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">List Claim</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="claim" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Reg. No</th>
                        <th>Registered On</th>
                        <th>BP Name</th>
                        <th>Claim Type</th>
                        <th>Program Name</th>
                        <th>Value</th>
                        <th>Status</th>
                        <th>Comment</th>
                        <th>PRNumber</th>
                        <th>InvoiceNumber</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($monitoring as $monitorings)
                    <tr>
                        <td>
                            <!-- Trigger the modal with a button -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">{{ $monitorings->id_claim }}</button>

                            <!-- Modal -->
                            <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Reg. No: {{ $monitorings->id_claim }}</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Nama Distributor : {{$monitorings->nama_distributor}}</p>
                                            <p>Registered On : {{$monitorings->created_at}}</p>
                                            <p>Category : {{$monitorings->nama_category}}</p>
                                            <p>Category Type : {{$monitorings->category_type}}</p>
                                            <p>Program : {{$monitorings->nama_program}}</p>
                                            <p>Value : {{$monitorings->value}}</p>
                                            <p>Entitlement : {{$monitorings->entitlement}}</p>
                                            <p>PR Number : {{$monitorings->pr_number}}</p>
                                            <p>Invoice number : {{$monitorings->invoice_number}}</p>
                                            <p>Comment : {{$monitorings->comment}}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Edit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $monitorings->created_at }}</td>
                        <td>{{ $monitorings->nama_distributor }}</td>
                        <td>{{ $monitorings->category_type }}</td>
                        <td>{{ $monitorings->nama_program }}</td>
                        <td>{{ $monitorings->value }}</td>
                        <td>{{ $monitorings->status }}</td>
                        <td>{{ $monitorings->comment }}</td>
                        <td>{{ $monitorings->pr_number }}</td>
                        <td>{{ $monitorings->invoice_number }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
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
    $('#claim').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  });
</script>
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
                    <?php $length=(sizeof($monitoring));

                    ?> 

                    <tbody>
                    @for($i=0; $i<$length; $i++)
                    <tr>
                                          
                        <td>
                            <!-- Trigger the modal with a button -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">{{ $monitoring[$i]->id_claim }}</button>

                            <!-- Modal -->
                            <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            
                                            <h4 class="modal-title">Reg. No: {{ $monitoring[$i]->id_claim }}</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Nama Distributor : {{$monitoring[$i]->nama_distributor}}</p>
                                            <p>Registered On : {{$monitoring[$i]->created_at}}</p>
                                            <p>Category : {{$monitoring[$i]->nama_category}}</p>
                                            <p>Category Type : {{$monitoring[$i]->category_type}}</p>
                                            <p>Program : {{$monitoring[$i]->nama_program}}</p>
                                            <p>Value : {{$monitoring[$i]->value}}</p>
                                            <p>Entitlement : {{$monitoring[$i]->entitlement}}</p>
                                            <p>PR Number : {{$monitoring[$i]->pr_number}}</p>
                                            <p>Invoice number : {{$monitoring[$i]->invoice_number}}</p>
                                            <p>Comment : {{$monitoring[$i]->comment}}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Edit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $monitoring[$i]->created_at }}</td>
                        <td>{{ $monitoring[$i]->nama_distributor }}</td>
                        <td>{{ $monitoring[$i]->category_type }}</td>
                        <td>{{ $monitoring[$i]->nama_program }}</td>
                        <td>{{ $monitoring[$i]->value }}</td>
                        <td>{{ $monitoring[$i]->status }}</td>
                        <td>{{ $monitoring[$i]->comment }}</td>
                        <td>{{ $monitoring[$i]->pr_number }}</td>
                        <td>{{ $monitoring[$i]->invoice_number }}</td>
                    </tr>
                    @endfor
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
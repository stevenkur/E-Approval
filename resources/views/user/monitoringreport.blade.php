@extends('layouts.backend')

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Monitoring Report</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive" style="overflow: auto">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Reg. No</th>
                        <th>Registered On</th>
                        <th>BP Name</th>
                        <th>Program Name</th>
                        <th>Value</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($monitoring as $monitorings)
                    <tr>                                          
                        <td>
                            <!-- Trigger the modal with a button -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal{{ $monitorings->id_claim }}">{{ $monitorings->id_claim }}</button>

                            <!-- Modal -->
                            <div class="modal fade" id="myModal{{ $monitorings->id_claim }}" role="dialog">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Reg. No: {{ $monitorings->id_claim }}</h4>
                                        </div>
                                        <div class="modal-body">
                                            <ul class="nav nav-tabs" id="tabContent">
                                                <li class="active"><a href="#details{{ $monitorings->id_claim }}" data-toggle="tab">Details</a></li>
                                                <li><a href="#comment{{ $monitorings->id_claim }}" data-toggle="tab">Comment</a></li>
                                                <li><a href="#status{{ $monitorings->id_claim }}" data-toggle="tab">Status</a></li>
                                                <li><a href="#attachment{{ $monitorings->id_claim }}" data-toggle="tab">Attachment</a></li>
                                            </ul>
                                              
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="details{{ $monitorings->id_claim }}"><br>
                                                    <label class="control-label">Details Registration Number {{ $monitorings->id_claim }}</label><br><br>
                                                    <table id="comment" class="table table-bordered table-striped">
                                                    <tbody>
                                                        <tr>
                                                            <td class="col-md-3">Email</td>
                                                            <td class="col-md-9">{{$monitorings->nama_distributor}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Registered On</td>
                                                            <td>{{$monitorings->created_at}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Category</td>
                                                            <td>{{$monitorings->nama_category}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Category Type</td>
                                                            <td>{{$monitorings->category_type}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Program</td>
                                                            <td>{{$monitorings->nama_program}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Value</td>
                                                            <td>Rp <?php echo number_format("$monitorings->value",0,',','.'); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Entitlement</td>
                                                            <td>Rp <?php echo number_format("$monitorings->entitlement",0,',','.'); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Courier</td>
                                                            <td>
                                                                @if($monitorings->courier!=NULL)                                                        
                                                                {{$monitorings->courier}}
                                                                @else
                                                                -
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>PR Number</td>
                                                            <td>
                                                                @if($monitorings->pr_number!=NULL)                                                        
                                                                {{$monitorings->pr_number}}
                                                                @else
                                                                -
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Invoice Number</td>
                                                            <td>
                                                                @if($monitorings->invoice_number!=NULL)
                                                                {{$monitorings->invoice_number}}
                                                                @else
                                                                -
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                    </table>
                                                </div>                                                    
                                                <div class="tab-pane" id="comment{{ $monitorings->id_claim }}"><br>
                                                    <label class="control-label">Comments Registration Number {{ $monitorings->id_claim }}</label><br><br>
                                                    <form action="{{ route('addcomment', ['idclaim' => $monitorings->id_claim]) }}" method="post" role="form" class="form-horizontal" name="formaddcomment" id="formaddcomment" enctype="multipart/form-data">
                                                    {{csrf_field()}}
                                                    <div class="box-header with-border">
                                                        <label class="box-title">Add Comment</label>
                                                    </div>
                                                    <div class="box-body">
                                                    <!-- <label class="col-md-2 control-label">Add Comment</label> -->
                                                    <textarea rows="3" id="comment" name="comment" form="formaddcomment" class="col-md-12"></textarea>
                                                    </div>
                                                    <div class="box-footer" align="right">
                                                        <button type="reset" class="btn btn-ok">Reset</button>
                                                        <button type="submit" class="btn btn-primary">Add</button>
                                                    </div>
                                                    </form>
                                                    <table id="comment" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th class="col-md-3">User</th>
                                                            <th class="col-md-6">Comment</th>
                                                            <th class="col-md-3">Created</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($comment as $comments)
                                                        @if($monitorings->id_claim==$comments->id_claim)
                                                        <tr>                 
                                                            <td>{{ $comments->id_user }}</td>                                           
                                                            <td>{{ $comments->comment }}</td>
                                                            <td>{{ $comments->created_at }}</td>
                                                        </tr>
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                    </table>
                                                </div>
                                                <div class="tab-pane" id="status{{ $monitorings->id_claim }}"><br>
                                                    <label class="control-label">Status Registration Number {{ $monitorings->id_claim }}</label><br><br>
                                                    <table id="status" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th class="col-md-4">User</th>
                                                            <th class="col-md-4">Activity</th>
                                                            <th class="col-md-4">Created</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($status as $stats)
                                                        @if($monitorings->id_claim==$stats->id_claim)
                                                        <tr>
                                                            <td>{{ $stats->id_user }}</td>
                                                            <td>{{ $stats->id_activity }}</td>
                                                            <td>{{ $stats->created_at }}</td>
                                                        </tr>
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                    </table>
                                                </div>
                                                <div class="tab-pane" id="attachment{{ $monitorings->id_claim }}"><br>
                                                    <label class="control-label">Attachment Registration Number {{ $monitorings->id_claim }}</label><br><br>
                                                    <table id="status" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th class="col-md-6">Primary Attachment</th>
                                                            <th class="col-md-6">File</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>Payment Requisition Form</td>
                                                        <td><a href="public/attachment/{{ $monitorings->id_claim }}/{{ $monitorings->payment_form }}" download>{{ $monitorings->payment_form }}</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Original Tax & Supplier Invoices</td>
                                                        <td><a href="public/attachment/{{ $monitorings->id_claim }}/{{ $monitorings->original_tax }}" download>{{ $monitorings->original_tax }}</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>AirwayBill Number</td>
                                                        <td>
                                                            @if($monitorings->airwaybill==NULL)
                                                            -
                                                            @else
                                                            <a href="public/attachment/{{ $monitorings->id_claim }}/{{ $monitorings->airwaybill }}" download>{{ $monitorings->airwaybill }}</a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                    </table>
                                                    <table id="status" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th class="col-md-6">Another Attachment</th>
                                                            <th class="col-md-6">Created</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($attachment as $attachments)
                                                        @if($monitorings->id_claim==$attachments->id_claim)
                                                        <tr>
                                                            <td><a href="public/attachment/{{ $attachments->id_claim }}/{{ $attachments->nama_attachment }}" download>{{ $attachments->nama_attachment }}</a></td>
                                                            <td>{{ $attachments->created_at }}</td>
                                                        </tr>
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                    </table>
                                                </div>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $monitorings->created_at }}</td>
                        <td>{{ $monitorings->nama_distributor }}</td>
                        <td>{{ $monitorings->nama_program }}</td>
                        <td>Rp <?php echo number_format("$monitorings->value",0,',','.'); ?></td>
                        <td>{{ $monitorings->status }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
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
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  });
</script>
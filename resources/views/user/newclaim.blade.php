@extends('layouts.backend')

@section('content')
    <style type="text/css">
        .form-group.required .control-label:after {
            content:"*";
            color:red;
        }
    </style>

    <!-- <script type="text/javascript">
    function addCommas(nStr)
    {
        nStr += '';
        var x = nStr.split('.');
        var x1 = x[0];
        var x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + '.' + '$2');
        }
        return x1 + x2;
    }
    </script> -->
  
    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <form action="#" method="post" role="form" class="form-horizontal" enctype="multipart/form-data" name="formnewclaim">
            {{csrf_field()}}
            <div class="box-header with-border">
                <h3 class="box-title">New Claim Registration</h3>
            </div>
            <div class="box-body">
                <div align="left">
                    <label style="color: red;"><small>* Indicates a required field</small></label>
                </div>
                <div class="col-md-6">
                    <div class="form-group required">
                        <label class="col-md-4 control-label">Reg. No</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="regno" name="regno" placeholder="" required="required" style="text-align: right;" />
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-md-4 control-label">Program Name</label>
                        <div class="col-md-8">
                            <select class="form-control" name="programname" id="programname">
                                <option value="#">-- Please Choose One --</option>
                                <option value="1">Program A</option>
                                <option value="2">Program B</option>
                                <option value="3">Program C</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-md-4 control-label">Program for Year</label>
                        <div class="col-md-8">
                            <select class="form-control" name="programyear" id="programyear">
                                <option value="#">-- Please Choose One --</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group required">
                        <label class="col-md-4 control-label">Claim Type</label>
                        <div class="col-md-8">
                            <select class="form-control" name="claimtype" id="claimtype" disabled>
                                <option value="Marcom">Marcom</option>
                                <option value="RDP">RDP</option>
                                <option value="BDF">BDF</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-md-4 control-label">Value</label>
                        <div class="col-md-8">
                            <!-- <input type="text" class="form-control" id="value" name="value" onkeyup="this.value=addCommas(this.value);" required="required" style="text-align: right;" /> -->
                            <input type="text" class="form-control" id="value" name="value" required="required" style="text-align: right;" />
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-md-4 control-label">Entitlement</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="entitlement" name="entitlement" placeholder="" required="required" style="text-align: right;" />
                        </div>
                    </div>
                </div>

                <div class="form-group required">
                    <label class="col-md-3 control-label">Attachment</label>
                    <div class="col-md-9">
                        <label class="custom-file">Payment Requisition Form
                            <input type="file" id="file1" class="custom-file-input">
                            <span class="custom-file-control"></span>
                        </label>
                        <label class="custom-file">Original Tax & Supplier Invoices
                            <input type="file" id="file1" class="custom-file-input">
                            <span class="custom-file-control"></span>
                        </label>
                        <label class="custom-file">AirwayBill Number
                            <input type="file" id="file1" class="custom-file-input">
                            <span class="custom-file-control"></span>
                        </label>
                    </div>
                </div>

                <div class="form-group required">
                    <label class="col-md-3 control-label">Document Completion</label>
                    <div class="col-md-9">
                        <div class="checkbox">
                            <label><input type="checkbox" value="1">Payment Requisition Form (Please attached the scanned document on this claim)</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value="2">Marketing Program Letter/BDF proposal Approval/Natura template</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value="3">Marketing activity report with achievement</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value="4">Original Tax & Supplier Invoices. Tax must be addressed to PT Philips Indonesia (Please attached the scanned document on this claim)</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value="5">BP Invoice to Philips with BP signed & stamp</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value="6">Marketing Activity Picture</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value="7">Other supporting document</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value="8">AirwayBill Number (Please attached the scanned document on this claim)</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Comment</label>
                    <div class="col-md-9">
                        <textarea class="form-control" rows="3" name="comment" form="formnewclaim"></textarea>
                    </div>
                </div>

            </div>
            <div class="box-footer" align="left">
                <button type="reset" class="btn btn-ok">Reset</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
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
@extends('layouts.backend')

@section('content')
    <style type="text/css">
        .form-group.required .control-label:after {
            content:"*";
            color:red;
        }
    </style>

    <script type="text/javascript">
        function convertToRupiah(objek) {
            separator = ".";
            a = objek.value;
            b = a.replace(/[^\d]/g,"");
            c = "";
            d = "Rp ";
            panjang = b.length;
            j = 0;
            for (i = panjang; i > 0; i--) {
                j = j + 1;
                if (((j % 3) == 1) && (j != 1)) {
                    c = b.substr(i-1,1) + separator + c;
                } else {
                    c = b.substr(i-1,1) + c;
                }
            }
            objek.value = d + c;
        }
        updateList = function() {
            var input = document.getElementById('another');
            var output = document.getElementById('fileList');

            output.innerHTML = '<tr><td><b>Selected Files:</b></td>';
            for (var i = 0; i < input.files.length; ++i) {
                output.innerHTML += '<td> - ' + input.files.item(i).name + ' (' + input.files.item(i).size + ' bytes) </td>';
            }
            output.innerHTML += '</tr>';
        }
    </script>
  
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
                            <input type="text" class="form-control" id="regno" name="regno" value="<?php echo date('Ym'); ?>-" disabled/>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-md-4 control-label">Program Name</label>
                        <div class="col-md-8">
                            <select class="form-control" id="programname" name="programname">
                                <option value="#">-- Please Choose One --</option>
                                @foreach($program as $programs)
                                <option value="{{ $programs->id_program }}">{{ $programs->nama_program }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-md-4 control-label">Program for Year</label>
                        <div class="col-md-8">
                            <select class="form-control" id="programyear" name="programyear">
                                <option value="#">-- Please Choose One --</option>
                                <option value="<?php echo date("Y")-1; ?>"><?php echo date("Y")-1; ?></option>
                                <option value="<?php echo date("Y"); ?>"><?php echo date("Y"); ?></option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Claim Type</label>
                        <div class="col-md-8">
                            <select class="form-control" id="claimtype" name="claimtype" disabled>
                                <option value="Marcom">Marcom</option>
                                <option value="RDP">RDP</option>
                                <option value="BDF">BDF</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Entitlement</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="entitlement" name="entitlement" value="Rp 1.000.000 (WRONG)" required="required" style="text-align: right;" disabled />
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-md-4 control-label">Value</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="value" name="value" onkeyup="convertToRupiah(this);" style="text-align: right;"/>
                        </div>
                    </div>
                </div>

                <div class="form-group required">
                    <label class="col-md-3 control-label">Attachment</label>
                    <div class="col-md-9">
                        <label class="custom-file">Payment Requisition Form
                            <input type="file" id="file1" name="file1" class="custom-file-input" required>
                            <span class="custom-file-control"></span>
                        </label>
                        <label class="custom-file">Original Tax & Supplier Invoices
                            <input type="file" id="file2" name="file2" class="custom-file-input" required>
                            <span class="custom-file-control"></span>
                        </label>
                        <label class="custom-file">AirwayBill Number
                            <input type="file" id="file3" name="file3" class="custom-file-input" required>
                            <span class="custom-file-control"></span>
                        </label>
                        <label class="custom-file">Another Attachment
                            <input type="file" id="another" name="another" class="custom-file-input" multiple onchange="updateList()">
                            <span class="custom-file-control"></span>
                        </label>
                        <div><table id="fileList"></table></div>
                    </div>
                </div>

                <div class="form-group required">
                    <label class="col-md-3 control-label">Courier</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="kurir" name="kurir" required />
                    </div>
                </div>

                <div class="form-group required">
                    <label class="col-md-3 control-label">Document Completion</label>
                    <div class="col-md-9">
                        <div class="checkbox">
                            <label><input type="checkbox" value="1" required>Payment Requisition Form (Please attached the scanned document on this claim)</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value="2" required>Original Tax & Supplier Invoices. Tax must be addressed to PT Philips Indonesia (Please attached the scanned document on this claim)</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value="3">AirwayBill Number (Please attached the scanned document on this claim)</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value="4">Marketing Program Letter/BDF proposal Approval/Natura template</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value="5">Marketing activity report with achievement</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value="6">BP Invoice to Philips with BP signed & stamp</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value="7">Marketing Activity Picture</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value="8">Other supporting document</label>
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
            <div class="box-footer" align="right">
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
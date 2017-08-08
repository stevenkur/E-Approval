@extends('layouts.backend')

@section('content')

<?php  
    $category_length = sizeof(Session::get('nama_category'));
    $category = Session::get('nama_category');
    $category_now = Session::get('categories');
?>

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
            <form action="#" method="post" role="form" class="form-horizontal" enctype="multipart/form-data" name="formeditclaim">
            {{csrf_field()}}
            <div class="box-header with-border">
                <h3 class="box-title">Edit Claim Registration Number. {{ $result[0]->id_claim }}</h3>
            </div>
            <div class="box-body">
                <div align="left">
                    <label style="color: red;"><small>* Indicates a required field</small></label>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Category Claim Type</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="categoryclaimtype" name="categoryclaimtype" value="{{$category_now}}" readonly/>
                        </div>
                    </div> 
                    <div class="form-group required">
                        <label class="col-md-4 control-label">Program Name</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="programname" name="programname" value="{{ $result[0]->nama_program }}" disabled/>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-md-4 control-label">Program for Year</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="programyear" name="programyear" value="{{ $result[0]->programforyear }}" disabled/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group required">
                        <label class="col-md-4 control-label">Category Type</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="categorytype" name="categorytype" value="{{ $result[0]->category_type }}" disabled/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Entitlement</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="entitlement" name="entitlement" value="$result[0]->entitlement" required="required" style="text-align: right;" disabled />
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-md-4 control-label">Value</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="value" name="value" value="{{ $result[0]->value }}" onkeyup="convertToRupiah(this);" style="text-align: right;"/>
                        </div>
                    </div>
                </div>

                <div class="form-group required">
                    <label class="col-md-3 control-label">Attachment</label>
                    <div class="col-md-9">
                        <label class="custom-file">Payment Requisition Form
                            <input type="file" id="file1" name="file1" class="custom-file-input" value="{{ $result[0]->payment_form }}" required>
                            <span class="custom-file-control"></span>
                        </label>
                        <label class="custom-file">Original Tax & Supplier Invoices
                            <input type="file" id="file2" name="file2" class="custom-file-input" value="{{ $result[0]->original_tax }}" required>
                            <span class="custom-file-control"></span>
                        </label>
                        <label class="custom-file">AirwayBill Number
                            <input type="file" id="file3" name="file3" class="custom-file-input" required>
                            <span class="custom-file-control"></span>
                        </label>
                        <label class="custom-file">Another Attachment
                            <input type="file" id="another" name="another" class="custom-file-input" multiple onchange="updateList()"  value="">
                            <span class="custom-file-control"></span>
                        </label>
                        <div class="form-group"><table id="fileList"></table></div>
                    </div>
                </div>

                <div class="form-group required">
                    <label class="col-md-3 control-label">Courier</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="kurir" name="kurir" value="{{ $result[0]->courier }}" required />
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
                        <textarea class="form-control" rows="3" name="comment" form="formeditclaim"></textarea>
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
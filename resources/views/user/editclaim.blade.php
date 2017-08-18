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
        function ChooseProgram(data)
        {            
            var length = data.length;
            for(var i=0;i<length;i++)
            {
            if(data.value==jsArray[i].nama_program)
                {
                    var rupiah = '';        
                    var angkarev = jsArray[i].entitlement.toString().split('').reverse().join('');
                    for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
                    var entitlement = 'Rp '+rupiah.split('',rupiah.length-1).reverse().join('');
                    document.getElementById("entitlement").value = entitlement;
                }
            }
                        
        }
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
                output.innerHTML += '<td> - ' + input.files.item(i).name + ' </td>';
                // show size file: input.files.item(i).size
            }
            output.innerHTML += '</tr>';
        }
    </script>
  
    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <form action="{{ route('updateclaim') }}" method="post" role="form" class="form-horizontal" enctype="multipart/form-data" name="formeditclaim">
            {{csrf_field()}}
            <div class="box-header with-border">
                <h3 class="box-title">Edit Claim Reg No. {{ $result[0]->id_claim }}</h3>
                <input type="hidden" name="id_claim" value="{{ $result[0]->id_claim }}">
            </div>
            <div class="box-body">
                <div align="left">
                    <label style="color: red;"><small>* Indicates a required field</small></label>
                </div>                
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Category Claim Type</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="categoryclaimtype" name="categoryclaimtype" value="{{$category_now}}" readonly/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group required">
                        <label class="col-md-4 control-label">Program Name</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="programname" name="programname" value="{{ $result[0]->nama_program }}" readonly/>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-md-4 control-label">Program for Year</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="programyear" name="programyear" value="{{ $result[0]->programforyear }}" readonly/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- <div class="form-group required">
                        <label class="col-md-4 control-label">Category Type</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="categorytype" name="categorytype" value="{{ $result[0]->category_type }}" readonly/>
                        </div>
                    </div> -->
                    <div class="form-group">
                        <label class="col-md-4 control-label">Entitlement</label>
                        <div class="col-md-8">
                        <?php $entitlement=$result[0]->entitlement; ?>
                            <input type="text" class="form-control" id="entitlement" name="entitlement" value="Rp <?php echo number_format("$entitlement",0,',','.'); ?>" required="required" readonly/>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-md-4 control-label">Value</label>
                        <div class="col-md-8">
                        <?php $value=$result[0]->value; ?>
                            <input type="text" class="form-control" id="value" name="value" value="Rp <?php echo number_format("$value",0,',','.'); ?>" onkeyup="convertToRupiah(this);"/>
                        </div>
                    </div>
                </div>

                <div class="form-group required">
                    <label class="col-md-3 control-label">Attachment</label>
                    <div class="col-md-9">
                        <label class="custom-file">Payment Requisition Form<br>( {{ $result[0]->payment_form }} )
                            <input type="hidden" name="comparefile1" value="{{ $result[0]->payment_form }}">
                            <input type="file" id="file1" name="file1" class="custom-file-input">
                            <span class="custom-file-control"></span>
                        </label>
                        <label class="custom-file">Original Tax & Supplier Invoices<br>( {{ $result[0]->original_tax }} )
                            <input type="hidden" name="comparefile2" value="{{ $result[0]->original_tax }}">
                            <input type="file" id="file2" name="file2" class="custom-file-input">
                            <span class="custom-file-control"></span>
                        </label>
                        <label class="custom-file">AirwayBill Number<br>
                        (@if($result[0]->airwaybill==NULL) No file attached @else {{$result[0]->airwaybill}} @endif)
                            <input type="hidden" name="comparefile3" value="{{ $result[0]->airwaybill }}">
                            <input type="file" id="file3" name="file3" class="custom-file-input" <?php if($result[0]->airwaybill==NULL) echo 'required';?> accept="image/*, application/pdf">
                            <span class="custom-file-control"></span>
                        </label>
                        <label class="custom-file">Another Attachment
                            <input type="hidden" name="another" value="0">
                            <input type="file" id="another" name="another" class="custom-file-input" multiple onchange="updateList()">
                            <span class="custom-file-control"></span>
                            <table id="fileList">
                                <tr>
                                    <td><b>Selected Files:</b></td>
                                @foreach($attachment as $attachments)
                                    @if($result[0]->id_claim==$attachments->id_claim)
                                        <td>- {{ $attachments->nama_attachment }}</td>
                                    @endif
                                </tr>
                                @endforeach
                            </table>
                        </label>
                    </div>
                </div>

                <div class="form-group required">
                    <label class="col-md-3 control-label">Courier</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="courier" name="courier" value="{{ $result[0]->courier }}" required />
                    </div>
                </div>

                <div class="form-group required">
                    <label class="col-md-3 control-label">Document Completion</label>
                    <div class="col-md-9">
                        <div class="checkbox">
                            <label><input type="checkbox" value="1" name="checkbox1" required <?php if($result[0]->doc_check1==1) echo 'checked';?> readonly>Payment Requisition Form (Please attached the scanned document on this claim)</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value="1" name="checkbox2" required <?php if($result[0]->doc_check2==1) echo 'checked';?> readonly>Original Tax & Supplier Invoices. Tax must be addressed to PT Philips Indonesia (Please attached the scanned document on this claim)</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value="1" name="checkbox4" <?php if($result[0]->doc_check4==1) echo 'checked';?> readonly>Marketing Program Letter/BDF proposal Approval/Natura template</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value="1" name="checkbox5" <?php if($result[0]->doc_check5==1) echo 'checked';?> readonly>Marketing activity report with achievement</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value="1" name="checkbox6" <?php if($result[0]->doc_check6==1) echo 'checked';?> readonly>BP Invoice to Philips with BP signed & stamp</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value="1" name="checkbox7" <?php if($result[0]->doc_check7==1) echo 'checked';?> readonly>Marketing Activity Picture</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value="1" name="checkbox8" <?php if($result[0]->doc_check8==1) echo 'checked';?> readonly>Other supporting document</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value="1" name="checkbox3" <?php if($result[0]->doc_check3==1) echo 'checked';?> required>AirwayBill Number (Please attached the scanned document on this claim)</label>
                        </div>
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
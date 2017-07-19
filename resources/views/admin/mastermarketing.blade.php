@extends('layouts.backend-admin')

@section('content')

    <!-- Main content -->
    <section class="content">
    <div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <form action="#" method="post" role="form" class="form-horizontal" enctype="multipart/form-data" name="formnewmarketing">
            {{csrf_field()}}
            <div class="box-header with-border">
                <h3 class="box-title">Add Marketing</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label class="col-md-4 control-label">Distributor</label>
                    <div class="col-md-8">
                        <select class="form-control" id="distributor" name="distributor">
                            <option value="#">-- Please Choose One --</option>
                            <option value="1">Distributor A</option>
                            <option value="2">Distributor B</option>
                            <option value="3">Distributor C</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Program Name</label>
                    <div class="col-md-8">
                        <select class="form-control" id="program" name="program">
                            <option value="#">-- Please Choose One --</option>
                            <option value="1">Program A</option>
                            <option value="2">Program B</option>
                            <option value="3">Program C</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Entitlement</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="entitlement" name="entitlement" placeholder="" required="required" style="text-align: right;" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Max Claim Date</label>
                    <div class="col-md-8">
                        <input type="date" class="form-control" id="maxclaim" name="maxclaim" placeholder="" required="required" style="text-align: right;" />
                    </div>
                </div>
            </div>
            <div class="box-footer" align="right">
                <button type="reset" class="btn btn-ok">Reset</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>

    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">List Marketing</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Distributor ID</th>
                        <th>Program Name</th>
                        <th>Entitlement</th>
                        <th>Max Claim Date</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>tes</td>
                        <td>tes</td>
                        <td>tes</td>
                        <td>tes</td>
                        <td>tes</td>
                        <td>tes</td>
                        <td>tes</td>
                    </tr>
                    <tr>
                        <td>tes</td>
                        <td>tes</td>
                        <td>tes</td>
                        <td>tes</td>
                        <td>tes</td>
                        <td>tes</td>
                        <td>tes</td>
                    </tr>
                    <tr>
                        <td>tes</td>
                        <td>tes</td>
                        <td>tes</td>
                        <td>tes</td>
                        <td>tes</td>
                        <td>tes</td>
                        <td>tes</td>
                    </tr>
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
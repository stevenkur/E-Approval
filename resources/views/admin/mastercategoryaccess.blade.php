@extends('layouts.backend-admin')

@section('content')

    <!-- Main content -->
    <section class="content">
    <div class="row">
    <div class="col-md-4">
        <div class="box box-primary">
            <form action="#" method="post" role="form" class="form-horizontal" enctype="multipart/form-data" name="formnewclaim">
            {{csrf_field()}}
            <div class="box-header with-border">
                <h3 class="box-title">Add Category Access</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label class="col-md-6 control-label">User</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="email" name="email" placeholder="" required="required" style="text-align: right;" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-6 control-label">Category</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="email" name="email" placeholder="" required="required" style="text-align: right;" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-6 control-label">Role</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="email" name="email" placeholder="" required="required" style="text-align: right;" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-6 control-label">Auto Approve Day</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="email" name="email" placeholder="" required="required" style="text-align: right;" />
                    </div>
                </div>
            </div>
            <div class="box-footer" align="left">
                <button type="reset" class="btn btn-ok">Reset</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>

    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">List Category Access</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="holiday" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID Access</th>
                        <th>ID User</th>
                        <th>ID Category</th>
                        <th>ID Role</th>
                        <th>Auto Approve Day</th>
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
    $('#holiday').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  });
</script>
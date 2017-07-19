@extends('layouts.backend-admin')

@section('content')
    <script type="text/javascript">
        var i=2;
        $(document).on("click", '.addrow', function (){            
            newrow = '<div class="form-group"><label class="col-md-4 control-label">Email *</label><div class="col-md-8"><input type="text" class="form-control" id="email" name="email" placeholder="" required="required" style="text-align: right;" /></div>   </div>';                    
            $(this).parent().before(newrow);
            i++;      
        });
    </script>

    <!-- Main content -->
    <section class="content">
    <div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <form action="#" method="post" role="form" class="form-horizontal" enctype="multipart/form-data" name="formnewaccount">
            {{csrf_field()}}
            <div class="box-header with-border">
                <h3 class="box-title">Create Account</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label class="col-md-4 control-label">Primary Email</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="email" name="email" placeholder="" required="required" style="text-align: right;" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Name</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="name" name="name" placeholder="" required="required" style="text-align: right;" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Password</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="password" name="password" placeholder="" required="required" style="text-align: right;" />
                    </div>
                </div>
                <div class="col-md-12" align="center">
                    <button class="btn btn-primary addrow">Add Email CC</button>
                </div> 
            </div>

            <div class="box-footer" align="right">
                <button type="reset" class="btn btn-ok">Reset</button>
                @if($flag)
                <button type="submit" class="btn btn-primary">Update</button>
                @else
                <button type="submit" class="btn btn-primary">Submit</button>
                @endif
            </div>
            </form>
        </div>
    </div>

    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">List Account</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Password</th>
                        <th>Role</th>
                        <th>Distributor ID</th>
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
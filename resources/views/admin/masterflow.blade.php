@extends('layouts.backend-admin')

@section('content')
    <?php $i=0; ?>

    <script type="text/javascript">

        $(document).on("click", '.addrow', function (){   
    
            <?php ++$i; ?>
            newrow = '<div class="form-group"><label class="col-md-2 control-label">Flow Level <?php echo $i; ?></label><div class="col-md-4"><select class="form-control" id="role" name="role"><option value="#">-- Please Choose Role --</option><option value="1">Role A</option><option value="2">Role B</option><option value="3">Role C</option></select></div></div>';  

            $(this).parent().before(newrow);
        });
    </script>

    <!-- Main content -->
    <section class="content">
    <div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <form action="#" method="post" role="form" class="form-horizontal" enctype="multipart/form-data" name="formnewclaim">
            {{csrf_field()}}
            <div class="box-header with-border">
                <h3 class="box-title">Add Flow</h3>
            </div>
            
            <div class="box-body">
                <div class="form-group">
                    <label class="col-md-2 control-label">Flow Code</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="email" name="email" placeholder="" required="required" style="text-align: right;" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Flow Name</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="email" name="email" placeholder="" required="required" style="text-align: right;" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Flow Level <?php echo $i; ?></label>                    
                    <div class="col-md-4">
                        <select class="form-control" id="role" name="role">
                            <option value="#">-- Please Choose Role --</option>
                            @foreach($role as $roles)
                            <option value="{{ $roles->id_role }}">{{ $roles->nama_role }}</option>
                            @endforeach
                        </select>
                    </div>          
                </div>         
                <div class="col-md-12" align="center">
                    <button class="btn btn-primary addrow">Add Level</button>
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
                <h3 class="box-title">List Flow</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Flow Code</th>
                        <th>Flow Name</th>
                        <th>Flow Level</th>
                        <th>Role</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($flow as $flows)
                    <tr>
                        <td>{{ $flows->id_flow }}</td>
                        <td>{{ $flows->kode_flow }}</td>
                        <td>{{ $flows->level_flow }}</td>
                        <td>{{ $flows->nama_flow }}</td>
                        <td>{{ $flows->nama_role }}</td>
                        <td>edit</td>
                        <td>delete</td>
                    </tr>
                    @endforeach
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
@extends('layouts.backend-admin')

@section('content')

    <?php 
        if(isset($_GET['idrole'])){
            foreach($role as $roles){
                if($roles['id_role']==$_GET['idrole']){
                    $idrole = $roles['id_role'];
                    $namarole = $roles['nama_role'];
                 
                }
            }
            $flag=true;
        }
        else 
            $flag=false;
    ?>
    <!-- Main content -->
    <section class="content">
    <div class="row">
    <div class="col-md-4">
        <div class="box box-primary">
             @if($flag)
            <form action="{{ route('masterrole.update', $idrole) }}" method="post" role="form" class="form-horizontal" enctype="multipart/form-data" name="formnewrole">
            <input name="_method" type="hidden" value="PATCH">
            @else 
            <form action="{{ route('masterrole.store') }}" method="post" role="form" class="form-horizontal" enctype="multipart/form-data" name="formnewrole">
            <input name="_method" type="hidden" value="POST"> 
            @endif{{csrf_field()}}
            <div class="box-header with-border">
                <h3 class="box-title">Create Role</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Role</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="role" name="role" placeholder="" required="required" <?php if($flag) echo 'value='."'$namarole'"; ?> />
                    </div>
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

    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">List Role</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Role</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($role as $roles)
                    <tr>
                        <td>{{ $roles->id_role }}</td>
                        <td>{{ $roles->nama_role }}</td>
                        
                        <td><a class="btn btn-primary" type ="submit" href="./masterrole?idrole={{$roles->id_role}}">Edit</a></td>
                        <td>
                            {{ Form::open(array('url' => 'masterrole/' . $roles->id_role)) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('Delete', array('onclick'=>"return confirm('Anda yakin akan menghapus data ?');", 'class' => 'btn btn-danger')) }}
                            {{ Form::close() }}
                        </td>
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
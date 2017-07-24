@extends('layouts.backend-admin')

@section('content')

    <?php 
        
        if(isset($_GET['idaccess'])){
           
            for($i=0;$i<sizeof($categoryaccess);$i++){
                if( $categoryaccess[$i]->id_access==$_GET['idaccess']){
                    $idaccess =  $categoryaccess[$i]->id_access;
                    $idrole =  $categoryaccess[$i]->id_role;
                    $idcategory =  $categoryaccess[$i]->id_category;
                    $iduser =  $categoryaccess[$i]->id_user;
                    $autoapproved =  $categoryaccess[$i]->auto_approved;
                    break;
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
    <div class="col-md-6">
        <div class="box box-primary">
            @if($flag)
            <form action="{{ route('mastercategoryaccess.update', $idaccess) }}" method="post" role="form" class="form-horizontal" enctype="multipart/form-data" name="formnewcategoryaccess">
            <input name="_method" type="hidden" value="PATCH">
            @else 
            <form action="{{ route('mastercategoryaccess.store') }}" method="post" role="form" class="form-horizontal" enctype="multipart/form-data" name="formnewcategoryaccess">
            <input name="_method" type="hidden" value="POST">
            @endif
            {{csrf_field()}}
            <div class="box-header with-border">
                <h3 class="box-title">Add Category Access</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label class="col-md-4 control-label">User</label>
                    <div class="col-md-8">
                        <select class="form-control" id="user" name="user">
                            @foreach($user as $users)
                            <option value="{{ $users->id_user }}" <?php if($flag&&$iduser==$users->id_user) echo 'selected'; ?> >{{ $users->nama_user }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Category</label>
                    <div class="col-md-8">
                        <select class="form-control" id="category" name="category">
                            @foreach($category as $categories)
                            <option value="{{ $categories->id_category }}" <?php if($flag&&$idcategory==$categories->id_category) echo 'selected'; ?> >{{ $categories->nama_category }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Role</label>
                    <div class="col-md-8">
                        <select class="form-control" id="role" name="role">
                            @foreach($role as $roles)
                            <option value="{{ $roles->id_role }}" <?php if($flag&&$idrole==$roles->id_role) echo 'selected'; ?> >{{ $roles->nama_role }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Auto Approve Day</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="approveday" name="approveday" placeholder="" required="required" <?php if($flag) echo 'value='."'$autoapproved'"; ?> />
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

    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">List Category Access</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID Access</th>
                        <th>Nama User</th>
                        <th>Nama Role</th>
                        <th>Nama Category</th>
                        <th>Auto Approve Day</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categoryaccess as $category_accesses)
                    <tr>
                        <td>{{ $category_accesses->id_access }}</td>
                        <td>{{ $category_accesses->nama_user }}</td>
                        <td>{{ $category_accesses->nama_role }}</td>
                        <td>{{ $category_accesses->nama_category }}</td>
                        <td>{{ $category_accesses->auto_approved }}</td>
                        
                        <td><a class="btn btn-primary" type ="submit" href="./mastercategoryaccess?idaccess={{$category_accesses->id_access}}">Edit</a></td>
                        <td>
                            {{ Form::open(array('url' => 'mastercategoryaccess/' . $category_accesses->id_access)) }}
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
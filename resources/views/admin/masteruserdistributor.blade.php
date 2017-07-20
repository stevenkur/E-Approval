@extends('layouts.backend-admin')

@section('content')

    <?php
        if(isset($_GET['id_user_distributor'])){
            for($i=0; $i<sizeof($userdistributor); $i++ ){
                if($userdistributor[$i]->id_user_distributor==$_GET['id_user_distributor']){
                    $iduserdistributor = $userdistributor[$i]->id_user_distributor;
                    $iduser = $userdistributor[$i]->id_user;
                    $iddist = $userdistributor[$i]->id_dist;
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
            <form action="{{ route('masteruserdistributor.update', $iduserdistributor) }}" method="post" role="form" class="form-horizontal" enctype="multipart/form-data" name="formnewuserdistributor">
            <input name="_method" type="hidden" value="PATCH">
            @else 
            <form action="{{ route('masteruserdistributor.store') }}" method="post" role="form" class="form-horizontal" enctype="multipart/form-data" name="formnewuserdistributor">
            <input name="_method" type="hidden" value="POST">
            @endif
            {{csrf_field()}}
            <div class="box-header with-border">
                @if($flag)
                <h3 class="box-title">Update User Distributor</h3>
                @else
                <h3 class="box-title">Add User Distributor</h3>
                @endif
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
                    <label class="col-md-4 control-label">Distributor</label>
                    <div class="col-md-8">
                        <select class="form-control" id="distributor" name="distributor">
                            @foreach($distributor as $distributors)
                            <option value="{{ $distributors->id_dist }}" <?php if($flag&&$iddist==$distributors->id_dist) echo 'selected'; ?> >{{ $distributors->nama_distributor }}</option>
                            @endforeach
                        </select>
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
                <h3 class="box-title">List Distributor</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama User</th>
                        <th>Nama Distributor</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($userdistributor as $userdistributors)
                    <tr>
                        <td>{{ $userdistributors->id_user_distributor }}</td>
                        <td>{{ $userdistributors->nama_user }}</td>
                        <td>{{ $userdistributors->nama_distributor }}</td>
                        <td><a class="btn btn-primary" type ="submit" href="./masteruserdistributor?id_user_distributor={{$userdistributors->id_user_distributor}}">Edit</a></td>
                        <td>
                            {{ Form::open(array('url' => 'masteruserdistributor/' . $userdistributors->id_user_distributor)) }}
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
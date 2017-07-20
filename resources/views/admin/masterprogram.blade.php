@extends('layouts.backend-admin')

@section('content')
    
    <?php 
        if(isset($_GET['idprogram'])){
            foreach($program as $programs){
                if($programs['id_program']==$_GET['idprogram']){
                    $idprogram = $programs['id_program'];
                    $namaprogram = $programs['nama_program'];
                    $tahun = $programs['tahun'];
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
            <form action="{{ route('masterprogram.update', $idprogram) }}" method="post" role="form" class="form-horizontal" enctype="multipart/form-data" name="formnewprogram">
            <input name="_method" type="hidden" value="PATCH">
            @else 
            <form action="{{ route('masterprogram.store') }}" method="post" role="form" class="form-horizontal" enctype="multipart/form-data" name="formnewprogram">
            <input name="_method" type="hidden" value="POST">
            @endif
            {{csrf_field()}}
            <div class="box-header with-border">
                @if($flag)
                <h3 class="box-title">Update Program</h3>
                @else
                <h3 class="box-title">Add Program</h3>
                @endif
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label class="col-md-4 control-label">Program</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="program" name="program" placeholder="" required="required" <?php if($flag) echo 'value='."'$namaprogram'"; ?>/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Year</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="year" name="year" placeholder="" required="required" <?php if($flag) echo 'value='."'$tahun'"; ?>/>
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
                <h3 class="box-title">List Program</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Year</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($program as $programs)
                    <tr>
                        <td>{{ $programs->id_program }}</td>
                        <td>{{ $programs->nama_program }}</td>
                        <td>{{ $programs->tahun }}</td>
                        <td><a class="btn btn-primary" type ="submit" href="./masterprogram?idprogram={{$programs->id_program}}">Edit</a></td>
                        <td>
                            {{ Form::open(array('url' => 'masterprogram/' . $programs->id_program)) }}
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
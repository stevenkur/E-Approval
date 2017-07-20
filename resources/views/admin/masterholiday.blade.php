@extends('layouts.backend-admin')

@section('content')

    <?php 
        if(isset($_GET['idholiday'])){
            foreach($holiday as $holidays){
                if($holidays['id_holiday']==$_GET['idholiday']){
                    $idholiday = $holidays['id_holiday'];
                    $datename = $holidays['date_name'];
                    $tanggallibur = $holidays['tanggal_libur'];                 
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
            <form action="{{ route('masterholiday.update', $idholiday) }}" method="post" role="form" class="form-horizontal" enctype="multipart/form-data" name="formnewholiday">
            <input name="_method" type="hidden" value="PATCH">
            @else 
            <form action="{{ route('masterholiday.store') }}" method="post" role="form" class="form-horizontal" enctype="multipart/form-data" name="formnewholiday">
            <input name="_method" type="hidden" value="POST"> 
            @endif
            {{csrf_field()}}
            <div class="box-header with-border">
                @if($flag)
                <h3 class="box-title">Update Holiday</h3>
                @else
                <h3 class="box-title">Add Holiday</h3>
                @endif
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Date</label>
                    <div class="col-md-9">
                        <input type="date" class="form-control" id="date" name="date" placeholder="" required="required" <?php if($flag) echo 'value='."'$tanggallibur'"; ?>/>
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
                <h3 class="box-title">List Holiday</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Day</th>
                        <th>Date</th>
                        <th>Delete</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($holiday as $holidays)
                    <tr>
                        <td>{{ $holidays->id_holiday }}</td>
                        <td>{{ $holidays->date_name }}</td>
                        <td>{{ $holidays->tanggal_libur }}</td>
                        
                        <td><a class="btn btn-primary" type ="submit" href="./masterholiday?idholiday={{$holidays->id_holiday}}">Edit</a></td>
                        <td>
                            {{ Form::open(array('url' => 'masterholiday/' . $holidays->id_holiday)) }}
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
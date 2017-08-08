@extends('layouts.backend-admin')

@section('content')
    
    <?php 
        if(isset($_GET['idperiod'])){
            foreach($period as $periods){
                if($periods['id_period']==$_GET['idperiod']){
                    $idperiod = $periods['id_period'];
                    $tahun = $periods['tahun'];
                    $kuarter = $periods['kuarter'];
                    $bulan = $periods['bulan'];
                    $minggu = $periods['minggu'];
                    $startdate = $periods['start_date'];
                    $enddate = $periods['end_date'];

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
            <form action="{{ route('masterperiod.update', $idperiod) }}" method="post" role="form" class="form-horizontal" enctype="multipart/form-data" name="formnewperiod">
            <input name="_method" type="hidden" value="PATCH">
            @else 
            <form action="{{ route('masterperiod.store') }}" method="post" role="form" class="form-horizontal" enctype="multipart/form-data" name="formnewperiod">
            <input name="_method" type="hidden" value="POST">
            @endif
            {{csrf_field()}}
            <div class="box-header with-border">
                @if($flag)
                <h3 class="box-title">Update Period</h3>
                @else
                <h3 class="box-title">Add Period</h3>
                @endif
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label class="col-md-4 control-label">Tahun</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="tahun" name="tahun" placeholder="" required="required" <?php if($flag) echo 'value='."'$tahun'"; ?>/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Kuarter</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="kuarter" name="kuarter" placeholder="" required="required" <?php if($flag) echo 'value='."'$kuarter'"; ?>/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Bulan</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="bulan" name="bulan" placeholder="" required="required" <?php if($flag) echo 'value='."'$bulan'"; ?>/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Minggu</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="minggu" name="minggu" placeholder="" required="required" <?php if($flag) echo 'value='."'$minggu'"; ?>/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Start Date</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="startdate" name="startdate" placeholder="" required="required" <?php if($flag) echo 'value='."'$startdate'"; ?>/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">End Date</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="enddate" name="enddate" placeholder="" required="required" <?php if($flag) echo 'value='."'$enddate'"; ?>/>
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
                <h3 class="box-title">List Period</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tahun</th>
                        <th>Kuarter</th>
                        <th>Bulan</th>
                        <th>Minggu</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($period as $periods)
                    <tr>
                        <td>{{ $periods->id_period }}</td>
                        <td>{{ $periods->tahun }}</td>
                        <td>{{ $periods->kuarter }}</td>
                        <td>{{ $periods->bulan }}</td>
                        <td>{{ $periods->minggu }}</td>
                        <td>{{ $periods->start_date }}</td>
                        <td>{{ $periods->end_date }}</td>
                        <td><a class="btn btn-primary" type ="submit" href="./masterperiod?idperiod={{$periods->id_period}}">Edit</a></td>
                        <td>
                            {{ Form::open(array('url' => 'masterperiod/' . $periods->id_period)) }}
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
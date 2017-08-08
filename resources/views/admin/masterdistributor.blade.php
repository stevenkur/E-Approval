@extends('layouts.backend-admin')

@section('content')

    <?php 
        if(isset($_GET['id_dist'])){
            foreach($distributor as $distributors){
                if($distributors['id_dist']==$_GET['id_dist']){
                    $id_dist = $distributors['id_dist'];
                    $distributorid = $distributors['distributor_id'];
                    $namadistributor = $distributors['nama_distributor'];
                    $country = $distributors['country'];
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
            <form action="{{ route('masterdistributor.update', $id_dist) }}" method="post" role="form" class="form-horizontal" enctype="multipart/form-data" name="formnewdistributor">
            <input name="_method" type="hidden" value="PATCH">
            @else 
            <form action="{{ route('masterdistributor.store') }}" method="post" role="form" class="form-horizontal" enctype="multipart/form-data" name="formnewdistributor">
            <input name="_method" type="hidden" value="POST">
            @endif
            {{csrf_field()}}
            <div class="box-header with-border">
                @if($flag)
                <h3 class="box-title">Update Distributor</h3>
                @else
                <h3 class="box-title">Add Distributor</h3>
                @endif
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label class="col-md-4 control-label">Distributor ID</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="distributorid" name="distributorid" placeholder="" required="required" <?php if($flag) echo 'value='."'$distributorid'"; ?>/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Distributor Name</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="distributorname" name="distributorname" placeholder="" required="required" <?php if($flag) echo 'value='."'$namadistributor'"; ?>/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Country</label>
                    <div class="col-md-8">
                        <select class="form-control" id="country" name="country">
                            <option value="#">-- Please Choose One --</option>
                            <option value="Indonesia" <?php if($flag&& $country=='Indonesia') echo 'selected'; ?> >Indonesia</option>
                            <option value="Singapore" <?php if($flag&& $country=='Singapore') echo 'selected'; ?> >Singapore</option>
                            <option value="Malaysia" <?php if($flag&& $country=='Malaysia') echo 'selected'; ?> >Malaysia</option>
                            <option value="Phillipines" <?php if($flag&& $country=='Philippines') echo 'selected'; ?> >Philippines</option>
                            <option value="Thailand" <?php if($flag&& $country=='Thailand') echo 'selected'; ?> >Thailand</option>
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
                        <th>Distributor ID</th>
                        <th>Distributor Name</th>
                        <th>Country</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($distributor as $distributors)
                    <tr>
                        <td>{{ $distributors->id_dist }}</td>
                        <td>{{ $distributors->distributor_id }}</td>
                        <td>{{ $distributors->nama_distributor }}</td>
                        <td>{{ $distributors->country }}</td>
                        <td><a class="btn btn-primary" type ="submit" href="./masterdistributor?id_dist={{$distributors->id_dist}}">Edit</a></td>
                        <td>
                            {{ Form::open(array('url' => 'masterdistributor/' . $distributors->id_dist)) }}
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
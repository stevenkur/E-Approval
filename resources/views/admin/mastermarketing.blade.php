@extends('layouts.backend-admin')

@section('content')

    <?php 
        
        if(isset($_GET['idmarketing'])){
            
            for($i=0;$i<sizeof($marketing);$i++){
                if( $marketing[$i]->id_marketing==$_GET['idmarketing']){
                    $idmarketing =  $marketing[$i]->id_marketing;
                    $iddist =  $marketing[$i]->id_dist;
                    $idprogram =  $marketing[$i]->id_program;
                    $idcategory = $marketing[$i]->id_category;
                    $entitlement =  $marketing[$i]->entitlement;
                    $maxclaimdate =  $marketing[$i]->maxclaim_date;
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
            <form action="{{ route('mastermarketing.update', $idmarketing) }}" method="post" role="form" class="form-horizontal" enctype="multipart/form-data" name="formnewmarketing">
            <input name="_method" type="hidden" value="PATCH">
            @else 
            <form action="{{ route('mastermarketing.store') }}" method="post" role="form" class="form-horizontal" enctype="multipart/form-data" name="formnewmarketing">
            <input name="_method" type="hidden" value="POST">
            @endif
            {{csrf_field()}}
            <div class="box-header with-border">
                <h3 class="box-title">Add Marketing</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label class="col-md-4 control-label">Distributor</label>
                    <div class="col-md-8">
                        <select class="form-control" id="distributor" name="distributor">
                            @foreach($distributor as $distributors)
                            <option value="{{ $distributors->id_dist }}" <?php if($flag&&$iddist==$distributors->id_dist) echo 'selected'; ?> >{{ $distributors-> nama_distributor }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Program Name</label>
                    <div class="col-md-8">
                        <select class="form-control" id="program" name="program">
                            @foreach($program as $programs)
                            <option value="{{ $programs->id_program }}" <?php if($flag&&$idprogram==$programs->id_program) echo 'selected'; ?> >{{ $programs-> nama_program }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-md-4 control-label">Category Name</label>
                    <div class="col-md-8">
                        <select class="form-control" id="category" name="category">
                            @foreach($category as $categories)
                            <option value="{{ $categories->id_category }}" <?php if($flag&&$idcategory==$categories->id_category) echo 'selected'; ?> >{{ $categories-> nama_category }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Entitlement</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="entitlement" name="entitlement" placeholder="" required="required" <?php if($flag) echo 'value='."'$entitlement'"; ?> />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Max Claim Date</label>
                    <div class="col-md-8">
                        <input type="date" class="form-control" id="maxclaim" name="maxclaim" placeholder="" required="required" <?php if($flag) echo 'value='."'$maxclaimdate'"; ?> />
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
                <h3 class="box-title">List Marketing</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID Marketing</th>
                        <th>Nama Distributor</th>
                        <th>Program Name</th>
                        <th>Category Name</th>
                        <th>Entitlement</th>
                        <th>Max Claim Date</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($marketing as $marketings)
                    <tr>
                        <td>{{ $marketings->id_marketing }}</td>
                        <td>{{ $marketings->nama_distributor }}</td>
                        <td>{{ $marketings->nama_program }}</td>
                        <td>{{ $marketings->nama_category }}</td>
                        <td>{{ $marketings->entitlement }}</td>
                        <td>{{ $marketings->maxclaim_date }}</td>
                        
                        <td><a class="btn btn-primary" type ="submit" href="./mastermarketing?idmarketing={{$marketings->id_marketing}}">Edit</a></td>
                        <td>
                            {{ Form::open(array('url' => 'mastermarketing/' . $marketings->id_marketing)) }}
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
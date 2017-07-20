@extends('layouts.backend-admin')

@section('content')


    <?php 
        $namacategory=0;
        if(isset($_GET['idcategorydetail'])){
            foreach($categorydetail as $categorydetails){
                if($categorydetails['id_categorydetail']==$_GET['idcategorydetail']){
                    $idcategorydetail = $categorydetails['id_categorydetail'];
                    $namacategory = $categorydetails['nama_category'];
                    $categorytype = $categorydetails['category_type'];
                 
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
    <div class="col-md-5">
        <div class="box box-primary">
            @if($flag)
            <form action="{{ route('mastercategorydetail.update', $idcategorydetail) }}" method="post" role="form" class="form-horizontal" enctype="multipart/form-data" name="formnewcategorydetail">
            <input name="_method" type="hidden" value="PATCH">
            @else 
            <form action="{{ route('mastercategorydetail.store') }}" method="post" role="form" class="form-horizontal" enctype="multipart/form-data" name="formnewcategorydetail">
            <input name="_method" type="hidden" value="POST"> 
            @endif{{csrf_field()}}
            <div class="box-header with-border">
                <h3 class="box-title">Add Category</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label class="col-md-4 control-label">Category Name</label>
                    <div class="col-md-8">
                        <select class="form-control" id="category" name="category">
                             @foreach($category as $categories)
                             <option value="{{ $categories->nama_category }}" <?php if($flag&& $namacategory==$categories->nama_category) echo 'selected'; ?> >{{ $categories->nama_category}}</option>
                             @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Category Type</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="categorytype" name="categorytype" placeholder="" required="required" <?php if($flag) echo 'value='."'$categorytype'"; ?> />
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

    <div class="col-md-7">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">List Category Detail</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category Name</th>
                        <th>Category Type</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categorydetail as $categorydetails)
                    <tr>
                        <td>{{ $categorydetails->id_categorydetail }}</td>
                        <td>{{ $categorydetails->nama_category }}</td>
                        <td>{{ $categorydetails->category_type }}</td>
                        
                        <td><a class="btn btn-primary" type ="submit" href="./mastercategorydetail?idcategorydetail={{$categorydetails->id_categorydetail}}">Edit</a></td>
                        <td>
                            {{ Form::open(array('url' => 'mastercategorydetail/' . $categorydetails->id_categorydetail)) }}
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
@extends('layouts.backend-admin')

@section('content')
    
    <!-- Main content -->
    <section class="content">
    <center>
        <div class="box box-primary">
        <form role="form" action="{{ route('queryresult') }}" method="post" id="formquery">
        {{csrf_field()}}
            <div class="box-header with-border">
                <h3 class="box-title">Put your query down here...</h3>
      	    </div>
      		  <div class="box-body col-lg-12">    
            		<textarea class="form-control" rows="10" name="query" form="formquery"></textarea>
      		  </div>
      		  <div class="box-footer">
                <button type="reset" class="btn btn-ok">Reset</button>
                <button type="submit" class="btn btn-primary">Query</button>
      		  </div>
        </form>
        </div>
    </center>
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
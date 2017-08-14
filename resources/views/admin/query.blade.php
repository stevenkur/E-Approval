@extends('layouts.backend-admin')

@section('content')
    
    <!-- Main content -->
    <section class="content">
    <center>
        <div class="box box-primary">
        <form role="form" action="{{ route('queryresult') }}" method="post" name="formquery" id="formquery">
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
        @if(isset($Message))
          <div class="alert alert-success" id="success-alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ $Message }}
          </div>
        @endif
        @if(isset($result))
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Hasil Query</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive" style="overflow:auto">
              <table id="table" class="table table-bordered table-striped">
              <thead>
                  <tr>
                      @for ($j=0; $j<$length; $j++)
                      <th>{{ $key[$j] }}</th>
                      @endfor
                  </tr>
              </thead>
              <tbody>
              @for($i=0; $i<$length_hasil; $i++)
                @for ($j=0; $j<$length; $j++)
                  <td>{{ $result[$i]->$key[$j] }}</td>

                @endfor
                <tr></tr>
              @endfor
              </tbody>
              </table>
            </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        @endif
    </center>
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
window.setTimeout(function() {
    $("#success-alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 3000);
</script>
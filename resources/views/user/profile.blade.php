@extends('layouts.backend')

@section('content')

    <!-- Main content -->
    <section class="content">
		    	@if(isset($Message))
					<div class="alert alert-success">
			        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			        {{ $Message }}
			        </div>
		        @endif
		        @if(isset($FailOldMessage))
					<div class="alert alert-danger">
			        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			        {{ $FailOldMessage }}
			        </div>
		        @endif
		        @if(isset($FailConfirmMessage))
					<div class="alert alert-danger">
			        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			        {{ $FailConfirmMessage }}
			        </div>
		        @endif
        <div class="box box-primary">
      		<form class="form-horizontal" role="form" action="{{ route('profilechange') }}" method="post">
      		{{csrf_field()}}
      	    <div class="box-header with-border">
      	    	<h3 class="box-title">Change Password</h3>
	        </div>
		    <div class="box-body">
				<div class="form-group">
				    <label class="control-label col-sm-2">Email</label>
				    <div class="col-sm-4">
						<input type="text" class="form-control" id="email" name="email" value="{{ $user[0]->email }}" disabled>
				    	
				    </div>
			    </div>
			    <div class="form-group">
				    <label class="control-label col-sm-2">Name</label>
				    <div class="col-sm-4">          
						<input type="text" class="form-control" id="name" name="name" value="{{ $user[0]->nama_user }}" disabled>
				    </div>
			    </div>
			    <div class="form-group">
				    <label class="control-label col-sm-2">Old Password</label>
				    <div class="col-sm-4">
						<input type="password" class="form-control" id="old" name="old" value="">
				    </div>
			    </div>
			    <div class="form-group">
				    <label class="control-label col-sm-2">New Password</label>
				    <div class="col-sm-4">
						<input type="password" class="form-control" id="new" name="new" value="">
				    </div>
			    </div>
			    <div class="form-group">
				    <label class="control-label col-sm-2">Confirm New Password</label>
				    <div class="col-sm-4">
						<input type="password" class="form-control" id="confirm" name="confirm" value="">
				    </div>
			    </div>			    
		    </div>
		    <div class="box-footer" align="left">
		    	<button type="reset" class="btn btn-ok">Reset</button>
		    	<button type="submit" class="btn btn-primary" >Update</button>
		    </div>
      		</form>
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
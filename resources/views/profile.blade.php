@extends('layouts.backend')

@section('content')

      <!-- Main content -->
      <section class="content">
        <div class="box box-primary">
      	  <form role="form" action="" method="post">
      	  {{csrf_field()}}
      	    <div class="box-header with-border">
      	      <h3 class="box-title">Change Password</h3>
	        </div>
		    <div class="box-body">
		      <div class="form-group col-lg-12">
		      	<label class="col-lg-2"> Email </label>
		      	<label class="col-lg-1"> : </label>
		      	<input type="text" id="email" name="email" value="test@email.com" style="width:250px;text-align: right;" disabled>
		      </div>
		      <div class="form-group col-lg-12">
		        <label class="col-lg-2"> Name </label>
		        <label class="col-lg-1"> : </label>
		        <input type="text" id="name" name="name" value="Full Name" style="width:250px;text-align: right;">
		      </div>
		      <div class="form-group col-lg-12">
		        <label class="col-lg-2"> Old Password </label>
		        <label class="col-lg-1"> : </label>
		        <input type="password" id="old" name="old" style="width:250px;text-align: right;">
		      </div>
		      <div class="form-group col-lg-12">
		        <label class="col-lg-2"> New Password </label>
		        <label class="col-lg-1"> : </label>
		        <input type="password" id="new" name="new" style="width:250px;text-align: right;">
		      </div>
		      <div class="form-group col-lg-12">
		        <label class="col-lg-2"> Confirm New Password </label>
		        <label class="col-lg-1"> : </label>
		        <input type="password" id="confirm" name="confirm" style="width:250px;text-align: right;">
		      </div>
		    </div>
		    <div class="box-footer" align="left">
		      <button type="reset" class="btn btn-ok">Reset</button>
		      <button type="submit" class="btn btn-primary">Update</button>
		    </div>
      	  </form>
        </div>
      </section>
      <!-- /.content -->

@stop

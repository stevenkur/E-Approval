@extends('layouts.backend-admin')

@section('content')

    <?php
        if(isset($_GET['id_user'])){            
            for($k=0;$k<sizeof($user);$k++){
                if($user[$k]->id_user==$_GET['id_user']){
                    $id_user = $user[$k]->id_user;
                    $nama_user = $user[$k]->nama_user;
                    $email = $user[$k]->email;
                    $password = $user[$k]->password;

                    for($i=2;$i<=9;$i++)
                    {
                        $var = 'email'.$i;
                        if($user[$k]->$var!=NULL)
                        {
                            $var = $user[$k]->$var;
                        }
                    }
                }
                break;
            }
            $flag=true;
            $id_user = $_GET['id_user'];
        }
        else 
            $flag=false;
    ?>

    <script type="text/javascript">        
        i=2;
        $(document).on("click", '.addrow', function (){   
            newrow = '<div class="form-group"><label class="col-md-4 control-label">Email ' + i + '</label><div class="col-md-8"><input type="text" class="form-control" id="email' + i + '" name="email' + i + '" placeholder="" /></div></div>';  

            if(i==9)
            {
                document.getElementById('addemail').style.visibility = 'hidden';
            }
            
            i++;
            $(this).parent().before(newrow);
        });
    </script>

    <!-- Main content -->
    <section class="content">
    <div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            @if($flag)
            <form action="{{ route('masteraccount.update', $id_user) }}" method="post" role="form" class="form-horizontal" enctype="multipart/form-data" name="formupdateaccount">
            <input name="_method" type="hidden" value="PATCH">
            @else
            <form action="{{ route('masteraccount.store') }}" method="post" role="form" class="form-horizontal" enctype="multipart/form-data" name="formnewaccount">
            <input name="_method" type="hidden" value="POST">
            @endif
            {{csrf_field()}}
            <div class="box-header with-border">
                @if($flag)
                <h3 class="box-title">Update Account</h3>
                @else
                <h3 class="box-title">Create Account</h3>
                @endif
            </div>
            <div class="box-body">            
                <div class="row">
                <div class="col-md-5"><br>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Primary Email</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="email" name="email" placeholder="" required <?php if($flag) echo 'value='."'$email'"; ?>/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Name</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="name" name="name" placeholder="" required <?php if($flag) echo 'value='."'$nama_user'"; ?>/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Password</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="password" name="password" placeholder="" required <?php if($flag) echo 'value='."'$password'"; ?>/>
                        </div>
                    </div>
                    @if($flag)            
                    @for($i=2;$i<=9;$i++)      
                    <div class="form-group">
                        <label class="col-md-4 control-label">Email {{ $i }}</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="email{{$i}}" name="email{{$i}}" placeholder="" />
                        </div>
                    </div>
                    @endfor
                    @endif     
                    <div class="col-md-12" align="center">
                        <a id="addemail" class="btn btn-primary addrow">Add Email CC</a>
                    </div> 
                </div>
                <div class="col-md-7">
                    <table id="tableinput" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Checklist</th>
                            <th>Department</th>
                            <th>Auto Approve Day</th>
                            <th>Role</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($category as $categories)
                        <tr>
                            <td align="center"><input type="hidden" value="0" name="checklist{{ $categories->id_category }}"><input type="checkbox" value="{{ $categories->id_category }}" name="checklist{{ $categories->id_category }}"></td>
                            <td>{{ $categories->nama_category }}</td>
                            <td align="center"><input class="form-control" type="text" name="autoapproved{{ $categories->id_category }}" style="width: 75px;"></td>
                            <td>
                                <select class="form-control" id="role{{ $categories->id_category }}" name="role{{ $categories->id_category }}">
                                    <option value="#" >Please Choose one</option>
                                    @foreach($role as $roles)
                                    <option value="{{ $roles->id_role }}">{{ $roles->nama_role }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
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
                <h3 class="box-title">List Account</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive" style="overflow:auto">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Password</th>
                        <th>Category</th>
                        <th>Role</th>
                        <th>Distributor ID</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user as $users)
                    <tr>
                        <td>{{ $users->email }}</td>
                        <td>{{ $users->nama_user }}</td>
                        <td>{{ $users->password }}</td>
                        <td>{{ $users->category }}</td>
                        <td>{{ $users->role }}</td>
                        <td>{{ $users->distributor }}</td>
                        <td><a class="btn btn-primary" type="submit" href="./masteraccount?id_user={{$users->id_user}}">Edit</a></td>
                        <td>
                            {{ Form::open(array('url' => 'masteraccount/' . $users->id_user)) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('Delete', array('onclick'=>"return confirm('Anda yakin akan menghapus data ?');", 'class' => 'btn btn-danger')) }}
                            {{ Form::close() }}
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
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
    $('#tableinput').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : false,
      'info'        : false,
      'autoWidth'   : false
    })
  });
</script>
@extends('layouts.backend-admin')

@section('content')
     
    <?php 
        
        if(isset($_GET['kodeflow'])){
            $idflow = [];
            $idrole = [];
            $levelflow = [];
            $namarole = [];
            $idflow[0] = 0;
            for($i=0;$i<sizeof($flow);$i++){
                if( $flow[$i]->kode_flow==$_GET['kodeflow']){

                    $idflow[] =  $flow[$i]->id_flow;
                    $idrole[] =  $flow[$i]->id_role;
                    $kodeflow =  $flow[$i]->kode_flow;
                    $levelflow[] =  $flow[$i]->level_flow;
                    $namaflow =  $flow[$i]->nama_flow;
                    $namarole[] = $flow[$i]->nama_role;
                }
            }
            $flag=true;
            $length= sizeof($idflow)-1;
            // dd($idflow);
        }
        else 
            $flag=false;
    ?>


    <script type="text/javascript">        
        i=2;
        $(document).on("click", '.addrow', function (){   
            newrow = '<div class="form-group"><label class="col-md-2 control-label">Flow Level ' + i + '</label><div class="col-md-4"><select class="form-control" id="flow' + i + '" name="flow' + i + '"><option value="#">-- Please Choose Role --</option>@foreach($role as $roles)<option value="{{ $roles->id_role }}">{{ $roles->nama_role }}</option>@endforeach</select></div></div>';  

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

            <form action="{{ route('masterflow.update', $idflow) }}" method="post" role="form" class="form-horizontal" enctype="multipart/form-data" name="formnewflow">
            <input name="_method" type="hidden" value="PATCH">
            @else 
            <form action="{{ route('masterflow.store') }}" method="post" role="form" class="form-horizontal" enctype="multipart/form-data" name="formnewflow">
            <input name="_method" type="hidden" value="POST">
            @endif
            {{csrf_field()}}
            <div class="box-header with-border">
                <h3 class="box-title">Add Flow</h3>
            </div>
            
            <div class="box-body">
                <div class="form-group">
                    <label class="col-md-2 control-label">Flow Code</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="flowcode" name="flowcode" placeholder="" required="required" <?php if($flag) echo 'value='."'$kodeflow'"; ?> />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Flow Name</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="flowname" name="flowname" placeholder="" required="required" <?php if($flag) echo 'value='."'$namaflow'"; ?> />
                    </div>
                </div>
                <div class="form-group">
                    
                    @if($flag)            
                    @for($i=0;$i<$length;$i++)      
                    <label class="col-md-2 control-label">Flow Level <?php echo $i+1; ?></label> 
                    <div class="col-md-4">                        
                        <select class="form-control" id="{{'flow'.$i+1}}" name="{{'flow'.$i}}">
                            @foreach($role as $roles)                            
                            <option value="{{ $roles->id_role }}" <?php if($namarole[$i]==$roles->nama_role) echo 'selected'; ?>> {{ $roles->nama_role }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <br>

                    @endfor
                    @else
                    <label class="col-md-2 control-label">Flow Level 1</label> 
                    <div class="col-md-4">
                        <select class="form-control" id="flow1" name="flow1">
                            <option value="#">-- Please Choose Role --</option>
                            @foreach($role as $roles)
                            <option value="{{ $roles->id_role }}" >{{ $roles->nama_role }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif          
                </div>         
                <div class="col-md-12" align="center">
                    <a class="btn btn-primary addrow">Add Level</a>
                </div> 
            </div>
            <div class="box-footer" align="right">
                <button type="reset" class="btn btn-ok">Reset</button>
                
                <button type="submit" class="btn btn-primary">Submit</button>
               
            </div>
            </form>
        </div>
    </div>

    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">List Flow</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Flow Code</th>
                        <th>Flow Name</th>
                        <th>Flow Level</th>
                        <th>Role</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($flow as $flows)
                    <tr>
                        <td>{{ $flows->id_flow }}</td>
                        <td>{{ $flows->kode_flow }}</td>
                        <td>{{ $flows->nama_flow }}</td>
                        <td>{{ $flows->level_flow }}</td>
                        
                        <td>{{ $flows->nama_role }}</td>
                         <td><a class="btn btn-primary" type ="submit" href="./masterflow?kodeflow={{$flows->kode_flow}}">Edit</a></td>
                       
                        <td>
                            {{ Form::open(array('url' => 'masterflow/' . $flows->id_flow)) }}
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
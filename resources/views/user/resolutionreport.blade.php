@extends('layouts.backend')

@section('content')

<?php
    $category = Session::get('nama_category');
    $category_length = sizeof(Session::get('nama_category'));
    $tes=0; 
//     dd($register);
?>  
    <section class="content">
    
    @for($i=0;$i<$category_length;$i++)
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Resolution Report {{$category[$i]}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="overflow:auto">
                <table id="{{'table'.$category[$i]}}" class="table table-bordered table-striped" >
                    <thead>
                    <?php $role_length = sizeof($role[$i]);
                    ?>
                    <tr>
                        <th>ID Claim</th>
                        <th>Program</th>
                        <th>Register</th>
                        @for($j=0;$j<$role_length;$j++)
                            <th> {{ $role[$i][$j]->nama_role }} </th>
                        @endfor
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @if(isset($list[$i]))
                                @foreach($list[$i] as $lists)
                                <td> {{$lists['id_claim']}} </td>
                                <td> {{$lists['program']}} </td>
                                <td> {{date('d-m-Y', strtotime($lists['register']))}}</td>

                                    @for($j=0;$j<$role_length;$j++)
                                        @if($lists[$role[$i][$j]->nama_role]!=null)
                                        <th> {{date('d-m-Y', strtotime($lists[$role[$i][$j]->nama_role]['date']))}} <br> {{'('.$lists[$role[$i][$j]->nama_role]['interval'].' days)'}}</th>
                                        @else
                                        <th> - </th>
                                        @endif
                                    @endfor
                                @endforeach
                            @else
                                <tr><td>No Data Available</td></tr>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    @endfor
    </section>

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

<script>
$(function() {
    $('#tableBDF').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  });
$(function() {
    $('#tableMarcom').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  });
$(function() {
    $('#tableRDP').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  });
$(function() {
    $('#tableNatura').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  });
</script>
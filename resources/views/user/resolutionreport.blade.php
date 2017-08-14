@extends('layouts.backend')

@section('content')

<?php
    $category = Session::get('nama_category');
    $category_length = sizeof(Session::get('nama_category'));

    // dd($category);
?>  
    <section class="content">
    
    @for($i=0;$i<$category_length;$i++)
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Resolution Report {{$category[$i]}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="{{'table'.$category[$i]}}" class="table table-bordered table-striped" >
                    <thead>
                    <?php $role_length = sizeof($role[$i]);
                    ?>
                    <tr>
                        <th>ID Claim</th>
                        <th>Program</th>
                        @for($j=0;$j<$role_length;$j++)
                            <th> {{ $role[$i][$j]->nama_role }} </th>
                        @endfor
                    </tr>
                    </thead>
                    <tbody>
                    <?php $claim_length = sizeof($claim[$i]);
                          if($claim_length!=0) $id_length = sizeof($date[$i]);
                          else $id_length=0;
                          $count=1;

                    ?>
                    <tr>
                        @for($k=0;$k<$claim_length;$k=$k+$count)
                        <td> {{$claim[$i][$k]->id_claim}} </td>
                        <td> {{$claim[$i][$k]->nama_program}} </td>
                        <td> {{ date('d F Y', strtotime($claim[$i][$k]->created_at)) }}</td>
                        <?php $id=$claim[$i][$k]->id_claim; ?>
                        @for($l=0;$l<$role_length-1;$l++)
                            @if (isset($date[$i][$id][$l+1]))
                            <td> {{ date('d-m-Y', strtotime($claim[$i][$k+$l+1]->created_at)) }} ( {{$date[$i][$id][$l+1]}} days )</td>
                            <?php $count++; ?>
                            @else <td>-</td>
                            @endif
                        @endfor
                        
                        <tr> </tr>
                        @endfor
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
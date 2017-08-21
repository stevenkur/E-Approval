@extends('layouts.backend')

@section('content')

<?php
    $category = Session::get('nama_category');
    $category_length = sizeof(Session::get('nama_category'));
    $tes=0; 
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
                        <th>Register</th>
                        @for($j=0;$j<$role_length;$j++)
                            <th> {{ $role[$i][$j]->nama_role }} </th>
                        @endfor
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                      $claim_length = sizeof($claim[$i]);
                      if($claim_length!=0) $id_length = sizeof($date[$i]);
                      else $id_length=0;
                      $count=1;
                    ?>
                    <tr>
                        
                        @for($k=0;$k<$claim_length;$k=$k+$count)
                        <td> {{$claim[$i][$k]->id_claim}} </td>
                        <td> {{$claim[$i][$k]->nama_program}} </td>
                        <td> {{ date('d-m-Y', strtotime($register[$i][$k]->created_at)) }}</td>
                        <?php $id=$claim[$i][$k]->id_claim; 
                          $jumlah=0;
                          // dd($claim);
                        ?>
                        
                        @for($l=0;$l<$role_length;$l++)
                              <?php echo $claim[$i][$tes]->nama_role;
                                    echo $role[$i][$l]->nama_role;
                                    echo '<br>';
                                    // dd($claim);
                                    echo $claim_length;
                                    echo '<br>';
                                    echo $tes;
                                    echo $count;
                                    echo $jumlah;

                                    echo '<br>';
                                    if($tes=$claim_length) $tes=0;
                              ?>
                            @if($claim[$i][$tes]->nama_role = $role[$i][$l]->nama_role)
                              @if (isset($date[$i][$id][$jumlah]))
                              <td> {{ date('d-m-Y', strtotime($claim[$i][$tes]->created_at)) }} ( {{$date[$i][$id][$jumlah]}} days )</td>
                              <?php $count++; $jumlah++; $tes++;?>
                              
                              @else <td>-</td>
                              @endif
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
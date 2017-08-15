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
                    @if($date[$i]!=0)
                    <?php $claim_length = sizeof($claim[$i]);
                          if($claim_length!=0) $id_length = sizeof($date[$i]);
                          else $id_length=0;
                          $count=1;
                          $tes=0;
                          // dd($claim);
                    ?>
                    <tr>
                        @for($k=0;$k<$claim_length;$k=$k+$count)
                            
                        <td> {{$claim[$i][$k]->id_claim}} </td>
                        <td> {{$claim[$i][$k]->nama_program}} </td>
                         <?php $id=$claim[$i][$k]->id_claim; 
                            $count=1;
                            $jumlah= sizeof($date[$i][$id]);
                            // dd($jumlah);
                        ?>
                        
                        @for($l=0;$l<$role_length;$l++)
                            <?php                             
                            $roleflow = $claim[$i][$tes]->nama_role;
                            // dd($claim);
                              ?>
                            
                            @if($jumlah == 0) <?php$tes=0;?>
                            @endif
                            @if($roleflow=='Distributor' && $jumlah!=0)
                            <td> {{ date('d-m-Y', strtotime($claim[$i][$k]->created_at)) }}</td>
                            <?php $tes++; ?>
                            @else
                            @if($roleflow == $role[$i][$l]->nama_role)
                            @if (isset($date[$i][$id][$tes]))
                            <td> {{ date('d-m-Y', strtotime($claim[$i][$k+$l+1]->created_at)) }} ( {{$date[$i][$id][$tes]}} days )</td>
                            <?php $count++; 
                                  $tes++;
                                  $jumlah--;
                            ?>
                            @else <td>-</td>
                            @endif
                            @else <td>-</td>
                            @endif
                            @endif
                        @endfor
                        
                        <tr> </tr>
                        @endfor
                    </tr>
                    @else 
                    <td> No Data Available</td>
                    <td> - </td>
                    @for($j=0;$j<$role_length;$j++)
                            <td> - </td>
                    @endfor
                    @endif

                   
                    
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

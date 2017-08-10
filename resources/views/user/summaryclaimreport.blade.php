@extends('layouts.backend')

@section('content')
  
    <section class="content">
    

    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Summary Claim Report Per Program</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Nama Distributor</th>
                        <th>Program Name</th>
                        <th>Entitlement</th>
                        <th>Max Claim Date</th>
                        <th>Pending</th>
                        <th>Closed</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($marketing as $marketings)
                    <tr>
                        <td>{{ $marketings->nama_distributor }}</td>
                        <td>{{ $marketings->nama_program }}</td>
                        <td>{{ $marketings->entitlement }}</td>
                        <td>{{ $marketings->maxclaim_date }}</td>
                        <td>{{ $marketings->Pending  }} </td>
                        <td> {{ $marketings->Closed  }}  </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
         <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Summary Claim Report Per Category</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Nama Distributor</th>
                        <th>Category Name</th>
                        <th>Entitlement</th>
                        <th>Pending</th>
                        <th>Closed</th>
                    </tr>
                    </thead>
                    <tbody>                   
                    @foreach($market as $markets)
                    <tr>
                        <td>{{ $markets->nama_distributor }}</td>
                        <td>{{ $markets->nama_category }}</td>
                        <td>{{ $markets->entitlement }}</td>
                        <td> {{ $markets->Pending }} </td>
                        <td> {{ $markets->Closed }} </td>
                    </tr>
                    @endforeach   
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>

    
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
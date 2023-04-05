@extends('dashboard')
@section('content')
<div class="card">
  <div class="card-body overflow-hidden p-lg-6" style="overflow-x: auto !important;overflow-y: auto !important;">
      <div class="row align-items-center">
          
              <h3 class="text" style="padding-bottom:20px;color:#00A651;">Insentif Usahawan</h3>
              <table id="insentiftbl">
                  <colgroup>
                      <col span="1" style="width: 35%;">
                      <col span="1" style="width: 15%;">
                      <col span="1" style="width: 35%;">
                      <col span="1" style="width: 15%;">
                   </colgroup>
                  <style>
                      .dataTable-dropdown{
                          display: inline;
                          padding-right:10vh;
                      }
                      .dataTable-search{
                          display: inline;
                      }
                      ul {
                          list-style-type: none;
                      }
                      .dataTable-pagination-list{
                          display: inline-flex;
                      }
                      .active{
                          padding-right: 5px;
                      }
                      .dataTable-bottom{
                          padding-top: 3vh;
                      }
                  </style>
                  <thead>
                      <tr class="align-middle">
                            <th scope="col">Nama</th>
                            <th scope="col">No. KP</th>
                            <th scope="col">Pusat Tanggungjawab</th>
                            <th scope="col">Kemaskini Insentif</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($users as $user)
                      <tr class="align-middle">
                          <td class="text-nowrap"><label class="form-check-label">{{$user->namausahawan}}</label></td>
                          <td class="text-nowrap"><label class="form-check-label">{{$user->nokadpengenalan}}</label></td>
                          <td class="text-nowrap"><label class="form-check-label">@if(isset($user->PT)){{$user->PT->keterangan}}@endif</label></td>
                          <td class="text-nowrap"><button class="btn btn-falcon-default btn-warning btn-sm me-1 mb-1" type="button" onclick="window.location.href='/insentifdetail/{{$user->usahawanid}}'">
                              Kemaskini
                          </button></td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
          
      </div>
  </div>
</div>
@endsection
@section('script')
<script type="text/javascript">

$( document ).ready(function() {
    var table = $('#insentiftbl').DataTable({
        "paging":   true,
        "bFilter": true,
        "language": {
            "lengthMenu": "_MENU_ rekod setiap paparan",
            "zeroRecords": "Maaf - Tiada data dijumpai",
            "info": "Menunjukkan _PAGE_ daripada _PAGES_ paparan",
            "infoEmpty": "Tiada rekod dijumpai",
            "infoFiltered": "(ditapis daripada _MAX_ jumlah rekod)",
            "sSearch": "Saringan :",
            "paginate": {
                "previous": "Sebelum",
                "next": "Seterusnya"
            }
        }
    });
    $('.loader').hide();
    // console.log(<?php echo $users; ?>);
});

</script>
@endsection
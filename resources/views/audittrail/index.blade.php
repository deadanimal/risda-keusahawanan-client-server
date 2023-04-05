@extends('dashboard')
@section('content')
<div class="card">
    <div class="card-header bg-light" style="text-align: center;">
      <h5 class="mb-0" style="display: inline-block; padding-right:2vh">Audit Trail</h5><input style="width:45vh;" type="text" class="form-control-sm" name="daterange"/>
    </div>
    <div class="card-body fs--1 p-0" style="padding:30px !important;">
      <style>
        ul {
              list-style-type: none;
          }
      </style>
      <table id="audittbl" style="padding: 1rem" class="table table-borderless">
        <thead>
          <tr>
            <th>Tarikh</th>
            <th>Aktiviti</th>
          </tr>
        </thead>
        <tbody id="tblname">
          @foreach ($Audits as $Audit)
          <tr class="border-bottom-0 rounded-0 border-x-0 border border-300">
            <td class="notification-time">{{date("d-m-Y h:ia", strtotime($Audit->Date))}}</td>
            <td class="notification-body"><p class="mb-1"><strong>{{$Audit->pegawais->nama}}</strong> {{$Audit->Desc}} di <strong>{{$Audit->jenis}}</strong></p></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
@section('script')
<script type="text/javascript">

$( document ).ready(function() {
  var today = new Date();
  var yyyy = today.getFullYear();
  $('input[name="daterange"]').daterangepicker({
    opens: 'left',
    startDate: '01/01'+yyyy, 
    endDate: today,
    locale: {
            format: 'DD/MM/YYYY'
        }
  }, function(start, end) {
    $('.loader').show();
    var start_=start.format('YYYY-MM-DD');
    var end_=end.format('YYYY-MM-DD');
    if(start == end){
      alert("Sila Pilih Dua Tarikh berbeza");
    }
    // console.log(start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/audittrail/apa",
        type:"GET",
        data: {     
            start:start_,
            end:end_
        },
        success: function(data) {  
            console.log(data);         
            $("#tblname").html(data);
            $('.loader').hide();
        }
    });
    
  });
  $('#audittbl').DataTable( {
      searching: false,
      sorting: false,
      paging: true,
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
})

</script>
@endsection
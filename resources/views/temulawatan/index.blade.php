@extends('dashboard')
@section('content')
<div class="row g-0">
    <div class="col-lg-12 pe-lg-2 mb-3">
      <div class="card h-lg-100 overflow-hidden">
        <div class="card-header bg-light">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0" style="color:#00A651;">Temujanji Lawatan</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<div class="row g-0">
    <div class="col-lg-12 pe-lg-2 mb-3">
        <div class="card h-lg-100">
        <div style="padding-top: 20px;padding-left:20px;overflow-x: auto !important;overflow-y: auto !important;">
            <table id="tbltemulawatan" class="table table-sm table-hover" style="width:max-content;">
                <colgroup>
                    <col span="1" style="width:15%;">
                    <col span="1" style="width:15%;">
                    <col span="1" style="width:20%;">
                    <col span="1" style="width:20%;white-space:pre-wrap; word-wrap:break-word;white-space: pre;">
                    <col span="1" style="width:10%;">
                    <col span="1" style="width:20%;">
                    <col span="1" style="width:20%;">
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
                    .dataTable-container{
                        padding-top: 3vh;
                    }
                    .dataTable-bottom{
                        padding-top: 3vh;
                    }
                </style>
                <thead>
                    <tr class="align-middle" style="text-align: center;">
                        <th>Tarikh Lawatan</th>
                        <th>Masa Lawatan</th>
                        <th>Usahawan</th>
                        <th>Pegawai</th>
                        <th>Jenis Lawatan</th>
                        <th>Status</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody id="tblname">
                @foreach ($lawatans as $lawatan)
                    <tr class="align-middle" style="text-align: center;">
                        <td class="text-nowrap"><label class="form-check-label">{{ $lawatan->tarikh_lawatan }}</label></td>
                        <td class="text-nowrap"><label class="form-check-label">{{ $lawatan->masa_lawatan }}</label></td>
                        <td class="text-nowrap"><label class="form-check-label">{{ $lawatan->nama_usahawan }}</label></td>
                        <td class="text-nowrap"><label class="form-check-label">{{ $lawatan->nama_pegawai }}</label></td>
                        <td ><label class="form-check-label">{{ $lawatan->jenis_lawatan }}</label></td>
                        <td ><label class="form-check-label">{{ $lawatan->nama_status }}</label></td>
                        @if($lawatan->status_lawatan == 1)
                            <td></td>
                        @endif
                        @if($lawatan->status_lawatan == 2)
                            <td><div style="width: 190px;"><button class="btn btn-primary btn-sm" style="display: inline-block !important" onclick="UpdateLawatan('stat',{{ $lawatan->id }}, '{{ $lawatan->tarikh_lawatan }}')">Setuju</button> 
                                <button class="btn btn-info btn-sm" style="display: inline-block !important" onclick="NewDate({{ $lawatan->id }})">Tarikh Baru</button></div>
                            </td>
                        @endif
                        @if($lawatan->status_lawatan == 3)
                            <td><button class="btn btn-primary btn-sm" onclick="UpdateLawatan('done',{{ $lawatan->id }}, '{{ $lawatan->tarikh_lawatan }}')">Selesai</button></td>
                        @endif
                        @if($lawatan->status_lawatan == 4)
                            <td><label class="form-check-label">Lawatan Selesai</label></td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <style>
            .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 2000; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            }

            /* Modal Content/Box */
            .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
            }

            /* The Close Button */
            .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            }

            .close:hover,
            .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
            }

            .centered {
                justify-content: center;
                align-items: center;
                text-align: center;
            }

            .datepicker-container {
                z-index: 10000 !important;
            }
        </style>
        </div>
    </div>
</div>
<div id="myModal" class="modal">
    <div class="modal-content" style="width: 400px;">
      <span class="close" onclick="closemodal()">&times;</span>
        <div class="centered">
            <p>Sila Pilih Tarikh Baru Untuk Temujanji :-</p>
            <form id="formtarikhbaru" method="POST" action="/temulawatan" enctype="multipart/form-data">
            @csrf
            @method("PUT")
                <div class="centered" style="padding-bottom:15px;">
                    <input class="form-control" id="datetimepicker" name="tarikh" style="width: 100%;"/>
                </div>
                <button class="btn btn-primary btn-sm" style="width: 200px">Simpan</button>
            </form>
        </div>
    </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
    $( document ).ready(function() {
        // const dataTableBasic = new simpleDatatables.DataTable("#tbltemulawatan", {
        //     searchable: true,
        //     fixedHeight: true,
        //     sortable: false,
        //     paging: true
        // });
        $('#datetimepicker').datepicker({
            dateFormat: "yy-mm-dd",
            format: "dd-mm-yy"
        });
        var span = document.getElementsByClassName("close")[0];
        var modal = document.getElementById("myModal");
        span.onclick = function() {
            modal.style.display = "none";
        }
        $('.loader').hide();
    });

    function NewDate(id){
        var modal = document.getElementById("myModal");
        modal.style.display = "block";
        document.getElementById("formtarikhbaru").action = "/temulawatan/"+id;
    }
    
    window.onclick = function(event) {
        var modal = document.getElementById("myModal");
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    function closemodal(){
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
    }

    function UpdateLawatan(field,id,tarikh){
        $('.loader').show();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/temulawatan/"+id,
            type:"PUT",
            data: {     
                type:field
            },
            success: function(data) {
                if(data == "stat"){
                    alert("Temujanji Anda Telah Ditetapkan Pada "+tarikh);
                }
                if(data == "done"){
                    alert("Temujanji Anda Pada "+tarikh+" Selesai");
                }
                $('.loader').hide();
                location.reload();
            },
            error: function(){
                alert('connection failure');
            }
        });
    }
    
</script>
@endsection
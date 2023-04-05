@extends('dashboard')
@section('content')
<style>
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 10000 !important; /* Sit on top */
  left: 0%;
  top: 0%;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

.modal-header {
  background-color: #00A651;
  color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}

.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 80%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  animation-name: animatetop;
  animation-duration: 0.4s
}

@keyframes animatetop {
  from {top: -300px; opacity: 0}
  to {top: 0; opacity: 1}
}
</style>
<div class="card">
    <div class="card-body overflow-hidden p-lg-6">
        {{-- <form method="get" id="allpegawai" method="get" action="/ViewAll">
            @csrf
            @method("GET")
            <div class="col-lg-12">
                <h4>Lihat Semua Data Pegawai</h4>
                <button class="btn btn-primary" type="button" onclick="viewall()">Lihat Semua</button>
            </div>
        </form> --}}
        <form method="post" action="/CariPegawai" enctype="multipart/form-data">
            @csrf
            @method("POST")
            <div class="col-lg-12" style="padding-top: 30px;">
                <h4>Carian Khusus Data Pegawai</h4>
            </div>
            <div class="col-lg-12">
                <label class="form-label">Nama Pegawai</label>
                <input class="form-control" name="nama" type="text"/>
            </div>
            <div class="col-lg-12">
                <label class="form-label">No Kad Pengenalan Pegawai</label>
                <input class="form-control" name="nokp" type="text"/>
            </div>
            {{-- <div class="col-lg-12">
                <label class="form-label mukim">Mukim Pegawai</label>
                <select name="mukim" class="form-select" aria-label=".form-select mukim" style="display:inline-block;">
                    <option selected="true" value='' disabled="disabled">Mukim</option>
                    <option value=''>Semua Mukim</option>
                    @foreach ($ddMukim as $items)
                        <option value="{{ $items->U_Mukim_ID }}"> 
                            {{ $items->Mukim }} 
                        </option>
                    @endforeach
                </select>
            </div> --}}
            <div class="col-lg-12">
                <label class="form-label pt">Pusat Tanggungjawab Pegawai</label>
                <select name="PT" class="form-select" aria-label=".form-select pt" style="display:inline-block;">
                    <option selected="true" value='' disabled="disabled">Pusat Tanggungjawab</option>
                    <option value=''>Semua Pusat Tanggungjawab</option>
                    @foreach ($ddPT as $items)
                        <option value="{{ $items->Kod_PT }}"> 
                            {{ $items->keterangan }} 
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-12 d-inline-flex" style="padding-top: 20px;">
              
                <button class="btn btn-primary me-4" type="submit">Carian Data</button>

                  @if (Auth::user()->role == 1)
                    <div id="test">
                        <a class="btn btn-secondary" onclick="API()">HRIP</a>
                    </div>
                    {{-- <div style="display:none;">
                        <input id="nama" type="text" @if(isset($nama)) value="{{$nama}}" @endif/>
                        <input id="kodpt" type="text" @if(isset($kodpt)) value="{{$kodpt}}" @endif/>
                        <input id="nokp" type="text" @if(isset($nokp)) value="{{$nokp}}" @endif/>
                    </div> --}}
                @endif
            </div>
        </form>
    </div>
</div>
<div id="myModal2" class="modal">
    <div class="modal-content" style="height:75vh;width:90vh;margin-top:100px;">
        <span class="close2" style="float: left">&times;</span>
        <div class="modal-body">
            <div style="padding:10px 50px;">
                <div class="col-lg-12" style="padding-top: 30px;">
                    <h4>Panggilan Khusus HRIP Pegawai</h4>
                </div>
                <div class="col-lg-12">
                    <label class="form-label">Nama Pegawai</label>
                    <input class="form-control" name="nama" type="text" id="nama"/>
                </div>
                <div class="col-lg-12">
                    <label class="form-label">No Kad Pengenalan Pegawai</label>
                    <input class="form-control" name="nokp" type="text" id="nokp"/>
                </div>
                <div class="col-lg-12">
                    <label class="form-label pt">Pusat Tanggungjawab Pegawai</label>
                    <select name="PT" class="form-select" aria-label=".form-select pt" style="display:inline-block;" id="kodpt">
                        <option selected="true" value='' disabled="disabled">Pusat Tanggungjawab</option>
                        <option value=''>Semua Pusat Tanggungjawab</option>
                        @foreach ($ddPT as $items)
                            <option value="{{ $items->Kod_PT }}"> 
                                {{ $items->keterangan }} 
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-12" style="padding-top:60px;text-align:center;">
                    <button class="btn btn-primary" type="button" onclick="sendapi()">Panggil HRIP</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script type="text/javascript">

$( document ).ready(function() {
    $('.loader').hide();
});

function sendapi(){
    $('.loader').show();
    var nama = $('#nama').val();
    var kodpt = $('#kodpt').val();
    var nokp = $('#nokp').val();
    console.log(nokp);

    if (confirm("Amaran! Panggilan API akan mengambil masa yang lama.")) {
        $('.loader').show();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/pegawaiPost2",
            type:"POST",
            data: {     
                nama:nama,
                kodpt:kodpt,
                nokp:nokp
            },
            success: function(data) {
                console.log(data);
                if(data == 400){
                    alert("Error API HRIP Pegawai");
                }else if(data == 300){
                    alert("Error Tiada data dijumpai");
                }else if(data == 'nodata'){
                    alert("Sila Isi Data Carian");
                }else if(data == 'done'){
                    alert("Data Pegawai Sudah Dicipta");
                    location.reload();
                   
                }else if(data == 'complete'){
                    alert("Data Pegawai Berjaya dan Selesai Ditarik");
                    location.reload();
                }
                $('.loader').hide();
            }
        });
    }else{
        return false;
    }
}

window.onclick = function(event) {
    var modal2 = document.getElementById("myModal2");
    if (event.target == modal2) {
        modal2.style.display = "none";
    }
}

var span2 = document.getElementsByClassName("close2")[0];
span2.onclick = function() {
    var modal = document.getElementById("myModal2");
    modal.style.display = "none";
}

function API(){
    var modal = document.getElementById("myModal2");
    modal.style.display = "block";
}

function viewall(){
    if (confirm("Amaran! Panggilan data semua pegawai akan mengambil masa yang lama.")) {
        $('#allpegawai').submit();
    }else{
        return false;
    }
}
</script>
@endsection
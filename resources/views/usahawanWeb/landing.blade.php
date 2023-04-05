@extends('dashboard')
@section('content')
<div class="card">
    <div class="card-body overflow-hidden p-lg-6">
        {{-- <form method="get" id="allusahawan" method="get" action="/ViewAllUsahawan">
            @csrf
            @method("GET")
            <div class="col-lg-12">
                <h4>Lihat Semua Data Usahawan</h4>
                <button class="btn btn-primary" type="button" onclick="viewall()">Lihat Semua</button>
            </div>
        </form> --}}
        <form method="post" action="/CariUsahawan" enctype="multipart/form-data">
            @csrf
            @method("POST")
            <div class="col-lg-12" style="padding-top: 30px;">
                <h4>Carian Khusus Data Usahawan</h4>
            </div>
            <div class="col-lg-12">
                <label class="form-label">Nama Usahawan</label>
                <input class="form-control" name="nama" type="text"/>
            </div>
            <div class="col-lg-12">
                <label class="form-label">No Kad Pengenalan Usahawan</label>
                <input class="form-control" name="noKP" type="text"/>
            </div>
            <div class="col-lg-12">
                <label class="form-label pt">Negeri Usahawan</label>
                <select name="negeri" class="form-select" aria-label=".form-select pt" style="display:inline-block;">
                    <option selected="true" value='' disabled="disabled">Negeri Usahawan</option>
                    <option value=''>Semua Negeri</option>
                    @foreach ($ddNegeri as $items)
                        <option value="{{ $items->U_Negeri_ID }}"> 
                            {{ $items->Negeri }} 
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-12">
                <label class="form-label pt">Pusat Tanggungjawab Usahawan</label>
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
            <div class="col-lg-12" style="padding-top: 20px;">
                <button class="btn btn-primary" type="submit">Carian Data</button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">

$( document ).ready(function() {
    $('.loader').hide();
});

function viewall(){
    if (confirm("Amaran! Panggilan data semua usahawan akan mengambil masa yang lama.")) {
        $('#allusahawan').submit();
    }else{
        return false;
    }
}
</script>
@endsection
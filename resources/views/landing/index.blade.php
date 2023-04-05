@extends('dashboard')
@section('content')
<div class="card">
    <div class="card-body overflow-hidden p-lg-6">
        Maklumat Profil Pegawai :- <br>
        NAMA : {{$authuser->name ?? ''}} <br>
        NO KP : {{$authuser->no_kp ?? ''}} <br>
        EMAIL : {{$authuser->email ?? ''}} <br>
        PERANAN PEGAWAI : {{$authuser->peranan->nama_peranan ?? ''}} <br>
    </div>
</div>
@if ($noti ?? '' == 1)
<div class="card">
    <div class="card-body overflow-hidden p-lg-6">
        Sila Sahkan Kemaskini Usahawan Di 
        <form method="post" action="/CariUsahawan" enctype="multipart/form-data">
            @csrf
            @method("POST")
            <input name="StatProf" value="test" style="display: none;"/>
            <button class="btn btn-primary" type="submit">Tetapan Usahawan</button>
        </form>
    </div>
</div>
@endif
@endsection
@section('script')
<script type="text/javascript">

$( document ).ready(function() {
    $('.loader').hide();
});

</script>
@endsection
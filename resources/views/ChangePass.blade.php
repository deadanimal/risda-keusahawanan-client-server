@extends('dashboard')
@section('content')
<div class="card">
    <div class="card-body overflow-hidden p-lg-6" style="text-align: center;">
        {{-- <div class="mb-3" style="width: 800px;margin:0 auto;"> --}}
            @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            <form id="changepassform" method="POST" action="/ChangePass" enctype="multipart/form-data">
                @csrf
                @method("POST")
                <div class="d-flex justify-content-between">
                    <label class="form-label" for="split-login-password">Alamat Emel</label>
                </div>
                <input class="form-control" type="text" name="email" value="{{$user->email}}" required readonly/>
                <div class="d-flex justify-content-between">
                    <label class="form-label" for="split-login-password">Kata Laluan Lama</label>
                </div>
                <input class="form-control" id="split-login-password" type="password" name="current_password" autocomplete="current-password" required/>
                <div class="d-flex justify-content-between">
                    <label class="form-label" for="split-login-password">Kata Laluan Baru</label>
                </div>
                <input class="form-control" id="new_password_check" type="password" name="new_password" autocomplete="current-password" required/>
                <div class="d-flex justify-content-between">
                    <label class="form-label" for="split-login-password">Sahkan Kata Laluan Baru</label>
                </div>
                <input class="form-control" id="new_password_check_dua" type="password" name="new_confirm_password" autocomplete="current-password" required/>
                <div style="padding-top: 20px;">
                    <button class="btn btn-primary" type="button" onclick="submitpass()">Tukar Kata Laluan</button>
                </div>
            </form>
        {{-- </div> --}}
        <div style="text-align: left;padding-top:20px;">
            * Kata Laluan harus mempunyai minimum 8 aksara <br>
            * Sekurang-kurangnya satu simbol diperlukan untuk kata laluan<br>
            * Kata laluan harus mempunyai gabungan nombor dan perkataan<br>
            * Kata laluan harus mempunyai Sekurang-kurangnya satu huruf besar<br>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">

    $( document ).ready(function() {
        $('.loader').hide();
    })

    function submitpass(){
        var val = $('#new_password_check').val();
        var check = true;

        if(val.length < 8){
            check = false;
            alert('Minimum 8 aksara diperlukan untuk kata laluan');
        }
        var format = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
        if(format.test(val) == false){
            check = false;
            alert('Sekurang-kurangnya satu simbol diperlukan untuk kata laluan');
        }
        // var matches = val.match(/\d+/g);
        if (val.match(/\d+/g) == null) {
            check = false;
            alert('Kata laluan harus mempunyai gabungan nombor dan perkataan');
        }
        // console.log(format.test(val));
        if(/[A-Z]/.test(val) == false){
            check = false;
            alert('Kata laluan harus mempunyai huruf besar');
        }
        // console.log();

        if(check == true){
            $('#changepassform').submit();
        }else{
            $('#new_password_check').val('');
            $('#new_password_check_dua').val('');

        }
        
        
    }
</script>
@endsection
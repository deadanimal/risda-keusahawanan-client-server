@extends('dashboard')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script src="../../../js/jquery-3.6.0.min.js"> </script>

@section('content')
<div class="card">
    <div class="card-body overflow-hidden p-lg-6" style="overflow-x: auto !important;overflow-y: auto !important;">
        <a id="satukembali" style="margin-top:-2vh;margin-left:-2vh;" class="btn btn-sm btn-outline-secondary border-300 me-2" href="/usahawanWeb"> 
            <span class="fas fa-chevron-left me-1" data-fa-transform="shrink-4"></span>Kembali</a>
        <div class="row align-items-center" style="padding-top:15px;">
            <div id="displaysatu" >
                <h3 class="text" style="padding-bottom:20px;color:#00A651;">Tetapan Usahawan</h3>
                @if (Auth::user()->role == 1)
                <div style="padding-bottom: 20px;" id="test">
                    <a class="btn btn-primary" onclick="APIPK()">Portal PK</a>
                </div>
                @endif
                <table class="tblusahawan" id="penggunatbl">
                    <style>
                        .tblusahawan td{
                            font-size: 12px;
                        }
                    </style>
                    <colgroup>
                        <col span="1" style="width: 30%;">
                        <col span="1" style="width: 15%;">
                        <col span="1" style="width: 20%;">
                        <col span="1" style="width: 15%;">
                        <col span="1" style="width: 20%;">
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
                            <th scope="col">No Kad Pengenalan</th>
                            <th scope="col">Negeri</th>
                            <th scope="col">Pusat Tanggungjawab</th>
                            <th scope="col">Aktifkan Pengguna</th>
                            <th scope="col">Kemaskini Profil</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <input style="display: none;" type="text" name="user" value="{{$user->id}}"/>
                        <tr class="align-middle">
                            <td class="text-nowrap form-check-label">{{$user->namausahawan}}</td>
                            <td class="text-nowrap form-check-label">{{$user->nokadpengenalan}}</td>
                            <td class="text-nowrap form-check-label">{{$user->negeri->Negeri}}</td>
                            <td class="text-nowrap">
                                <select id="ddPT{{$user->id}}" class="form-select form-select-sm" aria-label=".form-select-sm example" style="display:inline-block;width:40vh;font-size:12px;" onchange="aktifkanpengguna('kawasan',{{$user}},this.options[this.selectedIndex].value)">
                                <option selected="true" disabled="disabled" selected="">Kawasan</option>
                                @foreach ($ddPT as $items)
                                    <option value="{{ $items->Kod_PT }}" {{ ( $items->Kod_PT == $user->Kod_PT) ? 'selected' : '' }}> 
                                        {{ $items->keterangan }} 
                                    </option>
                                @endforeach
                            </select></td>
                            <td class="align-middle text-nowrap">
                                <div class="form-check form-switch" style="margin-left:10px;">
                                <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                                <input {{$user->user->status_pengguna == 1 ? 'checked':''}} class="form-check-input " id="flexSwitchCheckDefault{{$user->usahawanid}}" name="pengguna" type="checkbox" onclick="aktifkanpengguna('status',{{$user}})"  />
                                </div>
                            </td>
                            @if (Auth::user()->role == 1 || Auth::user()->role == 7)
                                <td class="text-nowrap"><button class="btn btn-falcon-default btn-sm me-1 mb-1" type="button" onclick="tetapanpengguna('satu',{{$user}})">
                                    <span class="me-1" data-fa-transform="shrink-3"></span>Kemaskini
                                </button></td>

                            @elseif ((Auth::user()->role == 3 || Auth::user()->role == 4) && $user->status_profil == 0)
                                    <td class="text-nowrap"><button class="btn btn-falcon-default btn-sm me-1 mb-1" type="button" onclick="tetapanpengguna('satu',{{$user}})">
                                        <span class="me-1" data-fa-transform="shrink-3"></span>Sahkan
                                    </button></td>

                            @else
                                <td></td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot style="border: none">
                        <tr style="border: none">
                            <th><input type="text" placeholder="Search Nama" /></th>
                            <th><input type="text" placeholder="Search No KP" /></th>
                            <th>Negeri</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div id="displaydua" style="display: none">
                <a style="margin-top:-2vh;margin-left:-2vh;" class="btn btn-sm btn-outline-secondary border-300 me-2" onclick="tetapanpengguna('dua')"> 
                    <span class="fas fa-chevron-left me-1" data-fa-transform="shrink-4"></span>Kembali</a>
                <div class="card-header" style="padding-top:4vh;">
                <style>
                    .card-header{
                        margin-top: -1.0rem;
                    }
                </style>
                    <div class="row">
                        <div class="col-12">
                          <div class="card mb-3 btn-reveal-trigger">
                            <div class="card-header position-relative min-vh-25 mb-8">
                              <div class="cover-image">
                                <div class="bg-holder rounded-3 rounded-bottom-0">
                                    <h3 class="text" style="padding-bottom:20px;color:#00A651;padding:10px 0px 0px 20px;margin-top:2rem">Kemaskini Usahawan</h3>
                                </div>
                              </div>
                              <div class="avatar avatar-5xl avatar-profile shadow-sm img-thumbnail rounded-circle" style="position: relative !important;">
                                <div class="h-100 w-100 rounded-circle overflow-hidden position-relative"> 
                                <img id="usahawanprofilpic" src="#" width="200" alt="" data-dz-thumbnail="data-dz-thumbnail" />
                                <form action="{{ route('usahawan.uploadprofile') }}" method="POST" id="fileupform" enctype="multipart/form-data">
                                    @csrf
                                    @method("POST")
                                    <input class="d-none" id="profile-image" type="file" name="img" onchange="profileimg()"/>
                                </form>
                                  <label class="mb-0 overlay-icon d-flex flex-center" for="profile-image"><span class="bg-holder overlay overlay-0"></span><span class="z-index-1 text-white dark__text-white text-center fs--1"><span class="fas fa-camera"></span><span class="d-block">Update</span></span></label>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="card-body bg-light">
                      <form class="row g-3" id="datausahawan" method="POST" action="/usahawanWeb" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <input name="idusahawan" style="display: none"/>
                        <div class="col-lg-12">
                          <label class="form-label">Nama Usahawan</label>
                          <input class="form-control usahawanfield" name="namausahawan"   type="text"/>
                        </div>
                        <div class="col-lg-6">
                          <label class="form-label" >No Kad Pengenalan</label>
                          <input class="form-control usahawanfield" name="nokadpengenalan"   type="text"/>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label" >No. Usahawan</label>
                            <input class="form-control usahawanfield" name="No_Usahawan"   type="text"  />
                        </div>
                        <div class="col-lg-6">
                          <label class="form-label" for="tarikhlahir">Tarikh Lahir</label>
                          <input class="form-control usahawanfield" name="tarikhlahir" id="tarikhlahirid" type="text"/>
                        </div>
                        <div class="col-lg-6">
                          <label class="form-label" >Jantina</label>
                          <select name="U_Jantina_ID" class="form-select usahawanfield" aria-label=".form-select-sm example">
                            <option value=""></option>
                            <option value="1">Lelaki</option>
                            <option value="2">Perempuan</option>
                            <option value="3">Lain-Lain</option>
                          </select>
                        </div>
                        <div class="col-lg-6">
                          <label class="form-label" >Bangsa</label>
                          <select name="U_Bangsa_ID" class="form-select usahawanfield" aria-label=".form-select-sm example" onchange="BangsaDD(this.value)">
                            <option value=""></option>
                            <option value="1">Melayu</option>
                            <option value="2">Orang Asli Semenanjung</option>
                            <option value="3">Bumiputera Sabah</option>
                            <option value="4">Bumiputera Sarawak</option>
                            <option value="5">Cina</option>
                            <option value="6">India</option>
                            <option value="7">Lain-Lain</option>
                          </select>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label" >Etnik</label>
                            <select id="Etnik_DD" name="U_Etnik_ID" class="form-select usahawanfield" aria-label=".form-select-sm example">
                                <option value=""></option>
                                @foreach ($ddEtnik as $items)
                                    <option value="{{ $items->U_Etnik_ID }}"> 
                                        {{ $items->Etnik }} 
                                    </option>
                                @endforeach
                            </select>
                          </div>
                        <div class="col-lg-6">
                            <label class="form-label" >Pendidikan</label>
                            <select name="U_Pendidikan_ID" class="form-select usahawanfield" aria-label=".form-select-sm example">
                                <option value=""></option>
                                <option value="1">Tidak Bersekolah</option>
                                <option value="2">Sekolah Rendah / Setara</option>
                                <option value="3">Sekolah Menengah / Setara</option>
                                <option value="4">Kolej / Universiti / Setara</option>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label" >Taraf Kelulusan Tertinggi</label>
                            <select name="U_Taraf_Pendidikan_Tertinggi_ID" class="form-select usahawanfield" aria-label=".form-select-sm example">
                                <option value=""></option>
                                <option value="1">UPSR/PSRA/Setaraf</option>
                                <option value="2">PMR/SRP/LCE/Setaraf</option>
                                <option value="3">SPM/MCE/Setaraf</option>
                                <option value="4">STPM/Diploma/Setaraf</option>
                                <option value="5">Ijazah Pertama/Ke Atas</option>
                                <option value="6">Tiada</option>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Status Perkahwinan</label>
                            <select name="statusperkahwinan" class="form-select usahawanfield" aria-label=".form-select-sm example">
                              <option value=""></option>
                              <option value="1">Tidak Pernah Berkahwin</option>
                              <option value="2">Berkahwin</option>
                              <option value="3">Balu / Duda</option>
                              <option value="4">Bercerai</option>
                              <option value="5">Berpisah</option>
                              <option value="9">Tiada Maklumat</option>
                            </select>
                          </div>
                        <div class="col-lg-6">
                            <label class="form-label" >Negeri Premis Perniagaan</label>
                            {{-- <select name="negeriperniaga" class="form-select usahawanfield" aria-label=".form-select-sm example">
                                <option value=""></option>
                                @foreach ($ddNegeri as $items)
                                    <option value="{{ $items->U_Negeri_ID }}"> 
                                        {{ $items->Negeri }} 
                                    </option>
                                @endforeach
                            </select> --}}
                            <input class="form-control" name="negeriperniaga"   type="text"  disabled/>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label" >Pusat Tanggungjawab</label>
                            <select name="Kod_PT" class="form-select usahawanfield" aria-label=".form-select-sm example">
                                <option value=""></option>
                                @foreach ($ddPT as $items)
                                    <option value="{{ $items->Kod_PT }}"> 
                                        {{ $items->keterangan }} 
                                    </option>
                                @endforeach
                            </select>
                            {{-- <input class="form-control usahawanfield" name="Pusat_Tanggungjawab"   type="text"  /> --}}
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label">Alamat</label>
                            <input class="form-control usahawanfield" name="alamat1"   type="text"  />
                        </div>
                        <div class="col-lg-12">
                            {{-- <label class="form-label">Alamat</label> --}}
                            <input class="form-control usahawanfield" name="alamat2"   type="text"  />
                        </div>
                        <div class="col-lg-12">
                            {{-- <label class="form-label">Alamat</label> --}}
                            <input class="form-control usahawanfield" name="alamat3"   type="text"  />
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Bandar</label>
                            <input class="form-control usahawanfield" name="bandar"   type="text"  />
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Poskod</label>
                            <input class="form-control usahawanfield" name="poskod"   type="text"  />
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Negeri</label>
                            <select name="U_Negeri_ID" class="form-select usahawanfield" aria-label=".form-select-sm example">
                                <option value=""></option>
                                @foreach ($ddNegeri as $items)
                                    <option value="{{ $items->U_Negeri_ID }}"> 
                                        {{ $items->Negeri }} 
                                    </option>
                                @endforeach
                            </select>
                            {{-- <input class="form-control usahawanfield" name="U_Negeri_ID"   type="text"  /> --}}
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Daerah</label>
                            <select name="U_Daerah_ID" class="form-select usahawanfield" aria-label=".form-select-sm example">
                                <option value=""></option>
                                @foreach ($ddDaerah as $items)
                                    <option value="{{ $items->U_Daerah_ID }}"> 
                                        {{ $items->Daerah }} 
                                    </option>
                                @endforeach
                            </select>
                            {{-- <input class="form-control usahawanfield" name="U_Daerah_ID"   type="text"  /> --}}
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Mukim</label>
                            <select name="U_Mukim_ID" class="form-select usahawanfield" aria-label=".form-select-sm example">
                                <option value=""></option>
                                @foreach ($ddMukim as $items)
                                    <option value="{{ $items->U_Mukim_ID }}"> 
                                        {{ $items->Mukim }} 
                                    </option>
                                @endforeach
                            </select>
                            {{-- <input class="form-control usahawanfield" name="U_Mukim_ID"   type="text"  /> --}}
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Parlimen</label>
                            <select name="U_Parlimen_ID" class="form-select usahawanfield" aria-label=".form-select-sm example">
                                <option value=""></option>
                                @foreach ($ddParlimen as $items)
                                    <option value="{{ $items->U_Parlimen_ID }}"> 
                                        {{ $items->Parlimen }} 
                                    </option>
                                @endforeach
                            </select>
                            {{-- <input class="form-control usahawanfield" name="U_Parlimen_ID"   type="text"  /> --}}
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">DUN</label>
                            <select name="U_Dun_ID" class="form-select usahawanfield" aria-label=".form-select-sm example">
                                <option value=""></option>
                                @foreach ($ddDun as $items)
                                    <option value="{{ $items->U_Dun_ID }}"> 
                                        {{ $items->Dun }} 
                                    </option>
                                @endforeach
                            </select>
                            {{-- <input class="form-control usahawanfield" name="U_Dun_ID"   type="text"  /> --}}
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Kampung</label>
                            <select name="U_Kampung_ID" class="form-select usahawanfield" aria-label=".form-select-sm example">
                                <option value=""></option>
                                @foreach ($ddKampung as $items)
                                    <option value="{{ $items->U_Kampung_ID }}"> 
                                        {{ $items->Kampung }} 
                                    </option>
                                @endforeach
                            </select>
                            {{-- <input class="form-control usahawanfield" name="U_Kampung_ID"   type="text"  /> --}}
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Seksyen</label>
                            <select name="U_Seksyen_ID" class="form-select usahawanfield" aria-label=".form-select-sm example">
                                <option value=""></option>
                                @foreach ($ddSeksyen as $items)
                                    <option value="{{ $items->U_Seksyen_ID }}"> 
                                        {{ $items->Seksyen }} 
                                    </option>
                                @endforeach
                            </select>
                            {{-- <input class="form-control usahawanfield" name="U_Seksyen_ID"   type="text"  /> --}}
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Kategori</label>
                            <select name="id_kategori_usahawan" class="form-select usahawanfield" aria-label=".form-select-sm example">
                                <option value=""></option>
                                @foreach ($ddKateUsahawan as $items)
                                    <option value="{{ $items->id_kategori_usahawan }}"> 
                                        {{ $items->nama_kategori_usahawan }}
                                    </option>
                                @endforeach
                            </select>
                            {{-- <input class="form-control usahawanfield" name="id_kategori_usahawan"   type="text"  /> --}}
                        </div>
                        {{-- <div class="col-lg-6">
                            <label class="form-label">Gambar</label>
                            <input class="form-control" name="gambar_url" type="text"  />
                        </div> --}}
                        <div class="col-lg-6">
                            <label class="form-label">No. Telefon (R)</label>
                            <input class="form-control usahawanfield" name="notelefon" id="" type="text"  />
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">No. Telefon (HP)</label>
                            <input class="form-control usahawanfield" name="nohp"   type="text"  />
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Email</label>
                            <input class="form-control usahawanfield" name="email"   type="text"  />
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            @if (Auth::user()->role == 1 || Auth::user()->role == 7)
                                <button class="btn btn-primary" type="button" onclick="SubmitUsahawan()">Kemas Kini Profil
                            @endif
                            @if (Auth::user()->role == 3 || Auth::user()->role == 4)
                                <button class="btn btn-primary" type="button" onclick="SahkanUsahawan()">Sahkan Profil
                            @endif
                        </div>
                        @if (Auth::user()->role == 1)
                        <div class="col-12 d-flex justify-content-end">
                            <button class="btn btn-primary" type="button" onclick="ResetPass()">Reset Password
                        </div>
                        @endif
                        <div class="col-lg-6">
                            <label class="form-label">No KP Pekebun</label>
                            <input class="form-control" name="pekebunkp" type="text" maxlength="12"/>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Nama Pekebun</label>
                            <input class="form-control" name="pekebunname" type="text" disabled/>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button class="btn btn-primary" type="button" onclick="API()">Kemas Kini Pekebun
                        </div>
                      </form>
                        
                    </div>
                </div>
            </div>
            {{-- <textarea class="form-control" name="statusperkahwinan" cols="30" rows="13"></textarea> --}}
            {{-- <div class="form-check form-switch">
                <input class="form-check-input" id="flexSwitchCheckChecked" type="checkbox" checked="" />
                <label class="form-check-label" for="flexSwitchCheckChecked">Pengguna 2</label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" id="flexSwitchCheckDisabled" type="checkbox" disabled="" />
                <label class="form-check-label" for="flexSwitchCheckDisabled">Pengguna 3</label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" id="flexSwitchCheckCheckedDisabled" type="checkbox" checked="" disabled="" />
                <label class="form-check-label" for="flexSwitchCheckCheckedDisabled">Pengguna 3</label>
            </div> --}}
        </div>
    </div>
</div>
<style>
    /* The Modal (background) */
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

  /* Modal Header */
.modal-header {
  /* padding: 2px 16px; */
  background-color: #00A651;
  color: white;
}

/* Modal Body */
.modal-body {padding: 2px 16px;}

/* Modal Footer */
.modal-footer {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}

/* Modal Content */
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

/* Add Animation */
@keyframes animatetop {
  from {top: -300px; opacity: 0}
  to {top: 0; opacity: 1}
}
</style>
<div id="myModal" class="modal">
    <div class="modal-content" style="height:75vh; width:90vh;margin-top:80px;">
        <span class="close" style="float: left">&times;</span>
        <div style="padding:10px 50px">
            <div class="col-lg-12" style="padding-bottom:10px;">
                <h4>Carian Khusus Data Usahawan</h4>
            </div>
            <div class="col-lg-12">
                <label class="form-label">Nama Usahawan</label>
                <input class="form-control" name="nama" type="text" id="name" />
            </div>
            <div class="col-lg-12">
                <label class="form-label">No Kad Pengenalan Usahawan</label>
                <input class="form-control" name="noKP" type="text" id="nokp"/>
            </div>
            <div class="col-lg-12">
                <label class="form-label pt">Negeri Usahawan</label>
                <select name="negeri" class="form-select" aria-label=".form-select pt" style="display:inline-block;" id="negeri">
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
            <div class="col-lg-12" style="padding-top: 30px;text-align:center;">
                <button class="btn btn-primary" type="button" onclick="sendPK()">Panggil Portal PK</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">

$( document ).ready(function() {
    GetPengguna();
    datatable();
    // API();
    $('.loader').hide();
});

var span = document.getElementsByClassName("close")[0];
span.onclick = function() {
    var modal = document.getElementById("myModal");
  modal.style.display = "none";
}

function BangsaDD(val){
    console.log(val);
    if(val == 1){
        $("#Etnik_DD").html("<option value=''></option><option value='1100'>Melayu</option>");
        $("#Etnik_DD").val(1100);

    }else if(val == 2){
        $("#Etnik_DD").html("<option value=''></option><option value='2111'>Negrito - Bateq</option><option value='2112'>Negrito - Jahai</option><option value='2113'>Negrito - Kensiu</option><option value='2114'>Negrito - Kintak</option><option value='2115'>Negrito - Lanoh</option><option value='2116'>Negrito - Mendriq</option><option value='2121'>Senoi - Che Wong</option><option value='2122'>Senoi - Jahut</option><option value='2123'>Senoi - Mah Meri</option><option value='2124'>Senoi - Semai</option><option value='2125'>Senoi - Semoq Beri</option><option value='2126'>Senoi - Temiar</option><option value='2131'>Melayu Asli - Jakun</option><option value='2132'>Melayu Asli - Prang Kanaq</option><option value='2133'>Melayu Asli - Orang Kuala</option><option value='2134'>Melayu Asli - Orang Seletar</option><option value='2135'>Melayu Asli - Semalai</option><option value='2136'>Melayu Asli - Temuan</option>");
    
    }else if(val == 3){
        $("#Etnik_DD").html("<option value=''></option><option value='3110'>Bajau</option><option value='3120'>Balbak/Molbog</option><option value='3130'>Bisaya/Bisayah</option><option value='3140'>Bulongan</option><option value='3150'>Dusun</option><option value='3160'>Idahan/Ida'an</option><option value='3170'>Iranun/Ilanun</option><option value='3180'>Kadayan/Kedayan</option><option value='3190'>Kadazan</option><option value='3200'>Lundayuh/Lundayeh</option><option value='3210'>Melayu Brunei</option><option value='3220'>Murut</option><option value='3230'>Orang Sungai/Sungoi</option><option value='3240'>Rungus</option><option value='3250'>Suluk</option><option value='3260'>Tidung</option><option value='3998'>Bumiputera Sabah Lain</option>");
    
    }else if(val == 4){
        $("#Etnik_DD").html("<option value=''></option><option value='4110'>Bidayuh</option><option value='4120'>Bisayah (Sarawak)</option><option value='4130'>Bukitan</option><option value='4140'>Iban</option><option value='4150'>Kadayan (Sarawak)</option><option value='4160'>Kajang</option><option value='4170'>Kanowit</option><option value='4180'>Kayan</option><option value='4190'>Kejaman</option><option value='4200'>Kalabit</option><option value='4210'>Kenyah</option><option value='4220'>Iahanan</option><option value='4230'>Lisum</option><option value='4240'>Lugat</option><option value='4250'>Lun Bawang/Murut (Sarawak)</option><option value='4260'>Melanau</option><option value='4270'>Penan</option><option value='4280'>Punan</option><option value='4290'>Sabup</option><option value='4300'>Sekapan</option><option value='4310'>Sian</option><option value='4320'>Sipeng</option><option value='4330'>Tabun</option><option value='4340'>Tagal</option><option value='4350'>Tanjong</option><option value='4360'>Ukit</option><option value='4998'>Bumiputera Sarawak Lain</option>");
    
    }else if(val == 5){
        $("#Etnik_DD").html("<option value=''></option><option value='5110'>Foochow</option><option value='5120'>Hainan</option><option value='5130'>Henghua</option><option value='5140'>Hokchia</option><option value='5150'>Hokchiu</option><option value='5160'>Hookien</option><option value='5170'>Kantonis</option><option value='5180'>Khek (Hakka)</option><option value='5190'>Kwongsai</option><option value='5200'>Teochew</option><option value='5998'>Orang Cina Lain</option>");
    
    }else if(val == 6){
        $("#Etnik_DD").html("<option value=''></option><option value='6110'>India Muslim/Malabari</option><option value='6120'>Malayali</option><option value='6130'>Punjabi (Kecuali Sikh)</option><option value='6140'>Sikh</option><option value='6150'>Sinhala</option><option value='6160'>Tamil India</option><option value='6170'>Tamil Sri Lanka</option><option value='6180'>Telugu</option><option value='6998'>Orang India Lain</option>");
    
    }else if(val == 7){
        $("#Etnik_DD").html("<option value=''></option><option value='7000'>Lain-Lain</option>");
        $("#Etnik_DD").val(7000);
    }

}

function ResetPass(){
    var id = $("#displaydua input[name=idusahawan]").val();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/usahawanPost2",
        type:"POST",
        data: {     
            id:id
        },
        success: function(data) {
            console.log(data);
            alert("Password Berjaya Di Set Semula");
            $('.loader').hide();
        }
    });
}

function APIPK(){
    var modal = document.getElementById("myModal");
    modal.style.display = "block";
}

function sendPK(){
    var nama = $('#name').val();
    var nokp = $('#nokp').val();
    var negeri = $('#negeri').val();
    var kodpt = $('#kodpt').val();
    console.log(nama);
    if (confirm("Amaran! Panggilan API akan mengambil masa yang lama.")) {
    $('.loader').show();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/usahawanPK",
            type:"POST",
            data: {     
                nama:nama,
                nokp:nokp,
                negeri:negeri,
                kodpt:kodpt
            },
            success: function(data) {
                console.log(data);
                if(data == 400){
                    alert("Error API Portal Pekebun Kecil")
                }else{
                    alert("Data Usahawan Berjaya dan Selesai Ditarik");
                    // location.reload();
                }
                $('.loader').hide();
            }
        });
    }else{
        return false;
    }
}

window.onclick = function(event) {
    var modal = document.getElementById("myModal");
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

function API(){
    
    var nokp = $("#displaydua input[name=pekebunkp]").val();
    var idusahawan = $("#displaydua input[name=idusahawan]").val();
    let isnum = /^\d+$/.test(nokp);
    if(isnum == false){
        alert("Format No KP Tidak Betul. Sila Isi Nombor Sahaja");
        $("#displaydua input[name=pekebunkp]").val('')
        return;
    }
    $('.loader').show();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/usahawanGet",
        type:"POST",
        data: {     
            nokp:nokp,
            idusahawan:idusahawan
        },
        success: function(data) {
            console.log(data);
            if(data == 400){
                alert("Error API Pekebun")
            }else{
                $("#displaydua input[name=pekebunname]").val(data[0].Nama_PK);
                alert("Data Pekebun Berjaya Ditarik");
            }
            $('.loader').hide();
        }
    });
}

function datatable(){
    var table = $('#penggunatbl').DataTable({
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
        },
        initComplete: function () {
            this.api().columns([2]).every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );

            this.api().columns([0,1]).every( function () {
                var that = this;
 
                $( 'input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );

            var r = $('#penggunatbl tfoot tr');
            r.find('th').each(function(){
                $(this).css('padding', 8);
            });
            $('#penggunatbl thead').append(r);
            $('#search_0').css('text-align', 'center');
        }
    });
}

function GetPengguna(){
    var user = <?php echo $users; ?>;
    //var user = document.getElementsByName("user");
    for (var i=0; i < user.length; i++) {
        //console.log("flexSwitchCheckDefault"+user[i].value);
        if(user[i].user){
            if(user[i].user.status_pengguna == 1){
            $("#flexSwitchCheckDefault"+user[i].usahawanid).attr("checked","");
            }else{
                //$("#flexSwitchCheckDefault"+user[i].value).attr("checked","");
            }
        }
    }
    console.log(user);
}

function aktifkanpengguna(type,user,input){
    $('.loader').show();
    var id = user.usahawanid;
    var status = "";
    if(type == 'kawasan'){
        status = input;
        //$("#ddPT"+user.id).val;
        //alert(status);
    }else if(type == 'status'){
        var check = $("#ddPT"+user.id).val();
        // console.log('check',check);
        if ($("#flexSwitchCheckDefault"+id).is(":checked")){
            status = 1;
        }else{
            status = 0;
        }
        
        if((check == null || check == '') && status == 1){

            alert('Sila tetapkan Pusat Tanggungjawab untuk aktifkan Usahawan')
            $("#flexSwitchCheckDefault"+id).prop('checked',false);
            $('.loader').hide(); 

            return false;

        }
    }
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/usahawanPost",
        type:"PUT",
        data: {     
            type:type,
            id:id,
            status:status
        },
        success: function(data) {
            if(type == 'status'){
                if(status == 1){
                    alert("Akaun Usahawan Berjaya Diaktifkan");
                }else{
                    alert("Akaun Usahawan Berjaya Dinyahaktifkan");
                }
            }
            if(type == 'kawasan'){
                alert("Pusat Tanggungjawab Usahawan Berjaya Dikemaskini");
            }
            $('.loader').hide();
        },
        error: function(){
            alert('failure');
        }
    });
}

function tetapanpengguna(page,data){
    $('.loader').show();
    console.log(data);
    if(page == 'satu'){
        $("#displaysatu").hide();
        $("#displaydua").show();
        $("#satukembali").hide();
        
        var role = <?php echo Auth::user()->role ?>;

        $("#usahawanprofilpic").attr("src",data.gambar_url);

        $("#displaydua input[name=idusahawan]").val(data.usahawanid);
        $("#displaydua input[name=namausahawan]").val(data.namausahawan);
        $("#displaydua input[name=nokadpengenalan]").val(data.nokadpengenalan);
        $("#displaydua input[name=No_Usahawan]").val(data.usahawanid);
        if (typeof data.tarikhlahir === 'undefined' || data.tarikhlahir === null) {
            var tarikhlahir = new Date()
        }else{
            var tarikhlahir = new Date(data.tarikhlahir);
        }
        
        $('#displaydua input[name=tarikhlahir]').datepicker({
            format: 'dd-mm-yyyy'
        });
        $('#displaydua input[name=tarikhlahir]').datepicker("setDate", tarikhlahir );
        $("#displaydua select[name=U_Jantina_ID]").val(data.U_Jantina_ID);
        $("#displaydua select[name=U_Bangsa_ID]").val(data.U_Bangsa_ID);
        BangsaDD(data.U_Bangsa_ID);
        $("#displaydua select[name=U_Etnik_ID]").val(data.U_Etnik_ID);
        // console.log(data.U_Etnik_ID)
        // console.log($("#displaydua select[name=U_Etnik_ID]").val())
        $("#displaydua select[name=statusperkahwinan]").val(data.statusperkahwinan);
        $("#displaydua select[name=U_Pendidikan_ID]").val(data.U_Pendidikan_ID);
        $("#displaydua select[name=U_Taraf_Pendidikan_Tertinggi_ID]").val(data.U_Taraf_Pendidikan_Tertinggi_ID);
        //Negeri Premis Perniagaan
        $("#displaydua select[name=Kod_PT]").val(data.Kod_PT); 
        $("#displaydua input[name=alamat1]").val(data.alamat1);
        $("#displaydua input[name=alamat2]").val(data.alamat2);
        $("#displaydua input[name=alamat3]").val(data.alamat3);
        $("#displaydua input[name=bandar]").val(data.bandar);
        $("#displaydua input[name=poskod]").val(data.poskod);
        $("#displaydua select[name=U_Negeri_ID]").val(data.U_Negeri_ID);
        $("#displaydua select[name=U_Daerah_ID]").val(data.U_Daerah_ID);
        $("#displaydua select[name=U_Mukim_ID]").val(data.U_Mukim_ID);
        $("#displaydua select[name=U_Parlimen_ID]").val(data.U_Parlimen_ID);
        $("#displaydua select[name=U_Dun_ID]").val(data.U_Dun_ID);
        $("#displaydua select[name=U_Kampung_ID]").val(data.U_Kampung_ID);
        $("#displaydua select[name=U_Seksyen_ID]").val(data.U_Seksyen_ID);
        $("#displaydua select[name=id_kategori_usahawan]").val(data.id_kategori_usahawan);
        $("#displaydua input[name=gambar_url]").val(data.gambar_url);
        $("#displaydua input[name=notelefon]").val(data.notelefon);
        $("#displaydua input[name=nohp]").val(data.nohp);
        $("#displaydua input[name=email]").val(data.email);

        if(data.pekebun){
            $("#displaydua input[name=pekebunkp]").val(data.pekebun.No_KP);
            $("#displaydua input[name=pekebunname]").val(data.pekebun.Nama_PK);
        }
        if(data.perniagaan){
            $("#displaydua input[name=negeriperniaga]").val(data.perniagaan.U_Negeri_ID);
        }
        $("#datausahawan").attr("action", "/usahawanWeb/"+data.usahawanid);

        var x = document.getElementsByClassName("usahawanfield");       
        if (role == 1 || role == 7){
            for (var i = 0; i < x.length; i++) {
                x[i].disabled = false;
            }        
        }
        if (role == 3 || role == 4){
            for (var i = 0; i < x.length; i++) {
                x[i].disabled = true;
            }
        }
        $('.loader').hide();
    }else if(page == 'dua'){
        $("#displaysatu").show();
        $("#displaydua").hide();
        $("#satukembali").show();
        $('.loader').hide();
    }
}

function SubmitUsahawan(){
    if (confirm('Anda pasti ingin simpan data usahawan?')) {
        $('.loader').show();
        $('#datausahawan').submit();
    }else{
        alert('Data Usahawan tidak disimpan');
    }
    
}

function SahkanUsahawan(){
    $('.loader').show();
    var id = $("#displaydua input[name=idusahawan]").val();
    console.log(id);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "SahUsahawanProfil",
        type:"PUT",
        data: {
            id:id
        },
        success: function(data) {
            alert("Profil Usahawan Sahkan Berjaya");
            location.reload();
        },
        error: function(e){
            console.log(e);
            $('.loader').hide();
            alert('failure');
        }
    });
}

function profileimg(){
    $('.loader').show();
    var formData = new FormData();
    formData.append('file', $("#profile-image")[0].files[0]);
    formData.append('id', $("#displaydua input[name=idusahawan]").val());

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/UploadProfile",
        type:"POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
            alert("Muat Naik Gambar Profil Usahawan Berjaya");
            $("#usahawanprofilpic").attr("src",data);
            $('.loader').hide();
        },
        error: function(){
            alert('failure');
            $('.loader').hide();
        }
    });
}

</script>
@endsection
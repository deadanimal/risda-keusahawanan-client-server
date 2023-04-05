@extends('dashboard')
@section('content')
<div class="card">
    <div class="card-body overflow-hidden p-lg-6">
      <a style="margin-top:-2vh;margin-left:-2vh;" class="btn btn-sm btn-outline-secondary border-300 me-2" href="/insentifWeb"> 
        <span class="fas fa-chevron-left me-1" data-fa-transform="shrink-4"></span>Kembali</a>
        <div class="row align-items-center">
            <h3 class="text" style="padding-bottom:20px;color:#00A651;padding-top:3vh;">Insentif Usahawan</h3>
            @if ($addinsen == true)
            <div class="card-body bg-light" style="padding-top: 1vh;">
              <form id="dataInsentif" class="row g-3" method="POST" action="/insentifWeb" enctype="multipart/form-data">
                @csrf
                @method("POST")
                <input name="id_pengguna" style="display: none;" type="text" value="{{$id_pengguna}}"/>
                <div class="position-relative rounded-1 border bg-white dark__bg-1100 p-3">
                  <div class="row gx-2">
                    <div class="col-sm-6 mb-3">
                      <label class="form-label" for="field-type">Jenis Insentif <span style="color:red;">*</span></label>
                      <select class="form-select form-select-sm" name="id_jenis_insentif" placeholder="Jenis Insentif">
                        <option value="" disabled selected>Pilih Jenis Insentif</option>
                        @foreach ($ddInsentif as $items)
                            <option value="{{ $items->id_jenis_insentif }}"> 
                                {{ $items->nama_insentif }} 
                            </option>
                        @endforeach
                      </select>
                      {{-- <select class="form-select form-select-sm" name="id_jenis_insentif" id="field-type">
                        <option value="1">Select a type</option>
                        <option value="2">Text</option>
                        <option value="3">Checkboxes</option>
                        <option value="4">Radio Buttons</option>
                        <option value="5">Textarea</option>
                        <option value="6">Date</option>
                        <option value="7">Dropdowns</option>
                        <option value="8">File</option>
                      </select> --}}
                    </div>
                    <div class="col-sm-6 mb-3">
                      <label class="form-label" for="field-name">Nilai Insentif (RM) <span style="color:red;">*</span></label>
                      <input class="form-control form-control-sm" name="nilai_insentif" id="nilai" type="number" placeholder='0.00'/>
                    </div>
                    <div class="col-sm-6 mb-3">
                      <label class="form-label" for="field-name">Tahun Terima Insentif <span style="color:red;">*</span></label>
                      <select class="form-select form-select-sm" name="tahun_terima_insentif" id="field-name" type="text"/>
                      <option value="" disabled selected>Pilih Tahun</option>
                      <?php
                      $curryear = date("Y");
                      $fromyear = date("Y") - 20;
                      for ($year = $curryear; $year >= $fromyear; $year--) {
                        echo "<option value=$year>$year</option>";
                      }
                      ?></select>
                    </div>
                    {{-- <div class="col-12">
                      <label class="form-label" for="field-options">Field Options</label>
                      <textarea class="form-control form-control-sm" id="field-options" rows="3"></textarea>
                      <div class="form-text fs--1 text-warning">* Separate your options with comma</div>
                    </div> --}}
                  </div>
                  <button class="btn btn-primary btn-sm mt-2" type="button" onclick="SubmitInsentif()">Tambah Insentif</button>
                </div>
              </form>
            </div>
            @endif
              @foreach ($insentifs as $insentif)
              <div class="card-body bg-light">
                
                  <div class="position-relative rounded-1 border bg-white dark__bg-1100 p-3">
                  <div class="position-absolute end-0 top-0 mt-2 me-3 z-index-1">
                    <form id="buangdata" method="POST" action="{{ route('insentifWeb.destroy', $insentif->id) }}">
                      @csrf  
                      @method('delete')
                    <button class="btn btn-link btn-sm p-0" type="button" onclick="DeleteInsentif()">
                      <span class="fas fa-times-circle text-danger" data-fa-transform="shrink-1"></span>
                    </button>
                    </form>
                  </div>
                  <form id="updateInsentif" class="row g-3" method="POST" action="/insentifWeb/{{$insentif->id}}" enctype="multipart/form-data">
                    @csrf  
                    @method('PUT')
                    <input name="id_pengguna" style="display: none;" type="text" value="{{$id_pengguna}}"/>
                    <div class="row gx-2">
                      <div class="col-sm-6 mb-3">
                        <label class="form-label" for="field-type">Jenis Insentif <span style="color:red;">*</span></label> 
                        <select class="form-select form-select-sm" name="id_jenis_insentif" placeholder="Jenis Insentif">
                          <option value="" disabled>Pilih Jenis Insentif</option>
                          @foreach ($ddInsentif as $items)
                              <option value="{{ $items->id_jenis_insentif }}" {{ ( $items->id_jenis_insentif == $insentif->id_jenis_insentif) ? 'selected' : '' }}> 
                                  {{ $items->nama_insentif }} 
                              </option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-sm-6 mb-3">
                        <label class="form-label" for="field-name">Nilai Insentif (RM) <span style="color:red;">*</span></label>
                        <input class="form-control form-control-sm" name="nilai_insentif" id="field-name" type="number" value="{{$insentif->nilai_insentif}}"/>
                      </div>
                      <div class="col-sm-6 mb-3">
                        <label class="form-label" for="field-name">Tahun Terima Insentif <span style="color:red;">*</span></label>
                        <select class="form-select form-select-sm" name="tahun_terima_insentif" id="field-name" type="text"/>
                        <option value="" disabled>Pilih Tahun</option>
                          <?php
                          $curryear = date("Y");
                          $fromyear = date("Y") - 20;
                          for ($year = $curryear; $year >= $fromyear; $year--) {
                            $selected = (isset($insentif->tahun_terima_insentif) && $insentif->tahun_terima_insentif == $year) ? 'selected' : '';
                            echo "<option value=$year $selected>$year</option>";
                          }
                          ?>
                        </select>
                        {{-- <input class="form-control form-control-sm" name="tahun_terima_insentif" id="field-name" type="text" value="{{$insentif->tahun_terima_insentif}}"/> --}}
                      </div>
                    </div>
                    <button class="btn btn-primary btn-sm mt-2" style="width:fit-content;" type="button" onclick="UpdateInsentif()">Kemaskini Insentif</button>
                  </form>
                  </div>
                

              </div>
              <div style="padding-top: 1vh"></div>
              @endforeach
            
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">

  $( document ).ready(function() {
      $('.loader').hide();
      $("#nilai").change(function() {
        $(this).val(parseFloat($(this).val()).toFixed(2));
      });
      var group = $('input[name="nilai_insentif"]');
      group.each(function () {
        $(this).val(parseFloat($(this).val()).toFixed(2));
        $(this).change(function() {
          $(this).val(parseFloat($(this).val()).toFixed(2));
        });
      });
  });
  
  function SubmitInsentif(){
    if (confirm('Anda pasti ingin simpan data insentif usahawan?')) {
        $('.loader').show();
        $('#dataInsentif').submit();
    }else{
        alert('Data Insentif Usahawan tidak disimpan');
    }
  }
  function UpdateInsentif(){
    if (confirm('Anda pasti ingin kemaskini data insentif usahawan?')) {
        $('.loader').show();
        $('#updateInsentif').submit();
    }else{
        alert('Data Insentif Usahawan Tidak Dikemaskini');
    }
  }
  function DeleteInsentif(){
    if (confirm('Anda pasti ingin buang data insentif usahawan?')) {
        $('.loader').show();
        $('#buangdata').submit();
    }else{
        alert('Data Insentif Usahawan Tidak Dibuang');
    }
  }
  </script>
@endsection
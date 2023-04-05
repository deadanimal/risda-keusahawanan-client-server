@extends('dashboard')
@section('content')
<div class="card">
    <div class="card-body overflow-hidden p-lg-6">
        <div class="row align-items-center" style="overflow-x: auto !important;overflow-y: auto !important;">
            <style>
                .sorting {
                    background-image : none !important;
                }
            </style>
            <h3 class="text" style="padding-bottom:20px;color:#00A651;">Tetapan Kategori Usahawan</h3>
            <table id="tblkateusah" style="padding-bottom:2vh;text-align:center;">
                <colgroup>
                    <col span="1" style="width: 15%;">
                    <col span="1" style="width: 20%;">
                    <col span="1" style="width: 20%;">
                    <col span="1" style="width: 20%;">
                    <col span="1" style="width: 15%;">
                    <col span="1" style="width: 15%;">
                 </colgroup>
                 <thead>
                    <tr class="align-middle">
                        <th scope="col">ID Kategori Usahawan <span style="color:red;">*</span></th>
                        <th scope="col">Nama Kategori Usahawan <span style="color:red;">*</span></th>
                        <th scope="col">Jualan Minimum Usahawan <span style="color:red;">*</span></th>
                        <th scope="col">Jualan Maksimum Usahawan (RM) <span style="color:red;">*</span></th>
                        <th scope="col">Status Kategori Usahawan (RM) <span style="color:red;">*</span></th>
                        <th scope="col"></th>
                    </tr>
                 </thead>
                 <tbody>
                    <tr>
                        <form id="kategoriUsahawan" method="POST" action="/kategoriusahawan" enctype="multipart/form-data">
                        @csrf
                        @method("POST")
                        <td><input class="form-control form-control-sm" name="id_kategori_usahawan" id="field-name" type="text" value="" placeholder="Masukkan id kategori usahawan"/></td>
                        <td><input class="form-control form-control-sm" name="nama_kategori_usahawan" id="field-name" type="text" value="" placeholder="Masukkan nama kategori usahawan"/></td>
                        <td><input class="form-control form-control-sm" name="jualan_usahawan_min" id="field-name" type="number" value="" placeholder="Masukkan jualan minimum usahawan"/></td>
                        <td><input class="form-control form-control-sm" name="jualan_usahawan_max" id="field-name" type="number" value="" placeholder="Masukkan jualan maximum usahawan"/></td>
                        <td><select class="form-select form-select-sm" name="status_kategori_usahawan" aria-label=".form-select-sm example" style="display:inline-block;">
                            <option disabled selected>Pilih</option>
                            <option value="aktif">aktif</option>
                            <option value="tak aktif">tak aktif</option>
                        </select></td>
                        <td style="text-align:center;"><button class="btn btn-primary btn-sm" type="button" style="width:15vh" onclick="simpankategori();" >Simpan </button></td>
                        </form>
                    </tr>
                    @foreach ($kategoriusahawan as $kateusahawan)
                    <tr>
                        <form id="kemaskinikate{{$kateusahawan->id}}" method="POST" action="/kategoriusahawan/{{$kateusahawan->id}}" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <td class="text-nowrap">
                            <input class="form-control form-control-sm" name="id_kategori_usahawan" id="field-name" type="text" value="{{$kateusahawan->id_kategori_usahawan}}"/>
                        </td>
                        <td class="text-nowrap">
                            <input class="form-control form-control-sm" name="nama_kategori_usahawan" id="field-name" type="text" value="{{$kateusahawan->nama_kategori_usahawan}}"/>
                        </td>
                        <td class="text-nowrap">
                            <input class="form-control form-control-sm" name="jualan_usahawan_min" id="field-name" type="numper" value="{{$kateusahawan->jualan_usahawan_min}}"/>
                        </td>
                        <td class="text-nowrap">
                            <input class="form-control form-control-sm" name="jualan_usahawan_max" id="field-name" type="number" value="{{$kateusahawan->jualan_usahawan_max}}"/>
                        </td>
                        <td class="text-nowrap">
                            <select class="form-select form-select-sm" name="status_kategori_usahawan" aria-label=".form-select-sm example" style="display:inline-block;">
                                <option disabled>Pilih</option>
                                <option {{ ( $kateusahawan->status_kategori_usahawan == "aktif" ) ? 'selected' : '' }} value="aktif">aktif</option>
                                <option {{ ( $kateusahawan->status_kategori_usahawan == "tak aktif" ) ? 'selected' : '' }} value="tak aktif">tak aktif</option>
                            </select>
                        </td>
                        <td class="text-nowrap">
                            <button type="button" class="btn btn-warning btn-sm" style="width:15vh" onclick="updatekategori({{$kateusahawan->id}});">Kemaskini</button>
                        </form>
                            {{-- &nbsp
                            <form method="POST" style="display:inline-block;" action="{{ route('kategoriusahawan.destroy', $kateusahawan->id) }}">
                            @csrf  
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm">Buang</button>
                            </form> --}}
                        </td>
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
        var table = $('#tblkateusah').DataTable({
            "paging":   true,
            "bFilter": false,
            "sorting":false,
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

        var group = $('input[name="jualan_usahawan_min"]');
        group.each(function () {
            $(this).val(parseFloat($(this).val()).toFixed(2));
            $(this).change(function() {
            $(this).val(parseFloat($(this).val()).toFixed(2));
            });
        });

        var grouptwo = $('input[name="jualan_usahawan_max"]');
        grouptwo.each(function () {
            $(this).val(parseFloat($(this).val()).toFixed(2));
            $(this).change(function() {
            $(this).val(parseFloat($(this).val()).toFixed(2));
            });
        });

        $('.loader').hide();
    })

    function simpankategori(){
        if (confirm('Anda pasti ingin simpan data Kategori Usahawan?')) {
            $('.loader').show();
            $('#kategoriUsahawan').submit();
        }else{
            alert('Data tidak disimpan');
            return;
        }
    }

    function updatekategori(id){
        if (confirm('Anda pasti ingin simpan data Kategori Usahawan?')) {
            $('.loader').show();
            $('#kemaskinikate'+id).submit();
        }else{
            alert('Data tidak disimpan');
            return;
        }
    }
</script>
@endsection 
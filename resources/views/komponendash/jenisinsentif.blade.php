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
            <h3 class="text" style="padding-bottom:20px;color:#00A651;">Tetapan Jenis Insentif</h3>
            <table id="tbljenis" style="padding-bottom:2vh;text-align:center;">
                <colgroup>
                    <col span="1" style="width: 15%;">
                    <col span="1" style="width: 45%;">
                    <col span="1" style="width: 20%;">
                    <col span="1" style="width: 20%;">
                 </colgroup>
                 <thead>
                    <tr class="align-middle">
                        <th scope="col">Kod Insentif <span style="color:red;">*</span></th>
                        <th scope="col">Nama Insentif <span style="color:red;">*</span></th>
                        <th scope="col">Status Insentif <span style="color:red;">*</span></th>
                        <th scope="col"></th>
                    </tr>
                 </thead>
                 <tbody>
                    <tr>
                        <form id="jenisInsen" method="POST" action="/jenisinsentif" enctype="multipart/form-data">
                        @csrf
                        @method("POST")
                        <td><input class="form-control form-control-sm" name="id_jenis_insentif" id="field-name" type="text" value="" placeholder="Masukkan Kod Insentif"/></td>
                        <td><input class="form-control form-control-sm" name="nama_insentif" id="field-name" type="text" value="" placeholder="Masukkan Nama Insentif"/></td>
                        <td><select class="form-select form-select-sm" name="status" aria-label=".form-select-sm example" style="display:inline-block;width:20vh;">
                            <option disabled selected>Pilih</option>
                            <option value="aktif">aktif</option>
                            <option value="tak aktif">tak aktif</option>
                        </select></td>
                        <td style="text-align:center;"><button class="btn btn-primary btn-sm" style="width:15vh" type="button" onclick="simpanJenis();">Simpan </button></td>
                        </form>
                    </tr>
                    @foreach ($jenisinsentifs as $jenisinsentif)
                    <tr>
                        <form id="updatejenis{{$jenisinsentif->id}}" method="POST" action="/jenisinsentif/{{$jenisinsentif->id}}" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <td class="text-nowrap">
                            <input class="form-control form-control-sm" name="id_jenis_insentif" id="field-name" type="text" value="{{$jenisinsentif->id_jenis_insentif}}"/>
                        </td>
                        <td class="text-nowrap">
                            <input class="form-control form-control-sm" name="nama_insentif" id="field-name" type="text" value="{{$jenisinsentif->nama_insentif}}"/>
                        </td>
                        <td class="text-nowrap">
                            <select class="form-select form-select-sm" name="status" aria-label=".form-select-sm example" style="display:inline-block;width:20vh;">
                                <option disabled>Status Insentif</option>
                                <option {{ ( $jenisinsentif->status == "aktif" ) ? 'selected' : '' }} value="aktif">aktif</option>
                                <option {{ ( $jenisinsentif->status == "tak aktif" ) ? 'selected' : '' }} value="tak aktif">tak aktif</option>
                            </select>
                        </td>
                        <td class="text-nowrap">
                            <button type="button" class="btn btn-warning btn-sm" style="width:15vh" onclick="updateJenis({{$jenisinsentif->id}});">Kemaskini</button>
                        
                            {{-- &nbsp
                            <form method="POST" style="display:inline-block;" action="{{ route('jenisinsentif.destroy', $jenisinsentif->id) }}">
                            @csrf  
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm">Buang</button>
                            </form> --}}
                        </td>
                        </form>
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
        var table = $('#tbljenis').DataTable({
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
        $('.loader').hide();
    })

    function simpanJenis(){
        if (confirm('Anda pasti ingin simpan data Jenis Insentif?')) {
            $('.loader').show();
            $('#jenisInsen').submit();
        }else{
            alert('Data tidak disimpan');
        }
    }

    function updateJenis(id){
        if (confirm('Anda pasti ingin simpan data Jenis Insentif?')) {
            $('.loader').show();
            $('#updatejenis'+id).submit();
        }else{
            alert('Data tidak disimpan');
        }
    }
</script>
@endsection 
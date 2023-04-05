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
            <h3 class="text" style="padding-bottom:20px;color:#00A651;">Tetapan Tindakan Lawatan</h3>
            <table id="tbltindaklawat" style="padding-bottom:2vh;text-align:center;">
                <colgroup>
                    <col span="1" style="width: 60%;">
                    <col span="1" style="width: 20%;">
                    <col span="1" style="width: 20%;">
                 </colgroup>
                 <thead>
                    <tr class="align-middle">
                        <th scope="col">Nama Tindakan Lawatan <span style="color:red;">*</span></th>
                        <th scope="col">Status Tindakan Lawatan <span style="color:red;">*</span></th>
                        <th scope="col"></th>
                    </tr>
                 </thead>
                 <tbody>
                    <tr>
                        <form id="tindLawatan" method="POST" action="/tindakanlawatan" enctype="multipart/form-data">
                        @csrf
                        @method("POST") 
                        <td class="text-nowrap"><input class="form-control form-control-sm" name="nama_tindakan_lawatan" id="field-name" type="text" value="" style="width:80vh" placeholder="Masukkan nama tindakan lawatan"/></td>
                        <td class="text-nowrap"><select class="form-select form-select-sm" name="status_tindakan_lawatan" aria-label=".form-select-sm example" style="width:25vh;">
                            <option disabled selected>Pilih</option>
                            <option value="aktif">aktif</option>
                            <option value="tak aktif">tak aktif</option>
                        </select></td>
                        <td class="text-nowrap"><button class="btn btn-primary btn-sm" type="button" style="width:15vh" onclick="simpanaliran();" >Simpan </button></td>
                        </form>
                    </tr>
                    @foreach ($tindakanlawatan as $tindlawatan)
                    <tr>
                        <form id="kemaskinidata{{$tindlawatan->id}}" method="POST" action="/tindakanlawatan/{{$tindlawatan->id}}" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <td class="text-nowrap">
                            <input class="form-control form-control-sm" name="nama_tindakan_lawatan" id="field-name" type="text" value="{{$tindlawatan->nama_tindakan_lawatan}}" style="width:80vh"/>
                        </td>
                        <td class="text-nowrap">
                            <select class="form-select form-select-sm" name="status_tindakan_lawatan" aria-label=".form-select-sm example" style="width:25vh;">
                                <option disabled>Pilih</option>
                                <option {{ ( $tindlawatan->status_tindakan_lawatan == "aktif" ) ? 'selected' : '' }} value="aktif">aktif</option>
                                <option {{ ( $tindlawatan->status_tindakan_lawatan == "tak aktif" ) ? 'selected' : '' }} value="tak aktif">tak aktif</option>
                            </select>
                        </td>
                        <td class="text-nowrap">
                            <button type="button" class="btn btn-warning btn-sm" style="width:15vh" onclick="kemaskinilawatan({{$tindlawatan->id}});">Kemaskini</button>
                        </form>
                            {{-- <form method="POST" style="display:inline-block;" action="{{ route('tindakanlawatan.destroy', $tindlawatan->id) }}">
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
        var table = $('#tbltindaklawat').DataTable({
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
    });

    function simpanaliran(){
        if (confirm('Anda pasti ingin simpan data tindakan lawatan?')) {
            $('.loader').show();
            $('#tindLawatan').submit();
        }else{
            alert('Data tidak disimpan');
        }
    }

    function kemaskinilawatan(id){
        if (confirm('Anda pasti ingin kemaskini data tindakan lawatan?')) {
            $('.loader').show();
            $('#kemaskinidata'+id).submit();
        }else{
            alert('Data tidak disimpan');
        }
    }
</script>
@endsection 
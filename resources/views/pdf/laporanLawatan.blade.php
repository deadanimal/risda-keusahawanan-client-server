<html>

<head>
    <meta http-equiv=Content-Type content="text/html; charset=UTF-8">
    <style type="text/css">
        span.cls_002 {
            font-family: "Calibri Bold", sans-serif;
            font-size: 9.8px;
            color: rgb(0, 0, 0);
            font-weight: bold;
            font-style: normal;
            text-decoration: none
        }

        div.cls_002 {
            font-family: "Calibri Bold", sans-serif;
            font-size: 9.8px;
            color: rgb(0, 0, 0);
            font-weight: bold;
            font-style: normal;
            text-decoration: none
        }

        span.cls_003 {
            font-family: Arial, sans-serif;
            font-size: 12.0px;
            color: rgb(0, 0, 0);
            font-weight: normal;
            font-style: normal;
            text-decoration: none
        }

        div.cls_003 {
            font-family: Arial, sans-serif;
            font-size: 12.0px;
            color: rgb(0, 0, 0);
            font-weight: normal;
            font-style: normal;
            text-decoration: none
        }

        table,
        th,
        td {
            width: 100%;
            /* border: 1px solid black; */
            border-collapse: collapse;
            padding: 2px;
        }

        .border_black {
            border: 1px solid black;
        }

        th {
            text-align: left;
        }

    </style>
    <script type="text/javascript"
        src="e5e32482-6f8c-11ec-a980-0cc47a792c0a_id_e5e32482-6f8c-11ec-a980-0cc47a792c0a_files/wz_jsgraphics.js"></script>
</head>

<body>
    <div style="position:absolute;left:50%;margin-left:-297px;top:0px;width:595px;height:842px;overflow:hidden">


        <div style="position:absolute;left:156.36px;top:52.06px" class="cls_002"><span
                class="cls_002">LAPORAN LAWATAN PEMANTAUAN INDIVIDU TAHUN {{ $year }}</span>
        </div>


        <div style="position:absolute;left:94.01px;top:77.43px; width:450px;" class="cls_002">

            <table style="width: 100%;">

                <tr>
                    <th class="border_black" style="width: 40% !important;">
                        NAMA USAHAWAN
                    </th>
                    <td style="width: 10% !important; border:none !important"></td>
                    <td class="border_black"> {{ $usahawan->namausahawan }} </td>
                </tr>
                <tr>
                    <th class="border_black" style="width: 40% !important;">
                        NAMA SYARIKAT
                    </th>
                    <td style="width: 10% !important; border:none !important"></td>
                    <td class="border_black">
                        @if ($usahawan->syarikat != null)
                            {{ $usahawan->syarikat->namasyarikat }}
                        @endif
                    </td>
                </tr>

                <tr>
                    <th class="border_black" style="width: 40% !important;">
                        DAERAH
                    </th>
                    <td style="width: 10% !important; border:none !important"></td>
                    <td class="border_black">
                        @if ($usahawan->perniagaan != null)
                            @if ($usahawan->perniagaan->daerah)
                                {{ $usahawan->perniagaan->daerah->Daerah }}
                            @endif
                        @endif
                    </td>
                </tr>

                <tr>
                    <th class="border_black" style="width: 40% !important;">
                        NEGERI
                    </th>
                    <td style="width: 10% !important; border:none !important"></td>
                    <td class="border_black">
                        @if ($usahawan->perniagaan != null)
                            @if ($usahawan->perniagaan->negeri)
                                {{ $usahawan->perniagaan->negeri->Negeri }}
                            @endif
                        @endif
                    </td>
                </tr>

                <tr>
                    <th class="border_black" style="width: 40% !important;">
                        JENIS PERNIAGAAN
                    </th>
                    <td style="width: 10% !important; border:none !important"></td>
                    <td class="border_black">
                        {{-- {{ $lawatan->jenisperniagaan }} --}}
                        @if ($usahawan->perniagaan != null)
                            @if ($usahawan->perniagaan->jenisperniagaan == 'A')
                                PENGELUARAN PRODUK MAKANAN
                            @elseif ($usahawan->perniagaan->jenisperniagaan == 'B')
                                PENGELUARAN PRODUK BUKAN MAKANAN
                            @elseif ($usahawan->perniagaan->jenisperniagaan == 'C')
                                PENGELUARAN PRODUK PERTANIAN
                            @elseif ($usahawan->perniagaan->jenisperniagaan == 'D')
                                PERKHIDMATAN PEMASARAN
                            @elseif ($usahawan->perniagaan->jenisperniagaan == 'E')
                                PERKHIDMATAN BUKAN PEMASARAN
                            @endif
                        @endif


                    </td>
                </tr>

                <tr>
                    <th class="border_black" style="width: 40% !important;">
                        JENIS INSENTIF
                    </th>
                    <td style="width: 10% !important; border:none !important"></td>
                    <td class="border_black">

                        @foreach ($insentifs as $insentif)
                            {{ $insentif->nama_insentif }}
                            ({{ $insentif->tahun_terima_insentif }})
                            <br>
                        @endforeach

                    </td>
                </tr>

                <tr>
                    <th style="width: 40% !important;">&nbsp;</th>
                    <td style="width: 10% !important; border:none !important"></td>
                    <td>&nbsp;</td>
                </tr>

                <tr>
                    <th class="border_black" style="width: 40% !important;">
                        TARIKH LAWATAN
                    </th>
                    <td style="width: 10% !important; border:none !important"></td>
                    <td class="border_black">

                        {{-- {{ $lawatan->tarikh_lawatan }} --}}

                        {{ date('d/m/Y', strtotime($lawatan->tarikh_lawatan)) }}

                    </td>
                </tr>
                <tr>
                    <th class="border_black" style="width: 40% !important;">
                        MASA LAWATAN
                    </th>
                    <td style="width: 10% !important; border:none !important"></td>
                    <td class="border_black">
                        {{ date('h:m a', strtotime($lawatan->masa_lawatan)) }}
                    </td>
                </tr>

                <tr>
                    <th class="border_black" style="width: 40% !important;">
                        PEGAWAI LAWATAN
                    </th>
                    <td style="width: 10% !important; border:none !important"></td>
                    <td class="border_black">
                        {{ $lawatan->nama_pegawai }}
                    </td>
                </tr>

                <tr>
                    <th style="width: 40% !important;">&nbsp;</th>
                    <td style="width: 10% !important; border:none !important"></td>
                    <td>&nbsp;</td>
                </tr>

                <tr>
                    <th class="border_black" style="width: 40% !important;">
                        GAMBAR LAWATAN
                    </th>
                    <td style="width: 10% !important; border:none !important"></td>
                    <td>
                        {{-- <img src="{{ $lawatan->gambar_lawatan }}" alt="" width="200px" height="200px"> --}}
                        <div style="
                            height: 30%;
                            width:100%;
                            background-image: url('{{ $lawatan->gambar_lawatan }}');
                            background-size: cover;
                            background-repeat: no-repeat;
                            background-position: 50% 50%;
                            ">
                            <!-- <img src="assets/img/pic1.jpeg" alt="" > -->
                        </div>
                    </td>
                </tr>

                <tr>
                    <th style="width: 40% !important;">&nbsp;</th>
                    <td style="width: 10% !important; border:none !important"></td>
                    <td>&nbsp;</td>
                </tr>

                <tr>
                    <th colspan="3">
                        TINDAKAN YANG PERLU DILAKSANAKAN OLEH USAHAWAN
                    </th>
                </tr>
                <tr>
                    <td class="border_black" colspan="3" style="padding: 10px 5px">
                        {{ $lawatan->nama_tindakan_lawatan }}
                    </td>
                </tr>


                <tr>
                    <th style="width: 40% !important;">&nbsp;</th>
                    <td style="width: 10% !important; border:none !important"></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <th colspan="3">
                        CATATAN/ KOMEN KESELURUHAN
                    </th>
                </tr>
                <tr>
                    <td class="border_black" colspan="3" style="padding: 10px 5px">
                        {{ $lawatan->komen }}
                    </td>
                </tr>

            </table>

        </div>

    </div>

</body>

</html>

<head>
    <meta http-equiv=Content-Type content="text/html; charset=UTF-8">
    <style type="text/css">
        h4 {
            font-family: "Calibri", sans-serif;
            /* font-size: 11.1px; */
            font-weight: bold;
            font-style: normal;
            text-decoration: none;
            text-align: center
        }

        table,
        td,
        th {
            border: 1px solid black;
            font-family: "Calibri", sans-serif;
            font-weight: normal;
            font-style: normal;
            text-decoration: none;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 2px
        }

    </style>
</head>

<body>
    <div>
        <h4> RINGKASAN LEJAR BULAN
            @if ($bulan == 1)
                JANUARI
            @elseif ($bulan == 2)
                FEBRUARI
            @elseif ($bulan == 3)
                MAC
            @elseif ($bulan == 4)
                APRIL
            @elseif ($bulan == 5)
                MEI
            @elseif ($bulan == 6)
                JUN
            @elseif ($bulan == 7)
                JULAI
            @elseif ($bulan == 8)
                OGOS
            @elseif ($bulan == 9)
                SEPTEMBER
            @elseif ($bulan == 10)
                OKTOBER
            @elseif ($bulan == 11)
                NOVEMBER
            @elseif ($bulan == 12)
                DISEMBER
            @endif
            TAHUN {{ $tahun }}
        </h4>
    </div>


    <br>
    <table>
        <thead>
            <tr>
                <th>DR</th>
                <th colspan="4" style="width: 200px; text-align:center; font-weight: bold;">TUNAI A/C</th>
                <th style="text-align:right">CR</th>

            </tr>

        </thead>
        <tbody>

            <tr>
                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM)</td>

                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM) </td>
            </tr>

            <tr>
                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>

                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>
            </tr>
            @php
                $jumlah_credit = 0;
                $jumlah_debit = 0;
            @endphp

            @foreach ($alirans as $aliran)
                <tr>
                    @if ($aliran->id_kategori_aliran <= 8)
                        <td>{{$aliran->newTarikh}}</td>
                        <!-- <td>{{ date('M d', strtotime($aliran->tarikh_aliran)) }}</td> -->
                        <td>{{ $aliran->keterangan_aliran }}</td>
                        <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>

                        <td></td>
                        <td></td>
                        <td></td>

                        @php
                            $jumlah_debit += $aliran->jumlah_aliran;
                        @endphp
                    @else
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{$aliran->newTarikh}}</td>
                        <!-- <td>{{ date('M d', strtotime($aliran->tarikh_aliran)) }}</td> -->
                        <td>{{ $aliran->keterangan_aliran }}</td>
                        <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>

                        @php
                            $jumlah_credit += $aliran->jumlah_aliran;
                        @endphp
                    @endif

                </tr>
            @endforeach

            <tr>
                <td></td>
                <td></td>
                <td>{{ number_format($jumlah_debit, 2) }}</td>

                <td></td>
                <td></td>
                <td>{{ number_format($jumlah_credit, 2) }}</td>
            </tr>

        </tbody>
    </table>


    {{-- --------------------------------------------------- --}}
    {{-- jualan_perolehan --}}
    <br>
    <br>

    <table>
        <thead>
            <tr>
                <th>DR</th>
                <th colspan="4" style="width: 200px; text-align:center; font-weight: bold;">JUALAN/PEROLEHAN A/C</th>
                <th style="text-align:right">CR</th>

            </tr>

        </thead>
        <tbody>

            <tr>
                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM)</td>

                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM) </td>
            </tr>

            <tr>
                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>

                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>
            </tr>


            @foreach ($alirans as $aliran)
                @if ($aliran->id_kategori_aliran == 1)
                    <tr>

                        @if ($loop->index == 1)
                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($jualan_perolehan, 2) }}</td>
                        @else
                            <td></td>
                            <td></td>
                            <td></td>
                        @endif

                        <td>{{$aliran->newTarikh}}</td>
                        <!-- <td>{{ date('M d', strtotime($aliran->tarikh_aliran)) }}</td> -->
                        <td>{{ $aliran->keterangan_aliran }}</td>
                        <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>

                    </tr>
                @else
                    @if ($loop->index == 1)
                        <tr>
                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($jualan_perolehan, 2) }}</td>

                            <td></td>
                            <td></td>
                            <td></td>

                        </tr>
                    @endif
                @endif
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($jualan_perolehan, 2) }}</td>

                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($jualan_perolehan, 2) }}</td>

            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
                <td></td>

                <td></td>
                <td></td>
                <td></td>

            </tr>


            <tr>

                <td></td>
                <td></td>
                <td></td>

                <td>{{ date('M d', strtotime($nextmonth)) }}</td>
                <td>BAKI B/B</td>
                <td>{{ number_format($jualan_perolehan, 2) }}</td>


            </tr>

        </tbody>
    </table>


    {{-- --------------------------------------------------- --}}
    {{-- deposit_jualan --}}
    <br>
    <br>

    <table>
        <thead>
            <tr>
                <th>DR</th>
                <th colspan="4" style="width: 200px; text-align:center; font-weight: bold;">DEPOSIT JUALAN A/C</th>
                <th style="text-align:right">CR</th>

            </tr>

        </thead>
        <tbody>

            <tr>
                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM)</td>

                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM) </td>
            </tr>

            <tr>
                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>

                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>
            </tr>


            @foreach ($alirans as $aliran)
                @if ($aliran->id_kategori_aliran == 2)
                    <tr>

                        @if ($loop->index == 1)
                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($deposit_jualan, 2) }}</td>
                        @else
                            <td></td>
                            <td></td>
                            <td></td>
                        @endif

                        <td>{{$aliran->newTarikh}}</td>
                        <!-- <td>{{ date('M d', strtotime($aliran->tarikh_aliran)) }}</td> -->
                        <td>{{ $aliran->keterangan_aliran }}</td>
                        <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>

                    </tr>
                @else
                    @if ($loop->index == 1)
                        <tr>
                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($deposit_jualan, 2) }}</td>

                            <td></td>
                            <td></td>
                            <td></td>

                        </tr>
                    @endif
                @endif
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($deposit_jualan, 2) }}</td>

                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($deposit_jualan, 2) }}</td>

            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
                <td></td>

                <td></td>
                <td></td>
                <td></td>

            </tr>


            <tr>

                <td></td>
                <td></td>
                <td></td>

                <td>{{ date('M d', strtotime($nextmonth)) }}</td>
                <td>BAKI B/B</td>
                <td>{{ number_format($deposit_jualan, 2) }}</td>

            </tr>

        </tbody>
    </table>


    {{-- --------------------------------------------------- --}}
    {{-- pulangan belian --}}
    <br>
    <br>

    <table>
        <thead>
            <tr>
                <th>DR</th>
                <th colspan="4" style="width: 200px; text-align:center; font-weight: bold;">PULANGAN BELIAN A/C</th>
                <th style="text-align:right">CR</th>

            </tr>

        </thead>
        <tbody>

            <tr>
                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM)</td>

                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM) </td>
            </tr>

            <tr>
                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>

                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>
            </tr>


            @foreach ($alirans as $aliran)
                @if ($aliran->id_kategori_aliran == 3)
                    <tr>

                        @if ($loop->index == 1)
                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($pulangan_belian, 2) }}</td>
                        @else
                            <td></td>
                            <td></td>
                            <td></td>
                        @endif

                        <td>{{$aliran->newTarikh}}</td>
                        <!-- <td>{{ date('M d', strtotime($aliran->tarikh_aliran)) }}</td> -->
                        <td>{{ $aliran->keterangan_aliran }}</td>
                        <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>

                    </tr>
                @else
                    @if ($loop->index == 1)
                        <tr>
                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($pulangan_belian, 2) }}</td>

                            <td></td>
                            <td></td>
                            <td></td>

                        </tr>
                    @endif
                @endif
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($pulangan_belian, 2) }}</td>

                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($pulangan_belian, 2) }}</td>

            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
                <td></td>

                <td></td>
                <td></td>
                <td></td>

            </tr>


            <tr>
                <td></td>
                <td></td>
                <td></td>

                <td>{{ date('M d', strtotime($nextmonth)) }}</td>
                <td>BAKI B/B</td>
                <td>{{ number_format($pulangan_belian, 2) }}</td>
            </tr>

        </tbody>
    </table>


    {{-- --------------------------------------------------- --}}
    {{-- -----------------stok akhir---------------------------------- --}}
    <br>
    <br>

    <table>
        <thead>
            <tr>
                <th>DR</th>
                <th colspan="4" style="width: 200px; text-align:center; font-weight: bold;">STOK AKHIR A/C</th>
                <th style="text-align:right">CR</th>

            </tr>

        </thead>
        <tbody>

            <tr>
                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM)</td>

                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM) </td>
            </tr>

            <tr>
                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>

                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>
            </tr>


            @foreach ($alirans as $aliran)
                @if ($aliran->id_kategori_aliran == 4)
                    <tr>

                        @if ($loop->index == 1)
                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($stok_akhir, 2) }}</td>
                        @else
                            <td></td>
                            <td></td>
                            <td></td>
                        @endif

                        <td>{{$aliran->newTarikh}}</td>
                        <!-- <td>{{ date('M d', strtotime($aliran->tarikh_aliran)) }}</td> -->
                        <td>{{ $aliran->keterangan_aliran }}</td>
                        <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>

                    </tr>
                @else
                    @if ($loop->index == 1)
                        <tr>
                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($stok_akhir, 2) }}</td>

                            <td></td>
                            <td></td>
                            <td></td>

                        </tr>
                    @endif
                @endif
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($stok_akhir, 2) }}</td>

                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($stok_akhir, 2) }}</td>

            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
                <td></td>

                <td></td>
                <td></td>
                <td></td>

            </tr>


            <tr>
                <td></td>
                <td></td>
                <td></td>

                <td>{{ date('M d', strtotime($nextmonth)) }}</td>
                <td>BAKI B/B</td>
                <td>{{ number_format($stok_akhir, 2) }}</td>

            </tr>

        </tbody>
    </table>


    {{-- --------------------------------------------------- --}}
    {{-- hasil_sewaan --}}
    <br>
    <br>

    <table>
        <thead>
            <tr>
                <th>DR</th>
                <th colspan="4" style="width: 200px; text-align:center; font-weight: bold;">HASIL SEWAAN A/C</th>
                <th style="text-align:right">CR</th>

            </tr>

        </thead>
        <tbody>

            <tr>
                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM)</td>

                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM) </td>
            </tr>

            <tr>
                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>

                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>
            </tr>


            @foreach ($alirans as $aliran)
                @if ($aliran->id_kategori_aliran == 5)
                    <tr>

                        @if ($loop->index == 1)
                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($hasil_sewaan, 2) }}</td>
                        @else
                            <td></td>
                            <td></td>
                            <td></td>
                        @endif

                        <td>{{$aliran->newTarikh}}</td>
                        <!-- <td>{{ date('M d', strtotime($aliran->tarikh_aliran)) }}</td> -->
                        <td>{{ $aliran->keterangan_aliran }}</td>
                        <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>

                    </tr>
                @else
                    @if ($loop->index == 1)
                        <tr>
                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($hasil_sewaan, 2) }}</td>

                            <td></td>
                            <td></td>
                            <td></td>

                        </tr>
                    @endif
                @endif
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($hasil_sewaan, 2) }}</td>

                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($hasil_sewaan, 2) }}</td>

            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
                <td></td>

                <td></td>
                <td></td>
                <td></td>

            </tr>


            <tr>
                <td></td>
                <td></td>
                <td></td>

                <td>{{ date('M d', strtotime($nextmonth)) }}</td>
                <td>BAKI B/B</td>
                <td>{{ number_format($hasil_sewaan, 2) }}</td>

            </tr>

        </tbody>
    </table>


    {{-- --------------------------------------------------- --}}
    {{-- ---------------------hasil dividen------------------------------ --}}
    <br>
    <br>

    <table>
        <thead>
            <tr>
                <th>DR</th>
                <th colspan="4" style="width: 200px; text-align:center; font-weight: bold;">HASIL DIVIDEN A/C</th>
                <th style="text-align:right">CR</th>

            </tr>

        </thead>
        <tbody>

            <tr>
                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM)</td>

                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM) </td>
            </tr>

            <tr>
                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>

                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>
            </tr>


            @foreach ($alirans as $aliran)
                @if ($aliran->id_kategori_aliran == 6)
                    <tr>

                        @if ($loop->index == 1)
                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($hasil_dividen, 2) }}</td>
                        @else
                            <td></td>
                            <td></td>
                            <td></td>
                        @endif

                        <td>{{$aliran->newTarikh}}</td>
                        <!-- <td>{{ date('M d', strtotime($aliran->tarikh_aliran)) }}</td> -->
                        <td>{{ $aliran->keterangan_aliran }}</td>
                        <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>

                    </tr>
                @else
                    @if ($loop->index == 1)
                        <tr>
                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($hasil_dividen, 2) }}</td>

                            <td></td>
                            <td></td>
                            <td></td>

                        </tr>
                    @endif
                @endif
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($hasil_dividen, 2) }}</td>

                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($hasil_dividen, 2) }}</td>

            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
                <td></td>

                <td></td>
                <td></td>
                <td></td>

            </tr>


            <tr>

                <td></td>
                <td></td>
                <td></td>

                <td>{{ date('M d', strtotime($nextmonth)) }}</td>
                <td>BAKI B/B</td>
                <td>{{ number_format($hasil_dividen, 2) }}</td>
            </tr>

        </tbody>
    </table>


    {{-- --------------------------------------------------- --}}
    {{-- hasil_komisen --}}
    <br>
    <br>

    <table>
        <thead>
            <tr>
                <th>DR</th>
                <th colspan="4" style="width: 200px; text-align:center; font-weight: bold;">HASIL KOMISEN A/C</th>
                <th style="text-align:right">CR</th>

            </tr>

        </thead>
        <tbody>

            <tr>
                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM)</td>

                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM) </td>
            </tr>

            <tr>
                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>

                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>
            </tr>


            @foreach ($alirans as $aliran)
                @if ($aliran->id_kategori_aliran == 7)
                    <tr>

                        @if ($loop->index == 1)
                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($hasil_komisen, 2) }}</td>
                        @else
                            <td></td>
                            <td></td>
                            <td></td>
                        @endif

                        <td>{{$aliran->newTarikh}}</td>
                        <!-- <td>{{ date('M d', strtotime($aliran->tarikh_aliran)) }}</td> -->
                        <td>{{ $aliran->keterangan_aliran }}</td>
                        <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>

                    </tr>
                @else
                    @if ($loop->index == 1)
                        <tr>
                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($hasil_komisen, 2) }}</td>

                            <td></td>
                            <td></td>
                            <td></td>

                        </tr>
                    @endif
                @endif
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($hasil_komisen, 2) }}</td>

                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($hasil_komisen, 2) }}</td>

            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
                <td></td>

                <td></td>
                <td></td>
                <td></td>

            </tr>


            <tr>
                <td></td>
                <td></td>
                <td></td>

                <td>{{ date('M d', strtotime($nextmonth)) }}</td>
                <td>BAKI B/B</td>
                <td>{{ number_format($hasil_komisen, 2) }}</td>
            </tr>

        </tbody>
    </table>


    {{-- --------------------------------------------------- --}}
    {{-- hasil_lain --}}
    <br>
    <br>

    <table>
        <thead>
            <tr>
                <th>DR</th>
                <th colspan="4" style="width: 200px; text-align:center; font-weight: bold;">HASIL LAIN A/C</th>
                <th style="text-align:right">CR</th>

            </tr>

        </thead>
        <tbody>

            <tr>
                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM)</td>

                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM) </td>
            </tr>

            <tr>
                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>

                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>
            </tr>


            @foreach ($alirans as $aliran)
                @if ($aliran->id_kategori_aliran == 8)
                    <tr>

                        @if ($loop->index == 1)
                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($hasil_lain, 2) }}</td>
                        @else
                            <td></td>
                            <td></td>
                            <td></td>
                        @endif

                        <td>{{$aliran->newTarikh}}</td>
                        <!-- <td>{{ date('M d', strtotime($aliran->tarikh_aliran)) }}</td> -->
                        <td>{{ $aliran->keterangan_aliran }}</td>
                        <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>

                    </tr>
                @else
                    @if ($loop->index == 1)
                        <tr>
                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($hasil_lain, 2) }}</td>

                            <td></td>
                            <td></td>
                            <td></td>

                        </tr>
                    @endif
                @endif
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($hasil_lain, 2) }}</td>

                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($hasil_lain, 2) }}</td>

            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
                <td></td>

                <td></td>
                <td></td>
                <td></td>

            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>

                <td>{{ date('M d', strtotime($nextmonth)) }}</td>
                <td>BAKI B/B</td>
                <td>{{ number_format($hasil_lain, 2) }}</td>

            </tr>

        </tbody>
    </table>


    {{-- Tunai Keluar --}}

    {{-- --------------------------------------------------- --}}
    {{-- BELIAN --}}
    <br>
    <br>

    <table>
        <thead>
            <tr>
                <th>DR</th>
                <th colspan="4" style="width: 200px; text-align:center; font-weight: bold;">BELIAN A/C</th>
                <th style="text-align:right">CR</th>

            </tr>

        </thead>
        <tbody>

            <tr>
                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM)</td>

                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM) </td>
            </tr>

            <tr>
                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>

                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>
            </tr>


            @foreach ($alirans as $aliran)
                @if ($aliran->id_kategori_aliran == 9)
                    <tr>                        <td>{{$aliran->newTarikh}}</td>
                        <!-- <td>{{ date('M d', strtotime($aliran->tarikh_aliran)) }}</td> -->
                        <td>{{ $aliran->keterangan_aliran }}</td>
                        <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>


                        @if ($loop->index == 0)
                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($belian, 2) }}</td>
                        @else
                            <td></td>
                            <td></td>
                            <td></td>
                        @endif
                    </tr>
                @else
                    @if ($loop->index == 0)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>

                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($belian, 2) }}</td>

                        </tr>
                    @endif
                @endif
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($belian, 2) }}</td>

                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($belian, 2) }}</td>

            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
                <td></td>

                <td></td>
                <td></td>
                <td></td>

            </tr>


            <tr>
                <td>{{ date('M d', strtotime($nextmonth)) }}</td>
                <td>BAKI B/B</td>
                <td>{{ number_format($belian, 2) }}</td>

                <td></td>
                <td></td>
                <td></td>
            </tr>

        </tbody>
    </table>


    {{-- --------------------------------------------------- --}}
    {{-- DEPOSIT BELIAN --}}
    <br>
    <br>

    <table>
        <thead>
            <tr>
                <th>DR</th>
                <th colspan="4" style="width: 200px; text-align:center; font-weight: bold;">DEPOSIT BELIAN A/C</th>
                <th style="text-align:right">CR</th>

            </tr>

        </thead>
        <tbody>

            <tr>
                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM)</td>

                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM) </td>
            </tr>

            <tr>
                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>

                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>
            </tr>


            @foreach ($alirans as $aliran)
                @if ($aliran->id_kategori_aliran == 10)
                    <tr>                        <td>{{$aliran->newTarikh}}</td>
                        <!-- <td>{{ date('M d', strtotime($aliran->tarikh_aliran)) }}</td> -->
                        <td>{{ $aliran->keterangan_aliran }}</td>
                        <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>


                        @if ($loop->index == 0)
                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($deposit_belian, 2) }}</td>
                        @else
                            <td></td>
                            <td></td>
                            <td></td>
                        @endif
                    </tr>
                @else
                    @if ($loop->index == 0)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>

                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($deposit_belian, 2) }}</td>

                        </tr>
                    @endif
                @endif
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($deposit_belian, 2) }}</td>

                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($deposit_belian, 2) }}</td>

            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
                <td></td>

                <td></td>
                <td></td>
                <td></td>

            </tr>


            <tr>
                <td>{{ date('M d', strtotime($nextmonth)) }}</td>
                <td>BAKI B/B</td>
                <td>{{ number_format($deposit_belian, 2) }}</td>

                <td></td>
                <td></td>
                <td></td>
            </tr>

        </tbody>
    </table>


    {{-- --------------------------------------------------- --}}
    {{-- PULANGAN JUALAN --}}
    <br>
    <br>
    <table>
        <thead>
            <tr>
                <th>DR</th>
                <th colspan="4" style="width: 200px; text-align:center; font-weight: bold;">PULANGAN JUALAN A/C</th>
                <th style="text-align:right">CR</th>

            </tr>

        </thead>
        <tbody>

            <tr>
                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM)</td>

                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM) </td>
            </tr>

            <tr>
                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>

                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>
            </tr>


            @foreach ($alirans as $aliran)
                @if ($aliran->id_kategori_aliran == 11)
                    <tr>                        <td>{{$aliran->newTarikh}}</td>
                        <!-- <td>{{ date('M d', strtotime($aliran->tarikh_aliran)) }}</td> -->
                        <td>{{ $aliran->keterangan_aliran }}</td>
                        <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>


                        @if ($loop->index == 0)
                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($pulangan_jualan, 2) }}</td>
                        @else
                            <td></td>
                            <td></td>
                            <td></td>
                        @endif
                    </tr>
                @else
                    @if ($loop->index == 0)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>

                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($pulangan_jualan, 2) }}</td>

                        </tr>
                    @endif
                @endif
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($pulangan_jualan, 2) }}</td>

                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($pulangan_jualan, 2) }}</td>

            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
                <td></td>

                <td></td>
                <td></td>
                <td></td>

            </tr>


            <tr>
                <td>{{ date('M d', strtotime($nextmonth)) }}</td>
                <td>BAKI B/B</td>
                <td>{{ number_format($pulangan_jualan, 2) }}</td>

                <td></td>
                <td></td>
                <td></td>

            </tr>

        </tbody>
    </table>


    {{-- --------------------------------------------------- --}}
    {{-- STOK AWAL --}}
    <br>
    <br>

    <table>
        <thead>
            <tr>
                <th>DR</th>
                <th colspan="4" style="width: 200px; text-align:center; font-weight: bold;">STOK AWAL A/C</th>
                <th style="text-align:right">CR</th>

            </tr>

        </thead>
        <tbody>

            <tr>
                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM)</td>

                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM) </td>
            </tr>

            <tr>
                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>

                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>
            </tr>


            @foreach ($alirans as $aliran)
                @if ($aliran->id_kategori_aliran == 12)
                    <tr>                        <td>{{$aliran->newTarikh}}</td>
                        <!-- <td>{{ date('M d', strtotime($aliran->tarikh_aliran)) }}</td> -->
                        <td>{{ $aliran->keterangan_aliran }}</td>
                        <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>


                        @if ($loop->index == 0)
                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($stok_awal, 2) }}</td>
                        @else
                            <td></td>
                            <td></td>
                            <td></td>
                        @endif
                    </tr>
                @else
                    @if ($loop->index == 0)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>

                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($stok_awal, 2) }}</td>

                        </tr>
                    @endif
                @endif
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($stok_awal, 2) }}</td>

                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($stok_awal, 2) }}</td>

            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
                <td></td>

                <td></td>
                <td></td>
                <td></td>

            </tr>


            <tr>


                <td>{{ date('M d', strtotime($nextmonth)) }}</td>
                <td>BAKI B/B</td>
                <td>{{ number_format($stok_awal, 2) }}</td>

                <td></td>
                <td></td>
                <td></td>
            </tr>

        </tbody>
    </table>



    {{-- --------------------------------------------------- --}}
    {{-- KOS PENGEPOSAN --}}
    <br>
    <br>

    <table>
        <thead>
            <tr>
                <th>DR</th>
                <th colspan="4" style="width: 200px; text-align:center; font-weight: bold;">KOS PENGEPOSAN A/C</th>
                <th style="text-align:right">CR</th>

            </tr>

        </thead>
        <tbody>

            <tr>
                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM)</td>

                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM) </td>
            </tr>

            <tr>
                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>

                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>
            </tr>


            @foreach ($alirans as $aliran)
                @if ($aliran->id_kategori_aliran == 13)
                    <tr>                        <td>{{$aliran->newTarikh}}</td>
                        <!-- <td>{{ date('M d', strtotime($aliran->tarikh_aliran)) }}</td> -->
                        <td>{{ $aliran->keterangan_aliran }}</td>
                        <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>


                        @if ($loop->index == 0)
                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($kos_pengeposan, 2) }}</td>
                        @else
                            <td></td>
                            <td></td>
                            <td></td>
                        @endif
                    </tr>
                @else
                    @if ($loop->index == 0)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>

                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($kos_pengeposan, 2) }}</td>

                        </tr>
                    @endif
                @endif
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($kos_pengeposan, 2) }}</td>

                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($kos_pengeposan, 2) }}</td>

            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
                <td></td>

                <td></td>
                <td></td>
                <td></td>

            </tr>


            <tr>
                <td>{{ date('M d', strtotime($nextmonth)) }}</td>
                <td>BAKI B/B</td>
                <td>{{ number_format($kos_pengeposan, 2) }}</td>

                <td></td>
                <td></td>
                <td></td>
            </tr>

        </tbody>
    </table>


    {{-- --------------------------------------------------- --}}
    {{-- KOS PENGEPOSAN --}}
    <br>
    <br>

    <table>
        <thead>
            <tr>
                <th>DR</th>
                <th colspan="4" style="width: 200px; text-align:center; font-weight: bold;">KOS ALAT TULIS A/C</th>
                <th style="text-align:right">CR</th>

            </tr>

        </thead>
        <tbody>

            <tr>
                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM)</td>

                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM) </td>
            </tr>

            <tr>
                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>

                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>
            </tr>


            @foreach ($alirans as $aliran)
                @if ($aliran->id_kategori_aliran == 14)
                    <tr>                        <td>{{$aliran->newTarikh}}</td>
                        <!-- <td>{{ date('M d', strtotime($aliran->tarikh_aliran)) }}</td> -->
                        <td>{{ $aliran->keterangan_aliran }}</td>
                        <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>


                        @if ($loop->index == 0)
                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($kos_alat_tulis, 2) }}</td>
                        @else
                            <td></td>
                            <td></td>
                            <td></td>
                        @endif
                    </tr>
                @else
                    @if ($loop->index == 0)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>

                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($kos_alat_tulis, 2) }}</td>

                        </tr>
                    @endif
                @endif
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($kos_alat_tulis, 2) }}</td>

                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($kos_alat_tulis, 2) }}</td>

            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
                <td></td>

                <td></td>
                <td></td>
                <td></td>

            </tr>


            <tr>
                <td>{{ date('M d', strtotime($nextmonth)) }}</td>
                <td>BAKI B/B</td>
                <td>{{ number_format($kos_alat_tulis, 2) }}</td>

                <td></td>
                <td></td>
                <td></td>
            </tr>

        </tbody>
    </table>


    {{-- --------------------------------------------------- --}}
    {{-- bayaran_sewa --}}
    <br>
    <br>

    <table>
        <thead>
            <tr>
                <th>DR</th>
                <th colspan="4" style="width: 200px; text-align:center; font-weight: bold;">BAYARAN SEWA A/C</th>
                <th style="text-align:right">CR</th>

            </tr>

        </thead>
        <tbody>

            <tr>
                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM)</td>

                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM) </td>
            </tr>

            <tr>
                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>

                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>
            </tr>


            @foreach ($alirans as $aliran)
                @if ($aliran->id_kategori_aliran == 15)
                    <tr>                        <td>{{$aliran->newTarikh}}</td>
                        <!-- <td>{{ date('M d', strtotime($aliran->tarikh_aliran)) }}</td> -->
                        <td>{{ $aliran->keterangan_aliran }}</td>
                        <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>


                        @if ($loop->index == 0)
                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($bayaran_sewa, 2) }}</td>
                        @else
                            <td></td>
                            <td></td>
                            <td></td>
                        @endif
                    </tr>
                @else
                    @if ($loop->index == 0)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>

                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($bayaran_sewa, 2) }}</td>

                        </tr>
                    @endif
                @endif
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($bayaran_sewa, 2) }}</td>

                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($bayaran_sewa, 2) }}</td>

            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
                <td></td>

                <td></td>
                <td></td>
                <td></td>

            </tr>


            <tr>
                <td>{{ date('M d', strtotime($nextmonth)) }}</td>
                <td>BAKI B/B</td>
                <td>{{ number_format($bayaran_sewa, 2) }}</td>

                <td></td>
                <td></td>
                <td></td>


            </tr>

        </tbody>
    </table>


    {{-- --------------------------------------------------- --}}
    {{-- upah_gaji_pekerja --}}
    <br>
    <br>

    <table>
        <thead>
            <tr>
                <th>DR</th>
                <th colspan="4" style="width: 200px; text-align:center; font-weight: bold;">UPAH/GAJI PEKERJA A/C</th>
                <th style="text-align:right">CR</th>

            </tr>

        </thead>
        <tbody>

            <tr>
                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM)</td>

                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM) </td>
            </tr>

            <tr>
                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>

                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>
            </tr>


            @foreach ($alirans as $aliran)
                @if ($aliran->id_kategori_aliran == 16)
                    <tr>                        <td>{{$aliran->newTarikh}}</td>
                        <!-- <td>{{ date('M d', strtotime($aliran->tarikh_aliran)) }}</td> -->
                        <td>{{ $aliran->keterangan_aliran }}</td>
                        <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>


                        @if ($loop->index == 0)
                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($upah_gaji_pekerja, 2) }}</td>
                        @else
                            <td></td>
                            <td></td>
                            <td></td>
                        @endif
                    </tr>
                @else
                    @if ($loop->index == 0)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>

                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($upah_gaji_pekerja, 2) }}</td>

                        </tr>
                    @endif
                @endif
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($upah_gaji_pekerja, 2) }}</td>

                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($upah_gaji_pekerja, 2) }}</td>

            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
                <td></td>

                <td></td>
                <td></td>
                <td></td>

            </tr>


            <tr>

                <td>{{ date('M d', strtotime($nextmonth)) }}</td>
                <td>BAKI B/B</td>
                <td>{{ number_format($upah_gaji_pekerja, 2) }}</td>

                <td></td>
                <td></td>
                <td></td>
            </tr>

        </tbody>
    </table>


    {{-- --------------------------------------------------- --}}
    {{-- upah_gaji_sendiri --}}
    <br>
    <br>

    <table>
        <thead>
            <tr>
                <th>DR</th>
                <th colspan="4" style="width: 200px; text-align:center; font-weight: bold;">UPAH/GAJI SENDIRI A/C</th>
                <th style="text-align:right">CR</th>

            </tr>

        </thead>
        <tbody>

            <tr>
                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM)</td>

                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM) </td>
            </tr>

            <tr>
                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>

                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>
            </tr>


            @foreach ($alirans as $aliran)
                @if ($aliran->id_kategori_aliran == 17)
                    <tr>                        <td>{{$aliran->newTarikh}}</td>
                        <!-- <td>{{ date('M d', strtotime($aliran->tarikh_aliran)) }}</td> -->
                        <td>{{ $aliran->keterangan_aliran }}</td>
                        <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>


                        @if ($loop->index == 0)
                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($upah_gaji_sendiri, 2) }}</td>
                        @else
                            <td></td>
                            <td></td>
                            <td></td>
                        @endif
                    </tr>
                @else
                    @if ($loop->index == 0)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>

                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($upah_gaji_sendiri, 2) }}</td>

                        </tr>
                    @endif
                @endif
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($upah_gaji_sendiri, 2) }}</td>

                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($upah_gaji_sendiri, 2) }}</td>

            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
                <td></td>

                <td></td>
                <td></td>
                <td></td>

            </tr>


            <tr>
                <td>{{ date('M d', strtotime($nextmonth)) }}</td>
                <td>BAKI B/B</td>
                <td>{{ number_format($upah_gaji_sendiri, 2) }}</td>

                <td></td>
                <td></td>
                <td></td>
            </tr>

        </tbody>
    </table>


    {{-- --------------------------------------------------- --}}
    {{-- kwsp_socso --}}
    <br>
    <br>

    <table>
        <thead>
            <tr>
                <th>DR</th>
                <th colspan="4" style="width: 200px; text-align:center; font-weight: bold;">KWSP/SOCSO A/C</th>
                <th style="text-align:right">CR</th>

            </tr>

        </thead>
        <tbody>

            <tr>
                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM)</td>

                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM) </td>
            </tr>

            <tr>
                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>

                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>
            </tr>


            @foreach ($alirans as $aliran)
                @if ($aliran->id_kategori_aliran == 18)
                    <tr>                        <td>{{$aliran->newTarikh}}</td>
                        <!-- <td>{{ date('M d', strtotime($aliran->tarikh_aliran)) }}</td> -->
                        <td>{{ $aliran->keterangan_aliran }}</td>
                        <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>


                        @if ($loop->index == 0)
                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($kwsp_socso, 2) }}</td>
                        @else
                            <td></td>
                            <td></td>
                            <td></td>
                        @endif
                    </tr>
                @else
                    @if ($loop->index == 0)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>

                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($kwsp_socso, 2) }}</td>

                        </tr>
                    @endif
                @endif
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($kwsp_socso, 2) }}</td>

                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($kwsp_socso, 2) }}</td>

            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
                <td></td>

                <td></td>
                <td></td>
                <td></td>

            </tr>


            <tr>
                <td>{{ date('M d', strtotime($nextmonth)) }}</td>
                <td>BAKI B/B</td>
                <td>{{ number_format($kwsp_socso, 2) }}</td>

                <td></td>
                <td></td>
                <td></td>


            </tr>

        </tbody>
    </table>



    {{-- --------------------------------------------------- --}}
    {{-- bayaran_bil --}}
    <br>
    <br>

    <table>
        <thead>
            <tr>
                <th>DR</th>
                <th colspan="4" style="width: 200px; text-align:center; font-weight: bold;">BAYARAN BIL (UTILITI) A/C
                </th>
                <th style="text-align:right">CR</th>

            </tr>

        </thead>
        <tbody>

            <tr>
                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM)</td>

                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM) </td>
            </tr>

            <tr>
                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>

                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>
            </tr>


            @foreach ($alirans as $aliran)
                @if ($aliran->id_kategori_aliran == 19)
                    <tr>                        <td>{{$aliran->newTarikh}}</td>
                        <!-- <td>{{ date('M d', strtotime($aliran->tarikh_aliran)) }}</td> -->
                        <td>{{ $aliran->keterangan_aliran }}</td>
                        <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>


                        @if ($loop->index == 0)
                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($bayaran_bil, 2) }}</td>
                        @else
                            <td></td>
                            <td></td>
                            <td></td>
                        @endif
                    </tr>
                @else
                    @if ($loop->index == 0)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>

                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($bayaran_bil, 2) }}</td>

                        </tr>
                    @endif
                @endif
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($bayaran_bil, 2) }}</td>

                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($bayaran_bil, 2) }}</td>

            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
                <td></td>

                <td></td>
                <td></td>
                <td></td>

            </tr>


            <tr>
                <td>{{ date('M d', strtotime($nextmonth)) }}</td>
                <td>BAKI B/B</td>
                <td>{{ number_format($bayaran_bil, 2) }}</td>

                <td></td>
                <td></td>
                <td></td>


            </tr>

        </tbody>
    </table>


    {{-- --------------------------------------------------- --}}
    {{-- petrol_tol_parking --}}
    <br>
    <br>

    <table>
        <thead>
            <tr>
                <th>DR</th>
                <th colspan="4" style="width: 200px; text-align:center; font-weight: bold;">PETROL/TOL/PARKING A/C</th>
                <th style="text-align:right">CR</th>

            </tr>

        </thead>
        <tbody>

            <tr>
                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM)</td>

                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM) </td>
            </tr>

            <tr>
                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>

                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>
            </tr>


            @foreach ($alirans as $aliran)
                @if ($aliran->id_kategori_aliran == 20)
                    <tr>                        <td>{{$aliran->newTarikh}}</td>
                        <!-- <td>{{ date('M d', strtotime($aliran->tarikh_aliran)) }}</td> -->
                        <td>{{ $aliran->keterangan_aliran }}</td>
                        <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>


                        @if ($loop->index == 0)
                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($petrol_tol_parking, 2) }}</td>
                        @else
                            <td></td>
                            <td></td>
                            <td></td>
                        @endif
                    </tr>
                @else
                    @if ($loop->index == 0)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>

                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($petrol_tol_parking, 2) }}</td>

                        </tr>
                    @endif
                @endif
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($petrol_tol_parking, 2) }}</td>

                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($petrol_tol_parking, 2) }}</td>

            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
                <td></td>

                <td></td>
                <td></td>
                <td></td>

            </tr>


            <tr>
                <td>{{ date('M d', strtotime($nextmonth)) }}</td>
                <td>BAKI B/B</td>
                <td>{{ number_format($petrol_tol_parking, 2) }}</td>

                <td></td>
                <td></td>
                <td></td>
            </tr>

        </tbody>
    </table>



    {{-- --------------------------------------------------- --}}
    {{-- penyelenggaraan --}}
    <br>
    <br>

    <table>
        <thead>
            <tr>
                <th>DR</th>
                <th colspan="4" style="width: 200px; text-align:center; font-weight: bold;">PENYELENGGARAAN A/C</th>
                <th style="text-align:right">CR</th>

            </tr>

        </thead>
        <tbody>

            <tr>
                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM)</td>

                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM) </td>
            </tr>

            <tr>
                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>

                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>
            </tr>


            @foreach ($alirans as $aliran)
                @if ($aliran->id_kategori_aliran == 21)
                    <tr>                        <td>{{$aliran->newTarikh}}</td>
                        <!-- <td>{{ date('M d', strtotime($aliran->tarikh_aliran)) }}</td> -->
                        <td>{{ $aliran->keterangan_aliran }}</td>
                        <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>


                        @if ($loop->index == 0)
                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($penyelenggaraan, 2) }}</td>
                        @else
                            <td></td>
                            <td></td>
                            <td></td>
                        @endif
                    </tr>
                @else
                    @if ($loop->index == 0)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>

                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($penyelenggaraan, 2) }}</td>

                        </tr>
                    @endif
                @endif
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($penyelenggaraan, 2) }}</td>

                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($penyelenggaraan, 2) }}</td>

            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
                <td></td>

                <td></td>
                <td></td>
                <td></td>

            </tr>


            <tr>

                <td>{{ date('M d', strtotime($nextmonth)) }}</td>
                <td>BAKI B/B</td>
                <td>{{ number_format($penyelenggaraan, 2) }}</td>

                <td></td>
                <td></td>
                <td></td>
            </tr>

        </tbody>
    </table>


    {{-- --------------------------------------------------- --}}
    {{-- belian_aset --}}
    <br>
    <br>

    <table>
        <thead>
            <tr>
                <th>DR</th>
                <th colspan="4" style="width: 200px; text-align:center; font-weight: bold;">BELIAN ASET A/C</th>
                <th style="text-align:right">CR</th>

            </tr>

        </thead>
        <tbody>

            <tr>
                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM)</td>

                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM) </td>
            </tr>

            <tr>
                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>

                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>
            </tr>


            @foreach ($alirans as $aliran)
                @if ($aliran->id_kategori_aliran == 22)
                    <tr>                        <td>{{$aliran->newTarikh}}</td>
                        <!-- <td>{{ date('M d', strtotime($aliran->tarikh_aliran)) }}</td> -->
                        <td>{{ $aliran->keterangan_aliran }}</td>
                        <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>


                        @if ($loop->index == 0)
                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($belian_aset, 2) }}</td>
                        @else
                            <td></td>
                            <td></td>
                            <td></td>
                        @endif
                    </tr>
                @else
                    @if ($loop->index == 0)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>

                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($belian_aset, 2) }}</td>

                        </tr>
                    @endif
                @endif
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($belian_aset, 2) }}</td>

                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($belian_aset, 2) }}</td>

            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
                <td></td>

                <td></td>
                <td></td>
                <td></td>

            </tr>


            <tr>
                <td>{{ date('M d', strtotime($nextmonth)) }}</td>
                <td>BAKI B/B</td>
                <td>{{ number_format($belian_aset, 2) }}</td>

                <td></td>
                <td></td>
                <td></td>


            </tr>

        </tbody>
    </table>


    {{-- --------------------------------------------------- --}}
    {{-- BAYARAN KOMISEN --}}
    <br>
    <br>

    <table>
        <thead>
            <tr>
                <th>DR</th>
                <th colspan="4" style="width: 200px; text-align:center; font-weight: bold;">BAYARAN KOMISEN A/C</th>
                <th style="text-align:right">CR</th>

            </tr>

        </thead>
        <tbody>

            <tr>
                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM)</td>

                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM) </td>
            </tr>

            <tr>
                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>

                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>
            </tr>


            @foreach ($alirans as $aliran)
                @if ($aliran->id_kategori_aliran == 23)
                    <tr>                        <td>{{$aliran->newTarikh}}</td>
                        <!-- <td>{{ date('M d', strtotime($aliran->tarikh_aliran)) }}</td> -->
                        <td>{{ $aliran->keterangan_aliran }}</td>
                        <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>


                        @if ($loop->index == 0)
                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($bayaran_komisen, 2) }}</td>
                        @else
                            <td></td>
                            <td></td>
                            <td></td>
                        @endif
                    </tr>
                @else
                    @if ($loop->index == 0)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>

                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($bayaran_komisen, 2) }}</td>

                        </tr>
                    @endif
                @endif
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($bayaran_komisen, 2) }}</td>

                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($bayaran_komisen, 2) }}</td>

            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
                <td></td>

                <td></td>
                <td></td>
                <td></td>

            </tr>


            <tr>
                <td>{{ date('M d', strtotime($nextmonth)) }}</td>
                <td>BAKI B/B</td>
                <td>{{ number_format($bayaran_komisen, 2) }}</td>

                <td></td>
                <td></td>
                <td></td>


            </tr>

        </tbody>
    </table>


    {{-- --------------------------------------------------- --}}
    {{-- CUKAI/ZAKAT --}}
    <br>
    <br>

    <table>
        <thead>
            <tr>
                <th>DR</th>
                <th colspan="4" style="width: 200px; text-align:center; font-weight: bold;">CUKAI/ZAKAT A/C</th>
                <th style="text-align:right">CR</th>

            </tr>

        </thead>
        <tbody>

            <tr>
                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM)</td>

                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM) </td>
            </tr>

            <tr>
                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>

                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>
            </tr>


            @foreach ($alirans as $aliran)
                @if ($aliran->id_kategori_aliran == 24)
                    <tr>                        <td>{{$aliran->newTarikh}}</td>
                        <!-- <td>{{ date('M d', strtotime($aliran->tarikh_aliran)) }}</td> -->
                        <td>{{ $aliran->keterangan_aliran }}</td>
                        <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>


                        @if ($loop->index == 0)
                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($cukai_zakat, 2) }}</td>
                        @else
                            <td></td>
                            <td></td>
                            <td></td>
                        @endif
                    </tr>
                @else
                    @if ($loop->index == 0)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>

                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($cukai_zakat, 2) }}</td>

                        </tr>
                    @endif
                @endif
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($cukai_zakat, 2) }}</td>

                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($cukai_zakat, 2) }}</td>

            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
                <td></td>

                <td></td>
                <td></td>
                <td></td>

            </tr>


            <tr>
                <td>{{ date('M d', strtotime($nextmonth)) }}</td>
                <td>BAKI B/B</td>
                <td>{{ number_format($cukai_zakat, 2) }}</td>

                <td></td>
                <td></td>
                <td></td>


            </tr>

        </tbody>
    </table>



    {{-- --------------------------------------------------- --}}
    {{-- bayaran_pinjaman --}}
    <br>
    <br>

    <table>
        <thead>
            <tr>
                <th>DR</th>
                <th colspan="4" style="width: 200px; text-align:center; font-weight: bold;">PEMBAYARAN PINJAMAN A/C</th>
                <th style="text-align:right">CR</th>

            </tr>

        </thead>
        <tbody>

            <tr>
                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM)</td>

                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM) </td>
            </tr>

            <tr>
                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>

                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>
            </tr>


            @foreach ($alirans as $aliran)
                @if ($aliran->id_kategori_aliran == 25)
                    <tr>                        <td>{{$aliran->newTarikh}}</td>
                        <!-- <td>{{ date('M d', strtotime($aliran->tarikh_aliran)) }}</td> -->
                        <td>{{ $aliran->keterangan_aliran }}</td>
                        <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>


                        @if ($loop->index == 0)
                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($bayaran_pinjaman, 2) }}</td>
                        @else
                            <td></td>
                            <td></td>
                            <td></td>
                        @endif
                    </tr>
                @else
                    @if ($loop->index == 0)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>

                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($bayaran_pinjaman, 2) }}</td>

                        </tr>
                    @endif
                @endif
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($bayaran_pinjaman, 2) }}</td>

                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($bayaran_pinjaman, 2) }}</td>

            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
                <td></td>

                <td></td>
                <td></td>
                <td></td>

            </tr>


            <tr>
                <td>{{ date('M d', strtotime($nextmonth)) }}</td>
                <td>BAKI B/B</td>
                <td>{{ number_format($bayaran_pinjaman, 2) }}</td>

                <td></td>
                <td></td>
                <td></td>


            </tr>

        </tbody>
    </table>



    {{-- --------------------------------------------------- --}}
    {{-- BAYARAN LAIN --}}
    <br>
    <br>

    <table>
        <thead>
            <tr>
                <th>DR</th>
                <th colspan="4" style="width: 200px; text-align:center; font-weight: bold;">BAYARAN LAIN A/C</th>
                <th style="text-align:right">CR</th>

            </tr>

        </thead>
        <tbody>

            <tr>
                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM)</td>

                <td>Date</td>
                <td>Butiran</td>
                <td>JUMLAH (RM) </td>
            </tr>

            <tr>
                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>

                <td>{{ $tahun }}</td>
                <td></td>
                <td></td>
            </tr>


            @foreach ($alirans as $aliran)
                @if ($aliran->id_kategori_aliran == 26)
                    <tr>                        <td>{{$aliran->newTarikh}}</td>
                        <!-- <td>{{ date('M d', strtotime($aliran->tarikh_aliran)) }}</td> -->
                        <td>{{ $aliran->keterangan_aliran }}</td>
                        <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>


                        @if ($loop->index == 0)
                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($bayaran_lain, 2) }}</td>
                        @else
                            <td></td>
                            <td></td>
                            <td></td>
                        @endif
                    </tr>
                @else
                    @if ($loop->index == 0)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>

                            <td>{{ date('M t', strtotime($aliran->tarikh_aliran)) }}</td>
                            <td>BAKI H/B</td>
                            <td>{{ number_format($bayaran_lain, 2) }}</td>

                        </tr>
                    @endif
                @endif
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($bayaran_lain, 2) }}</td>

                <td></td>
                <td></td>
                <td style="font-weight: bold">{{ number_format($bayaran_lain, 2) }}</td>

            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
                <td></td>

                <td></td>
                <td></td>
                <td></td>

            </tr>


            <tr>
                <td>{{ date('M d', strtotime($nextmonth)) }}</td>
                <td>BAKI B/B</td>
                <td>{{ number_format($bayaran_lain, 2) }}</td>

                <td></td>
                <td></td>
                <td></td>


            </tr>

        </tbody>
    </table>




</body>

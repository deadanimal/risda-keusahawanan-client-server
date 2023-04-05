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

    <h4> PENYATA UNTUNG RUGI</h4>
    <h4>BULAN
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
    <h4>
        @if ($syarikat != null)
            {{ $syarikat->namasyarikat }}
        @endif
    </h4>

    {{-- <table>
        <thead>
            <tr>
                <th style="width: 300px"></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>

        </thead>
        <tbody>

            <tr>
                <td style="font-weight: bold">HASIL JUALAN / PEROLEHAN (SALES) </td>
                <td style="text-align: center">RM</td>
                <td style="text-align: center">RM</td>
                <td style="text-align: center">RM</td>
            </tr>

            <tr>
                <td>JUALAN/PEROLEHAN</td>
                <td></td>
                <td></td>
                <td style="text-align: end">{{ number_format($jualan_perolehan, 2) }}</td>
            </tr>

            <tr>
                <td>Deposit Jualan</td>
                <td></td>
                <td></td>
                <td style="text-align: end">{{ number_format($deposit_jualan, 2) }}</td>
            </tr>

            <tr>
                <td>Pulangan Jualan</td>
                <td></td>
                <td></td>
                <td style="text-align: end">{{ number_format($pulangan_jualan, 2) }}</td>
            </tr>

            <tr>
                <td style="color: red">Jualan Bersih</td>
                <td></td>
                <td></td>
                <td>
                    @php
                        $jualan_bersih = $jualan_perolehan + $deposit_jualan - $pulangan_jualan;
                    @endphp
                    {{ number_format($jualan_bersih, 2) }}
                </td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td style="font-weight: bold">KOS LANGSUNG / KOS JUALAN (COGS)</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td>Stok Awal</td>
                <td></td>
                <td>{{ number_format($stok_awal, 2) }}</td>
                <td></td>
            </tr>

            <tr>
                <td>Deposit Belian</td>
                <td> {{ number_format($deposit_belian, 2) }} </td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td>Belian</td>
                <td> {{ number_format($belian, 2) }} </td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td style="color: red">Belian Bersih</td>
                <td>
                    <?php
                    $belian_bersih = $deposit_belian + $belian;
                    
                    ?>
                    {{ number_format($belian_bersih, 2) }}

                </td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td>Pulangan Belian</td>
                <td>{{ number_format($pulangan_belian, 2) }}</td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td style="color: red">Kos Belian</td>
                <td></td>
                <td>
                    @php
                        $kos_belian = $belian_bersih - $pulangan_belian;
                    @endphp
                    {{ number_format($kos_belian, 2) }}

                </td>
                <td></td>
            </tr>

            <tr>
                <td style="color: red">Kos Barang Sedia Dijual</td>
                <td></td>
                <td>
                    @php
                        $kos_barang_sedia_dijual = $stok_awal + $kos_belian;
                    @endphp
                    {{ number_format($kos_barang_sedia_dijual, 2) }}

                </td>
                <td></td>
            </tr>

            <tr>
                <td>Stok Akhir</td>
                <td></td>
                <td>{{ $stok_akhir }}</td>
                <td></td>
            </tr>

            <tr>
                <td style="color: red">Kos Jualan</td>
                <td></td>
                <td></td>
                <td>
                    @php
                        $kos_jualan = $kos_barang_sedia_dijual - $stok_akhir;
                    @endphp
                    {{ number_format($kos_jualan, 2) }}
                </td>
            </tr>

            <tr>
                <td style="font-weight: bold">UNTUNG / RUGI KASAR</td>
                <td></td>
                <td></td>
                <td>
                    @php
                        $untung_rugi_kasar = $jualan_bersih - $kos_jualan;
                    @endphp
                    {{ number_format($untung_rugi_kasar, 2) }}
                </td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td style="font-weight: bold">PERBELANJAAN PENTADBIRAN DAN OPERASI (OPEX)</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td>Kos Pengeposan</td>
                <td></td>
                <td>{{ number_format($kos_pengeposan, 2) }}</td>
                <td></td>
            </tr>

            <tr>
                <td>Kos Alat Tulis</td>
                <td></td>
                <td>{{ number_format($kos_alat_tulis, 2) }}</td>
                <td></td>
            </tr>

            <tr>
                <td>Bayaran Sewa</td>
                <td></td>
                <td>{{ number_format($bayaran_sewa, 2) }}</td>
                <td></td>
            </tr>

            <tr>
                <td>Upah/ Gaji Pekerja</td>
                <td></td>
                <td>{{ number_format($upah_gaji_pekerja, 2) }}</td>
                <td></td>
            </tr>

            <tr>
                <td>Upah/ Gaji Sendiri</td>
                <td></td>
                <td>{{ number_format($upah_gaji_sendiri, 2) }}</td>
                <td></td>
            </tr>

            <tr>
                <td>KWSP/ SOCSO</td>
                <td></td>
                <td>{{ number_format($kwsp_socso, 2) }}</td>
                <td></td>
            </tr>

            <tr>
                <td>Bayaran Bil (Utiliti)</td>
                <td></td>
                <td>{{ number_format($bayaran_bil, 2) }}</td>
                <td></td>
            </tr>

            <tr>
                <td>Petrol/ Tol/ Parking</td>
                <td></td>
                <td>{{ number_format($petrol_tol_parking, 2) }}</td>
                <td></td>
            </tr>

            <tr>
                <td>Penyelenggaraan</td>
                <td></td>
                <td>{{ number_format($penyelenggaraan, 2) }}</td>
                <td></td>
            </tr>

            <tr>
                <td>Belian Aset</td>
                <td></td>
                <td>{{ number_format($belian_aset, 2) }}</td>
                <td></td>
            </tr>

            <tr>
                <td>Bayaran Komisen</td>
                <td></td>
                <td>{{ number_format($bayaran_komisen, 2) }}</td>
                <td></td>
            </tr>

            <tr>
                <td>Cukai/ Zakat</td>
                <td></td>
                <td>{{ number_format($cukai_zakat, 2) }}</td>
                <td></td>
            </tr>

            <tr>
                <td>Bayaran Lain</td>
                <td></td>
                <td>{{ number_format($bayaran_lain, 2) }}</td>
                <td></td>
            </tr>

            <tr>
                <td style="color: red">JUMLAH PERBELANJAAN PENTADBIRAN DAN OPERASI</td>
                <td></td>
                <td></td>
                <td>
                    @php
                        $jumlah_perbelanjaan = $kos_pengeposan + $kos_alat_tulis + $bayaran_sewa + $upah_gaji_pekerja + $upah_gaji_sendiri + $kwsp_socso + $bayaran_bil + $petrol_tol_parking + $penyelenggaraan + $belian_aset + $bayaran_komisen + $cukai_zakat + $bayaran_lain;
                    @endphp
                    {{ number_format($jumlah_perbelanjaan, 2) }}
                </td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td>HASIL - HASIL LAIN</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td>Hasil Komisen</td>
                <td></td>
                <td> {{ number_format($hasil_komisen, 2) }}</td>
                <td></td>
            </tr>

            <tr>
                <td>Hasil Dividen</td>
                <td></td>
                <td> {{ number_format($hasil_dividen, 2) }}</td>
                <td></td>
            </tr>

            <tr>
                <td>Hasil Sewaan</td>
                <td></td>
                <td> {{ number_format($hasil_sewaan, 2) }}</td>
                <td></td>
            </tr>

            <tr>
                <td>Hasil Lain</td>
                <td></td>
                <td> {{ number_format($hasil_lain, 2) }}</td>
                <td></td>
            </tr>

            <tr>
                <td style="color: red">JUMLAH HASIL -HASIL LAIN</td>
                <td></td>
                <td></td>
                <td>
                    @php
                        $jumlah_hasil = $hasil_komisen + $hasil_dividen + $hasil_sewaan + $hasil_lain;
                    @endphp

                    {{ number_format($jumlah_hasil, 2) }}
                </td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td style="font-weight: bold">UNTUNG / RUGI BERSIH</td>
                <td></td>
                <td></td>
                <td>
                    @php
                        $untung_rugi_bersih = $jualan_bersih - $kos_jualan - $jumlah_perbelanjaan + $jumlah_hasil;
                    @endphp
                    {{ number_format($untung_rugi_bersih, 2) }}
                </td>
            </tr>

        </tbody>
    </table> --}}

    <table>

        <tbody>

            <tr>
                <td style="font-weight: bold">
                    <span class="cls_002">
                        HASIL JUALAN / PEROLEHAN (SALES)
                    </span>
                </td>
                <td style="text-align: center">
                    <span class="cls_002">RM</span>
                </td>
                <td style="text-align: center">
                    <span class="cls_002">RM</span>
                </td>
                <td style="text-align: center">
                    <span class="cls_002">RM</span>
                </td>
            </tr>

            <tr>
                <td class="cls_001">JUALAN/PEROLEHAN</td>
                <td></td>
                <td></td>
                <td class="cls_001" style="text-align: right;">
                    {{ number_format($jualan_perolehan, 2) }}
                </td>
            </tr>

            <tr>
                <td class="cls_001">Deposit Jualan</td>
                <td></td>
                <td></td>
                <td class="cls_001" style="text-align: right;">{{ number_format($deposit_jualan, 2) }}
                </td>
            </tr>

            <tr>
                <td class="cls_001">Pulangan Jualan</td>
                <td></td>
                <td></td>
                <td class="cls_001" style="text-align: right;">{{ number_format($pulangan_jualan, 2) }}
                </td>
            </tr>

            <tr>
                <td class="cls_001" style="color: red">Jualan Bersih</td>
                <td></td>
                <td></td>
                <td class="cls_001" style="text-align: right;">
                    @php
                        $jualan_bersih = $jualan_perolehan + $deposit_jualan - $pulangan_jualan;
                    @endphp
                    {{ number_format($jualan_bersih, 2) }}
                </td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td class="cls_002" style="font-weight: bold">KOS LANGSUNG / KOS JUALAN (COGS)</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td class="cls_001">Stok Awal</td>
                <td></td>
                <td class="cls_001" style="text-align: right;">{{ number_format($stok_awal, 2) }}</td>
                <td></td>
            </tr>

            <tr>
                <td class="cls_001">Deposit Belian</td>
                <td class="cls_001" style="text-align: right;"> {{ number_format($deposit_belian, 2) }}
                </td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td class="cls_001">Belian</td>
                <td class="cls_001" style="text-align: right;"> {{ number_format($belian, 2) }} </td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td class="cls_001" style="color: red">Belian Bersih</td>
                <td class="cls_001" style="text-align: right;">
                    <?php
                    $belian_bersih = $deposit_belian + $belian;
                    
                    ?>
                    {{ number_format($belian_bersih, 2) }}

                </td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td class="cls_001">Pulangan Belian</td>
                <td class="cls_001" style="text-align: right;">{{ number_format($pulangan_belian, 2) }}
                </td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td class="cls_001" style="color: red">Kos Belian</td>
                <td></td>
                <td class="cls_001" style="text-align: right;">
                    @php
                        $kos_belian = $belian_bersih - $pulangan_belian;
                    @endphp
                    {{ number_format($kos_belian, 2) }}

                </td>
                <td></td>
            </tr>

            <tr>
                <td class="cls_001" style="color: red">Kos Barang Sedia Dijual</td>
                <td></td>
                <td class="cls_001" style="text-align: right;">
                    @php
                        $kos_barang_sedia_dijual = $stok_awal + $kos_belian;
                    @endphp
                    {{ number_format($kos_barang_sedia_dijual, 2) }}

                </td>
                <td></td>
            </tr>

            <tr>
                <td class="cls_001">Stok Akhir</td>
                <td></td>
                <td class="cls_001" style="text-align: right;"> {{ number_format($stok_akhir, 2) }}</td>
                <td></td>
            </tr>

            <tr>
                <td class="cls_001" style="color: red">Kos Jualan</td>
                <td></td>
                <td></td>
                <td class="cls_001" style="text-align: right;">
                    @php
                        $kos_jualan = $kos_barang_sedia_dijual - $stok_akhir;
                    @endphp
                    {{ number_format($kos_jualan, 2) }}
                </td>
            </tr>

            <tr>
                <td class="cls_002" style="font-weight: bold">UNTUNG / RUGI KASAR</td>
                <td></td>
                <td></td>
                <td class="cls_002" style="text-align: right;">
                    @php
                        $untung_rugi_kasar = $jualan_bersih - $kos_jualan;
                    @endphp
                    {{ number_format($untung_rugi_kasar, 2) }}
                </td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td class="cls_002" style="font-weight: bold">PERBELANJAAN PENTADBIRAN DAN OPERASI (OPEX)
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td class="cls_001">Kos Pengeposan</td>
                <td></td>
                <td class="cls_001" style="text-align: right;">{{ number_format($kos_pengeposan, 2) }}
                </td>
                <td></td>
            </tr>

            <tr>
                <td class="cls_001">Kos Alat Tulis</td>
                <td></td>
                <td class="cls_001" style="text-align: right;">{{ number_format($kos_alat_tulis, 2) }}
                </td>
                <td></td>
            </tr>

            <tr>
                <td class="cls_001">Bayaran Sewa</td>
                <td></td>
                <td class="cls_001" style="text-align: right;">{{ number_format($bayaran_sewa, 2) }}
                </td>
                <td></td>
            </tr>

            <tr>
                <td class="cls_001">Upah/ Gaji Pekerja</td>
                <td></td>
                <td class="cls_001" style="text-align: right;">
                    {{ number_format($upah_gaji_pekerja, 2) }}</td>
                <td></td>
            </tr>

            <tr>
                <td class="cls_001">Upah/ Gaji Sendiri</td>
                <td></td>
                <td class="cls_001" style="text-align: right;">
                    {{ number_format($upah_gaji_sendiri, 2) }}</td>
                <td></td>
            </tr>

            <tr>
                <td class="cls_001">KWSP/ SOCSO</td>
                <td></td>
                <td class="cls_001" style="text-align: right;">{{ number_format($kwsp_socso, 2) }}</td>
                <td></td>
            </tr>

            <tr>
                <td class="cls_001">Bayaran Bil (Utiliti)</td>
                <td></td>
                <td class="cls_001" style="text-align: right;">{{ number_format($bayaran_bil, 2) }}</td>
                <td></td>
            </tr>

            <tr>
                <td class="cls_001">Petrol/ Tol/ Parking</td>
                <td></td>
                <td class="cls_001" style="text-align: right;">
                    {{ number_format($petrol_tol_parking, 2) }}</td>
                <td></td>
            </tr>

            <tr>
                <td class="cls_001">Penyelenggaraan</td>
                <td></td>
                <td class="cls_001" style="text-align: right;">{{ number_format($penyelenggaraan, 2) }}
                </td>
                <td></td>
            </tr>

            <tr>
                <td class="cls_001">Belian Aset</td>
                <td></td>
                <td class="cls_001" style="text-align: right;">{{ number_format($belian_aset, 2) }}</td>
                <td></td>
            </tr>

            <tr>
                <td class="cls_001">Bayaran Komisen</td>
                <td></td>
                <td class="cls_001" style="text-align: right;">{{ number_format($bayaran_komisen, 2) }}
                </td>
                <td></td>
            </tr>

            <tr>
                <td class="cls_001">Cukai/ Zakat</td>
                <td></td>
                <td class="cls_001" style="text-align: right;">{{ number_format($cukai_zakat, 2) }}</td>
                <td></td>
            </tr>

            <tr>
                <td class="cls_001">Bayaran Lain</td>
                <td></td>
                <td class="cls_001" style="text-align: right;">{{ number_format($bayaran_lain, 2) }}
                </td>
                <td></td>
            </tr>

            <tr>
                <td class="cls_002" style="color: red">JUMLAH PERBELANJAAN PENTADBIRAN DAN OPERASI</td>
                <td></td>
                <td></td>
                <td class="cls_002" style="text-align: right;">
                    @php
                        $jumlah_perbelanjaan = $kos_pengeposan + $kos_alat_tulis + $bayaran_sewa + $upah_gaji_pekerja + $upah_gaji_sendiri + $kwsp_socso + $bayaran_bil + $petrol_tol_parking + $penyelenggaraan + $belian_aset + $bayaran_komisen + $cukai_zakat + $bayaran_lain;
                    @endphp
                    {{ number_format($jumlah_perbelanjaan, 2) }}
                </td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td class="cls_002">HASIL - HASIL LAIN</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td class="cls_001">Hasil Komisen</td>
                <td></td>
                <td class="cls_001" style="text-align: right;"> {{ number_format($hasil_komisen, 2) }}
                </td>
                <td></td>
            </tr>

            <tr>
                <td class="cls_001">Hasil Dividen</td>
                <td></td>
                <td class="cls_001" style="text-align: right;"> {{ number_format($hasil_dividen, 2) }}
                </td>
                <td></td>
            </tr>

            <tr>
                <td class="cls_001">Hasil Sewaan</td>
                <td></td>
                <td class="cls_001" style="text-align: right;"> {{ number_format($hasil_sewaan, 2) }}
                </td>
                <td></td>
            </tr>

            <tr>
                <td class="cls_001">Hasil Lain</td>
                <td></td>
                <td class="cls_001" style="text-align: right;"> {{ number_format($hasil_lain, 2) }}</td>
                <td></td>
            </tr>

            <tr>
                <td class="cls_002" style="color: red">JUMLAH HASIL -HASIL LAIN</td>
                <td></td>
                <td></td>
                <td class="cls_002" style="text-align: right;">
                    @php
                        $jumlah_hasil = $hasil_komisen + $hasil_dividen + $hasil_sewaan + $hasil_lain;
                    @endphp

                    {{ number_format($jumlah_hasil, 2) }}
                </td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td class="cls_002" style="font-weight: bold">UNTUNG / RUGI BERSIH</td>
                <td></td>
                <td></td>
                <td class="cls_002" style="text-align: right;">
                    @php
                        $untung_rugi_bersih = $jualan_bersih - $kos_jualan - $jumlah_perbelanjaan + $jumlah_hasil;
                    @endphp
                    {{ number_format($untung_rugi_bersih, 2) }}
                </td>
            </tr>

        </tbody>
    </table>


</body>

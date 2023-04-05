<h3> BUKU TUNAI RINGKASAN BULAN {{ $bulan }} TAHUN {{ $tahun }}</h3>

<table>
    <thead>
        <tr>
            <th rowspan="2">TARIKH</th>
            <th rowspan="2" style="width: 200px">BUTIRAN</th>
            <th rowspan="2" style="width: 100px">RUJUKAN</th>
            <th>DEBIT</th>
            <th>KREDIT</th>
            <th>JUMLAH</th>
        </tr>
        <tr>
            <th>RM</th>
            <th>RM</th>
            <th>RM</th>
        </tr>

    </thead>
    <tbody>

        <tr>
            <td></td>
            <td style="font-weight: bold">A) PENDAPATAN AKTIF</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <?php
        // pendapatan aktif
        $totalJualanPerolehan = 0;
        $totalDepositJualan = 0;
        $total_pulangan_belian = 0;
        $total_stok_akihr = 0;
        
        // pendapatan pasif
        $total_hasil_sewaan = 0;
        $total_hasil_dividen = 0;
        $total_hasil_komisen = 0;
        $total_hasil_lain = 0;
        
        // perbelanjaan perniagaan
        $belian = 0;
        $deposit_belian = 0;
        $pulangan_jualan = 0;
        $stok_awal = 0;
        $kos_pegeposan = 0;
        
        $kos_alat_tulis = 0;
        $bayaran_sewa = 0;
        $upah_gaji_pekerja = 0;
        $upah_gaji_sendiri = 0;
        $kwsp_socso = 0;
        
        $bayaran_bil = 0;
        $petrol_tol_parking = 0;
        $penyelenggaraan = 0;
        $belian_aset = 0;
        $bayaran_komisen = 0;
        $cukai_zakat = 0;
        $bayaran_lain = 0;
        
        ?>
        @foreach ($alirans as $aliran)
            @if ($aliran->id_kategori_aliran == 1)

                @php
                    $totalJualanPerolehan += $aliran->jumlah_aliran;
                @endphp
                <tr>
                    <td>{{ $aliran->tarikh_aliran }}</td>
                    <td>JUALAN/PEROLEHAN</td>
                    <td>{{ $aliran->keterangan_aliran }}</td>
                    <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>
                    <td>

                    </td>
                </tr>
            @endif
        @endforeach

        @foreach ($alirans as $aliran)
            @if ($aliran->id_kategori_aliran == 2)

                @php
                    $totalDepositJualan += $aliran->jumlah_aliran;
                @endphp

                <tr>
                    <td>{{ $aliran->tarikh_aliran }}</td>
                    <td>DEPOSIT JUALAN</td>
                    <td>{{ $aliran->keterangan_aliran }}</td>
                    <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>
                    <td></td>
                </tr>
            @endif
        @endforeach

        @foreach ($alirans as $aliran)
            @if ($aliran->id_kategori_aliran == 3)

                @php
                    $total_pulangan_belian += $aliran->jumlah_aliran;
                @endphp
                <tr>
                    <td>{{ $aliran->tarikh_aliran }}</td>
                    <td>PULANGAN BELIAN</td>
                    <td>{{ $aliran->keterangan_aliran }}</td>
                    <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>
                    <td>{{ $totalJualanPerolehan }}</td>
                </tr>


            @endif
        @endforeach

        @foreach ($alirans as $aliran)
            @if ($aliran->id_kategori_aliran == 4)
                @php
                    $total_stok_akihr += $aliran->jumlah_aliran;
                @endphp

                <tr>
                    <td>{{ $aliran->tarikh_aliran }}</td>
                    <td>STOK AKHIR</td>
                    <td>{{ $aliran->keterangan_aliran }}</td>
                    <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>
                    <td></td>
                </tr>
            @endif
        @endforeach


        <tr>
            <td></td>
            <td style="font-weight: bold">B) PENDAPATAN PASIF</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        @foreach ($alirans as $aliran)
            @if ($aliran->id_kategori_aliran == 5)
                @php
                    $total_hasil_sewaan += $aliran->jumlah_aliran;
                @endphp

                <tr>
                    <td>{{ $aliran->tarikh_aliran }}</td>
                    <td>HASIL SEWAAN</td>
                    <td>{{ $aliran->keterangan_aliran }}</td>
                    <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>
                    <td></td>
                </tr>
            @endif
        @endforeach

        @foreach ($alirans as $aliran)
            @if ($aliran->id_kategori_aliran == 6)
                @php
                    $total_hasil_dividen += $aliran->jumlah_aliran;
                @endphp

                <tr>
                    <td>{{ $aliran->tarikh_aliran }}</td>
                    <td>HASIL DIVIDEN</td>
                    <td>{{ $aliran->keterangan_aliran }}</td>
                    <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>
                    <td></td>
                </tr>
            @endif
        @endforeach

        @foreach ($alirans as $aliran)
            @if ($aliran->id_kategori_aliran == 7)
                @php
                    $total_hasil_komisen += $aliran->jumlah_aliran;
                @endphp

                <tr>
                    <td>{{ $aliran->tarikh_aliran }}</td>
                    <td>HASIL KOMISEN</td>
                    <td>{{ $aliran->keterangan_aliran }}</td>
                    <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>
                    <td></td>
                </tr>
            @endif
        @endforeach

        @foreach ($alirans as $aliran)
            @if ($aliran->id_kategori_aliran == 8)
                @php
                    $total_hasil_lain += $aliran->jumlah_aliran;
                @endphp

                <tr>
                    <td>{{ $aliran->tarikh_aliran }}</td>
                    <td>HASIL LAIN</td>
                    <td>{{ $aliran->keterangan_aliran }}</td>
                    <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>
                    <td></td>
                </tr>
            @endif
        @endforeach


        <tr>
            <td></td>
            <td style="font-weight: bold">C) JUMLAH ALIRAN MASUK (RM)</td>
            <td></td>
            <td></td>
            <td></td>
            <td>
                @php
                    $totalAliranMasuk = $totalJualanPerolehan + $totalDepositJualan + $total_pulangan_belian + $total_stok_akihr + $total_hasil_sewaan + $total_hasil_dividen + $total_hasil_komisen + $total_hasil_lain;
                    
                    echo number_format($totalAliranMasuk, 2);
                @endphp
            </td>
        </tr>

        <tr>
            <td></td>
            <td style="font-weight: bold">D) PERBELANJAAN PERNIAGAAN</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        @foreach ($alirans as $aliran)
            @if ($aliran->id_kategori_aliran == 9)
                @php
                    $belian += $aliran->jumlah_aliran;
                @endphp

                <tr>
                    <td>{{ $aliran->tarikh_aliran }}</td>
                    <td>BELIAN</td>
                    <td>{{ $aliran->keterangan_aliran }}</td>
                    <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>
                    <td></td>
                </tr>
            @endif
        @endforeach

        @foreach ($alirans as $aliran)
            @if ($aliran->id_kategori_aliran == 10)
                @php
                    $deposit_belian += $aliran->jumlah_aliran;
                @endphp

                <tr>
                    <td>{{ $aliran->tarikh_aliran }}</td>
                    <td>DEPOSIT BELIAN</td>
                    <td>{{ $aliran->keterangan_aliran }}</td>
                    <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>
                    <td></td>
                </tr>
            @endif
        @endforeach

        @foreach ($alirans as $aliran)
            @if ($aliran->id_kategori_aliran == 11)
                @php
                    $pulangan_jualan += $aliran->jumlah_aliran;
                @endphp

                <tr>
                    <td>{{ $aliran->tarikh_aliran }}</td>
                    <td>PULANGAN JUALAN</td>
                    <td>{{ $aliran->keterangan_aliran }}</td>
                    <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>
                    <td></td>
                </tr>
            @endif
        @endforeach

        @foreach ($alirans as $aliran)
            @if ($aliran->id_kategori_aliran == 12)
                @php
                    $stok_awal += $aliran->jumlah_aliran;
                @endphp

                <tr>
                    <td>{{ $aliran->tarikh_aliran }}</td>
                    <td>STOK AWAL</td>
                    <td>{{ $aliran->keterangan_aliran }}</td>
                    <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>
                    <td></td>
                </tr>
            @endif
        @endforeach

        @foreach ($alirans as $aliran)
            @if ($aliran->id_kategori_aliran == 13)
                @php
                    $kos_pegeposan += $aliran->jumlah_aliran;
                @endphp

                <tr>
                    <td>{{ $aliran->tarikh_aliran }}</td>
                    <td>KOS PENGEPOSAN</td>
                    <td>{{ $aliran->keterangan_aliran }}</td>
                    <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>
                    <td></td>
                </tr>
            @endif
        @endforeach

        @foreach ($alirans as $aliran)
            @if ($aliran->id_kategori_aliran == 14)
                @php
                    $kos_alat_tulis += $aliran->jumlah_aliran;
                @endphp

                <tr>
                    <td>{{ $aliran->tarikh_aliran }}</td>
                    <td>KOS ALAT TULIS</td>
                    <td>{{ $aliran->keterangan_aliran }}</td>
                    <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>
                    <td></td>
                </tr>
            @endif
        @endforeach

        @foreach ($alirans as $aliran)
            @if ($aliran->id_kategori_aliran == 15)
                @php
                    $bayaran_sewa += $aliran->jumlah_aliran;
                @endphp

                <tr>
                    <td>{{ $aliran->tarikh_aliran }}</td>
                    <td>BAYARAN SEWA</td>
                    <td>{{ $aliran->keterangan_aliran }}</td>
                    <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>
                    <td></td>
                </tr>
            @endif
        @endforeach

        @foreach ($alirans as $aliran)
            @if ($aliran->id_kategori_aliran == 16)
                @php
                    $upah_gaji_pekerja += $aliran->jumlah_aliran;
                @endphp

                <tr>
                    <td>{{ $aliran->tarikh_aliran }}</td>
                    <td>UPAH/ GAJI PEKERJA</td>
                    <td>{{ $aliran->keterangan_aliran }}</td>
                    <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>
                    <td></td>
                </tr>
            @endif
        @endforeach


        @foreach ($alirans as $aliran)
            @if ($aliran->id_kategori_aliran == 17)
                @php
                    $upah_gaji_sendiri += $aliran->jumlah_aliran;
                @endphp

                <tr>
                    <td>{{ $aliran->tarikh_aliran }}</td>
                    <td>UPAH/ GAJI SENDIRI</td>
                    <td>{{ $aliran->keterangan_aliran }}</td>
                    <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>
                    <td></td>
                </tr>
            @endif
        @endforeach

        @foreach ($alirans as $aliran)
            @if ($aliran->id_kategori_aliran == 18)
                @php
                    $kwsp_socso += $aliran->jumlah_aliran;
                @endphp

                <tr>
                    <td>{{ $aliran->tarikh_aliran }}</td>
                    <td>KWSP/SOCSO</td>
                    <td>{{ $aliran->keterangan_aliran }}</td>
                    <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>
                    <td></td>
                </tr>
            @endif
        @endforeach

        @foreach ($alirans as $aliran)
            @if ($aliran->id_kategori_aliran == 19)
                @php
                    $bayaran_bil += $aliran->jumlah_aliran;
                @endphp

                <tr>
                    <td>{{ $aliran->tarikh_aliran }}</td>
                    <td>BAYARAN BIL (UTILITI)</td>
                    <td>{{ $aliran->keterangan_aliran }}</td>
                    <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>
                    <td></td>
                </tr>
            @endif
        @endforeach

        @foreach ($alirans as $aliran)
            @if ($aliran->id_kategori_aliran == 20)
                @php
                    $petrol_tol_parking += $aliran->jumlah_aliran;
                @endphp

                <tr>
                    <td>{{ $aliran->tarikh_aliran }}</td>
                    <td>PETROL/TOL/PARKING</td>
                    <td>{{ $aliran->keterangan_aliran }}</td>
                    <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>
                    <td></td>
                </tr>
            @endif
        @endforeach

        @foreach ($alirans as $aliran)
            @if ($aliran->id_kategori_aliran == 21)
                @php
                    $penyelenggaraan += $aliran->jumlah_aliran;
                @endphp

                <tr>
                    <td>{{ $aliran->tarikh_aliran }}</td>
                    <td>PENYELENGGARAAN</td>
                    <td>{{ $aliran->keterangan_aliran }}</td>
                    <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>
                    <td></td>
                </tr>
            @endif
        @endforeach

        @foreach ($alirans as $aliran)
            @if ($aliran->id_kategori_aliran == 22)
                @php
                    $belian_aset += $aliran->jumlah_aliran;
                @endphp

                <tr>
                    <td>{{ $aliran->tarikh_aliran }}</td>
                    <td>BELIAN ASET</td>
                    <td>{{ $aliran->keterangan_aliran }}</td>
                    <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>
                    <td></td>
                </tr>
            @endif
        @endforeach

        @foreach ($alirans as $aliran)
            @if ($aliran->id_kategori_aliran == 23)
                @php
                    $bayaran_komisen += $aliran->jumlah_aliran;
                @endphp

                <tr>
                    <td>{{ $aliran->tarikh_aliran }}</td>
                    <td>BAYARAN KOMISEN</td>
                    <td>{{ $aliran->keterangan_aliran }}</td>
                    <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>
                    <td></td>
                </tr>
            @endif
        @endforeach

        @foreach ($alirans as $aliran)
            @if ($aliran->id_kategori_aliran == 24)
                @php
                    $cukai_zakat += $aliran->jumlah_aliran;
                @endphp

                <tr>
                    <td>{{ $aliran->tarikh_aliran }}</td>
                    <td>CUKAI/ ZAKAT</td>
                    <td>{{ $aliran->keterangan_aliran }}</td>
                    <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>
                    <td></td>
                </tr>
            @endif
        @endforeach

        @foreach ($alirans as $aliran)
            @if ($aliran->id_kategori_aliran == 25)
                @php
                    $bayaran_lain += $aliran->jumlah_aliran;
                @endphp

                <tr>
                    <td>{{ $aliran->tarikh_aliran }}</td>
                    <td>BAYARAN LAIN</td>
                    <td>{{ $aliran->keterangan_aliran }}</td>
                    <td>{{ number_format($aliran->jumlah_aliran, 2) }}</td>
                    <td></td>
                </tr>
            @endif
        @endforeach



        <tr>
            <td></td>
            <td style="font-weight: bold">G)JUMLAH ALIRAN KELUAR (RM)</td>
            <td></td>
            <td></td>
            <td></td>
            <td>
                @php
                    $totalAliranKeluar = $belian + $deposit_belian + $pulangan_jualan + $stok_awal + $kos_pegeposan + $kos_alat_tulis + $bayaran_sewa + $upah_gaji_pekerja + $upah_gaji_sendiri + $kwsp_socso + $bayaran_bil + $petrol_tol_parking + $penyelenggaraan + $belian_aset + $bayaran_komisen + $cukai_zakat + $bayaran_lain;
                    
                    echo number_format($totalAliranKeluar, 2);
                @endphp
            </td>
        </tr>

        <tr>
            <td></td>
            <td style="font-weight: bold">JUMLAH BAKI/SIMPANAN</td>
            <td></td>
            <td></td>
            <td></td>
            <td>
                @php
                    $jumlahBakiSimpanan = $totalAliranMasuk - $totalAliranKeluar;
                    
                    echo number_format($jumlahBakiSimpanan, 2);
                @endphp
            </td>
        </tr>

    </tbody>
</table>

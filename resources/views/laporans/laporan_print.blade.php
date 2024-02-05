<!DOCTYPE html>
<html>

<head>
    <title>Cetak Laporan Keuangan</title>
</head>

<body>

    <h4>LAPORAN TRANSAKSI KEUANGAN</h4>

    <?php
    $dari = $_GET['dari'];
    $sampai = $_GET['sampai'];
    $kat = $_GET['kategori'];
    ?>
    <style type="text/css">
        table {
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid black;
            text-align: center;
        }

        @media print {
            @page {
                size: landscape
            }
        }
    </style>
    <table>
        <thead>
            <tr>
                <th rowspan="2" width="11%">Tanggal</th>
                <th rowspan="2" width="5%">Jenis</th>
                <th rowspan="2">Keterangan</th>
                <th rowspan="2">Kategori</th>
                <th colspan="2">Transaksi</th>
            </tr>
            <tr>
                <th>Pemasukan</th>
                <th>Pengeluaran</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_pemasukan = 0;
                $total_pengeluaran = 0;
            @endphp
            @foreach ($laporan as $t)
                <tr>

                    <td>{{ date('d-m-Y', strtotime($t->tanggal)) }}</td>
                    <td>{{ $t->jenis }}</td>
                    <td>{{ $t->keterangan }}</td>
                    <td>{{ $t->kategori->kategori }}</td>
                    <td>
                        @if ($t->jenis == 'Pemasukan')
                            {{ 'Rp.' . number_format($t->nominal) . ',-' }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if ($t->jenis == 'Pengeluaran')
                            {{ 'Rp.' . number_format($t->nominal) . ',-' }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @php
                    if ($t->jenis == 'Pemasukan') {
                        $total_pemasukan += $t->nominal;
                    } elseif ($t->jenis == 'Pengeluaran') {
                        $total_pengeluaran += $t->nominal;
                    }
                    $saldo = $total_pemasukan - $total_pengeluaran;
                @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4">TOTAL</td>
                <td>{{ 'Rp. ' .
                    number_format($total_pemasukan) .
                    "
                                                                                                                                                ,-" }}
                </td>
                <td>{{ 'Rp. ' . number_format($total_pengeluaran) . ' ,-' }}</td>
            </tr>
            <tr>
                @if ($saldo >= 0)
                    <td class="text-right font-weight-bold" colspan="4">SALDO</td>
                    <td colspan="3" class="text-center bg-primary text-white font-weight-bold">
                        {{ 'Rp. ' . number_format($saldo) . ' ,-' }}</td>
                @else
                    <td class="text-right font-weight-bold" colspan="4">SALDO</td>
                    <td colspan="6" class="text-center bg-primary text-white font-weight-bold">
                        {{ 'Rp,-' }}</td>
                @endif
            </tr>
        </tfoot>
    </table>
    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>

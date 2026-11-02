<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Detail Penilaian</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        .container {
            width: 100%;
        }

        h1 {
            font-size: 20px;
            margin-bottom: 5px;
        }

        h2 {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .info-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .info-table td {
            padding: 4px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        th {
            background-color: #cfe2f3;
        }

        .text-left {
            text-align: left;
        }
    </style>
</head>
<body>

<div class="container">

    {{-- HEADER --}}
    <div style="width:100%; overflow:hidden; margin-bottom:10px;">

        <div style="float:left; width:12%;">
            <img src="{{ public_path('images/logobskp2.png') }}" width="80">
        </div>

        <div style="float:left; width:88%;">
            <div style="font-size:20px; font-weight:bold;">
                PT. Bridgestone Kalimantan Plantation
            </div>
            <div style="font-size:15px; font-weight:bold; margin-top:4px;">
                Detail Penilaian Karyawan
            </div>
        </div>

        <div style="clear:both;"></div>
    </div>

    <hr style="border:1px solid #000; margin:8px 0 12px;">

    <div style="margin-bottom:15px; text-align: justify; line-height:1.6;">
    Dokumen ini memuat detail hasil penilaian kinerja karyawan yang dilaksanakan 
    sesuai dengan periode penilaian PT. Bridgestone Kalimantan Plantation. 
    Penilaian ini dilakukan sebagai bagian dari evaluasi kinerja untuk mengukur 
    pencapaian Key Performance Indicator (KPI) dan aspek kualitatif karyawan, 
    serta sebagai dasar dalam pengambilan keputusan manajemen terkait 
    pengembangan dan peningkatan kinerja karyawan.
</div>

    {{-- IDENTITAS KARYAWAN --}}
    <div style="margin-bottom: 20px; font-size:12px;">

        <div style="margin-bottom:6px;">
            <span style="display:inline-block; width:150px;"><strong>NIK</strong></span>
            <span style="display:inline-block; width:10px;">:</span>
            <span>{{ $employee->nik }}</span>
        </div>

        <div style="margin-bottom:6px;">
            <span style="display:inline-block; width:150px;"><strong>Nama</strong></span>
            <span style="display:inline-block; width:10px;">:</span>
            <span>{{ $employee->name }}</span>
        </div>

        <div style="margin-bottom:6px;">
            <span style="display:inline-block; width:150px;"><strong>Departemen</strong></span>
            <span style="display:inline-block; width:10px;">:</span>
            <span>{{ $employee->dept }}</span>
        </div>

        <div style="margin-bottom:6px;">
            <span style="display:inline-block; width:150px;"><strong>Jabatan</strong></span>
            <span style="display:inline-block; width:10px;">:</span>
            <span>{{ $employee->jabatan }}</span>
        </div>

        <div>
            <span style="display:inline-block; width:150px;"><strong>Mulai Kerja</strong></span>
            <span style="display:inline-block; width:10px;">:</span>
            <span>{{ $employee->mulai_kerja ?? '-' }}</span>
        </div>

    </div>

    {{-- TABEL NILAI --}}
    <table>
        <thead>
            <tr>
                <th rowspan="2">Tahun</th>
                <th rowspan="2">Departemen</th>
                <th rowspan="2">Jabatan</th>
                <th colspan="2">Skor KPI 60%</th>
                <th colspan="2">Skor Qualitatif 40%</th>
                <th rowspan="2">Total</th>
            </tr>
            <tr>
                <th>S. Original</th>
                <th>S. Final</th>
                <th>S. Original</th>
                <th>S. Final</th>
            </tr>
        </thead>
        <tbody>
            @foreach($histories as $row)
                <tr>
                    <td>{{ $row['year'] }}</td>
                    <td>{{ $row['dept'] }}</td>
                    <td>{{ $row['position'] }}</td>

                    <td>-</td>
                    <td>-</td>

                    <td>{{ $row['persen'] }}%</td>
                    <td>{{ $row['hasil_qualitatif'] }}</td>
                    <td>{{ $row['hasil_qualitatif'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Master Criteria Penilaian</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 9px;
            color: #2c3e50;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
        }

        .header h2 {
            margin: 0;
            font-size: 14px;
            letter-spacing: 1px;
        }

        .header p {
            margin: 3px 0 0 0;
            font-size: 9px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        thead th {
            background-color: #2c3e50;
            color: #ffffff;
            font-weight: bold;
            text-align: center;
            padding: 6px 4px;
            border: 1px solid #444;
        }

        td {
            border: 1px solid #999;
            padding: 5px;
            vertical-align: top;
            word-wrap: break-word;
        }

        .section-row td {
            background-color: #ecf0f1;
            font-weight: bold;
            font-size: 10px;
            padding: 6px;
            border: 1px solid #bbb;
        }

        .text-center {
            text-align: center;
        }

        .code-col {
            width: 6%;
            text-align: center;
            font-weight: bold;
        }

        .aspek-col {
            width: 12%;
        }

        .definisi-col {
            width: 18%;
        }

        .scale-col {
            width: 12%;
        }

        tbody tr:nth-child(even):not(.section-row) {
            background-color: #fafafa;
        }

        .footer {
            margin-top: 10px;
            font-size: 8px;
            text-align: right;
            color: #777;
        }
    </style>
</head>

<body>

<div class="header">
    <h2>MASTER CRITERIA PENILAIAN KARYAWAN</h2>
    <p>Dokumen Standar Penilaian Kinerja</p>
</div>

<table>
    <thead>
        <tr>
            <th class="code-col">No</th>
            <th class="aspek-col">Aspek</th>
            <th class="definisi-col">Definisi</th>
            <th class="scale-col">I</th>
            <th class="scale-col">II</th>
            <th class="scale-col">III</th>
            <th class="scale-col">IV</th>
            <th class="scale-col">V</th>
        </tr>
    </thead>

    <tbody>
        @php $currentSection = null; @endphp

        @foreach($criteria as $c)

            @if($currentSection !== $c->section)
                <tr class="section-row">
                    <td colspan="8">
                        {{ strtoupper($c->section) }}
                    </td>
                </tr>
                @php $currentSection = $c->section; @endphp
            @endif

            <tr>
                <td class="code-col">{{ $c->code }}</td>
                <td>{{ $c->name }}</td>
                <td>{{ $c->description }}</td>

                <td>
                    {{ optional($c->scales->where('score',1)->first())->description ?? '-' }}
                </td>
                <td>
                    {{ optional($c->scales->where('score',2)->first())->description ?? '-' }}
                </td>
                <td>
                    {{ optional($c->scales->where('score',3)->first())->description ?? '-' }}
                </td>
                <td>
                    {{ optional($c->scales->where('score',4)->first())->description ?? '-' }}
                </td>
                <td>
                    {{ optional($c->scales->where('score',5)->first())->description ?? '-' }}
                </td>
            </tr>

        @endforeach
    </tbody>
</table>

<div class="footer">
    Generated on {{ date('d M Y') }}
</div>

</body>
</html>
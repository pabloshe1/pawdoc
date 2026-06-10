<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Medis - {{ $report->pet->name }}</title>
    <style>
        body {
            font-family: 'Courier', monospace;
            color: #2d1a0e;
            line-height: 1.6;
            padding: 40px;
            background-color: #fff;
        }
        .border-double {
            border: 3px double #B8860B;
            padding: 32px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #B8860B;
            margin-bottom: 24px;
            padding-bottom: 16px;
        }
        .title {
            font-size: 24px;
            margin: 0;
            color: #B8860B;
            text-transform: uppercase;
            letter-spacing: 4px;
        }
        .subtitle {
            margin: 4px 0;
            font-size: 12px;
            color: #5c4033;
        }
        .doc-id {
            font-size: 11px;
            color: #888;
            margin-top: 8px;
        }
        .info-table {
            width: 100%;
            margin-bottom: 24px;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 6px 8px;
            font-size: 13px;
        }
        .label {
            font-weight: bold;
            color: #B8860B;
            width: 140px;
        }
        .section-box {
            background-color: #fdf8f0;
            border-left: 4px solid #B8860B;
            padding: 14px 16px;
            margin-bottom: 16px;
        }
        .section-box.prescription {
            border-left-color: #5c4033;
        }
        .section-title {
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 8px;
            display: block;
            text-decoration: underline;
            font-size: 12px;
            color: #3d2b1f;
        }
        .section-box p {
            margin: 0;
            font-size: 13px;
        }
        .footer {
            margin-top: 32px;
            text-align: center;
            font-size: 11px;
            color: #888;
            border-top: 1px solid #ccc;
            padding-top: 16px;
        }
        .stamp {
            display: inline-block;
            border: 3px solid #B8860B;
            color: #B8860B;
            padding: 6px 20px;
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-top: 16px;
            transform: rotate(-5deg);
        }
    </style>
</head>
<body>
    <div class="border-double">
        <div class="header">
            <h1 class="title">PAWDOC STATION</h1>
            <p class="subtitle">Arsip Medis Resmi dan Laboratorium Klinik Hewan</p>
            <p class="doc-id">ID Dokumen: REC-{{ str_pad($report->id, 5, '0', STR_PAD_LEFT) }}</p>
        </div>

        <table class="info-table">
            <tr>
                <td class="label">Tanggal:</td>
                <td>{{ $date }}</td>
            </tr>
            <tr>
                <td class="label">Pemilik:</td>
                <td>{{ $report->user->name }}</td>
            </tr>
            <tr>
                <td class="label">Nama Hewan:</td>
                <td>{{ $report->pet->name }}{{ $report->pet->type ? ' ('.$report->pet->type.')' : '' }}</td>
            </tr>
            <tr>
                <td class="label">Status:</td>
                <td>{{ $report->status }}</td>
            </tr>
        </table>

        <div class="section-box">
            <span class="section-title">I. Keluhan yang Dilaporkan</span>
            <p>{{ $report->symptoms }}</p>
        </div>

        <div class="section-box">
            <span class="section-title">II. Diagnosa Dokter</span>
            <p>{{ $report->diagnosis ?? 'Menunggu tinjauan dokter...' }}</p>
        </div>

        <div class="section-box prescription">
            <span class="section-title">III. Obat yang Diresepkan</span>
            <p>{{ $report->medicine ?? 'Belum ada obat yang diresepkan.' }}</p>
        </div>

        <div style="text-align:center;margin-top:24px;">
            <span class="stamp">TERVERIFIKASI</span>
        </div>

        <div class="footer">
            <p>Dokumen ini adalah arsip resmi PawDoc Klinik Hewan.</p>
            <p>Dibuat oleh: Febriana Nugraha | SMKIT As-Syifa Boarding School Subang</p>
        </div>
    </div>
</body>
</html>

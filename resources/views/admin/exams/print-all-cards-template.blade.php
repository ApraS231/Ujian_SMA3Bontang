
<!-- File: resources/views/admin/exams/print-all-cards-template.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kartu Ujian - {{ $exam->subject }}</title>
    <style>
        @page {
            size: A4;
            margin: 1cm;
        }
        body {
            font-family: 'Helvetica', sans-serif;
            font-size: 11px;
        }
        .card-container {
            border: 1px solid #000;
            padding: 15px;
            margin-bottom: 1.2cm; /* Jarak antar kartu */
            height: 80mm; /* Tinggi kartu disesuaikan agar 3 kartu pas di A4 */
            box-sizing: border-box;
            position: relative;
            width: 100%;
            page-break-inside: avoid !important; /* Mencegah kartu terpotong di tengah */
        }
        .card-container:last-child {
            margin-bottom: 0;
        }
        .page-break {
            page-break-after: always;
        }
        .header {
            display: table;
            width: 100%;
            border-bottom: 2px solid #000;
            padding-bottom: 5px;
        }
        .logo {
            display: table-cell;
            width: 60px;
            vertical-align: middle;
        }
        .logo img {
            width: 50px;
            height: auto;
        }
        .header-text {
            display: table-cell;
            text-align: center;
            vertical-align: middle;
        }
        .header-text h1, .header-text h2 {
            margin: 0;
            font-weight: bold;
        }
        .header-text h1 {
            font-size: 14px;
        }
        .header-text h2 {
            font-size: 12px;
        }
        .content {
            margin-top: 10px;
            display: table;
            width: 100%;
        }
        .photo {
            display: table-cell;
            width: 70px;
            vertical-align: top;
        }
        .photo-box {
            width: 60px;
            height: 80px;
            border: 1px solid #ccc;
            text-align: center;
            line-height: 80px;
            color: #999;
        }
        .details {
            display: table-cell;
            vertical-align: top;
            padding-left: 15px;
        }
        .details table {
            width: 100%;
            border-collapse: collapse;
        }
        .details td {
            padding: 3px 0;
            vertical-align: top;
        }
        .details .label {
            width: 100px;
        }
        .footer {
            position: absolute;
            bottom: 15px;
            right: 15px;
            text-align: center;
        }
        .footer p {
            margin: 0;
            padding: 0;
        }
        .footer .name {
            margin-top: 50px;
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    @php 
        $allAttendances = [];
        foreach($exam->examSessions as $session) {
            foreach($session->attendances as $attendance) {
                $allAttendances[] = ['session' => $session, 'attendance' => $attendance];
            }
        }
        $totalCards = count($allAttendances);
    @endphp

    @foreach($allAttendances as $index => $data)
        @php
            $session = $data['session'];
            $attendance = $data['attendance'];
        @endphp
        <div class="card-container">
            <div class="header">
                <div class="logo">
                    <img src="{{ public_path('images/tutwuri.jpg') }}" alt="Logo Kiri">
                </div>
                <div class="header-text">
                    <h1>KARTU PESERTA</h1>
                    <h1>SMAN 3 BONTANG</h1>
                    <h2>TAHUN PELAJARAN 2024/2025</h2>
                </div>
                <div class="logo" style="text-align: right;">
                    <img src="{{ public_path('images/logo-sekolah.png') }}" alt="Logo Kanan">
                </div>
            </div>
            <div class="content">
                <div class="photo">
                    <div class="photo-box">Foto</div>
                </div>
                <div class="details">
                    <table>
                        <tr>
                            <td class="label">No Peserta</td>
                            <td>: {{ 'MRT-' . str_pad($attendance->student->id, 4, '0', STR_PAD_LEFT) }}</td>
                        </tr>
                        <tr>
                            <td class="label">Nama</td>
                            <td>: {{ strtoupper($attendance->student->name) }}</td>
                        </tr>
                        <tr>
                            <td class="label">Kelas / Sesi Ujian</td>
                            <td>: {{ $attendance->student->class }} / {{ $session->session_time }}</td>
                        </tr>
                        <tr>
                            <td class="label">Username</td>
                            <td>: {{ $attendance->student->nis }}</td>
                        </tr>
                        <tr>
                            <td class="label">Password</td>
                            <td>: Merdeka{{ substr($attendance->student->nis, -4) }}</td>
                        </tr>
                        <tr>
                            <td class="label">Ruang</td>
                            <td>: {{ $session->room->name }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="footer">
                <p>Kepala Sekolah</p>
                <p class="name">Harwanti, S.Pd</p>
                <p>NIP. 197103111996012001</p>
            </div>
        </div>

        {{-- Logika untuk pindah halaman setelah setiap 3 kartu, kecuali kartu terakhir --}}
        @if(($index + 1) % 3 == 0 && ($index + 1) < $totalCards)
        @endif
    @endforeach
</body>
</html>

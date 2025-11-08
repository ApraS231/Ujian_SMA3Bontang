<!-- File: resources/views/admin/exams/print-all-reports-template.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Ujian - {{ $exam->subject }}</title>
    <style>
        @page { size: A4; margin: 1.5cm; }
        body { font-family: 'Helvetica', sans-serif; font-size: 12px; }
        .report-container { page-break-inside: avoid; }
        .page-break { page-break-after: always; }
        .report-header { text-align: center; margin-bottom: 20px; }
        .report-header h3 { font-size: 16px; margin: 0; text-decoration: underline; font-weight: bold; }
        .report-header h4 { font-size: 14px; margin: 0; font-weight: normal; }
        .report-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .report-table td { padding: 5px; border: 1px solid #000; }
        .report-table .label { width: 200px; background-color: #f2f2f2; }
        .notes-section { margin-top: 20px; }
        .notes-section ul { padding-left: 20px; }
        .signature-section { margin-top: 50px; width: 100%; }
        .signature { float: right; text-align: center; width: 250px; }
        .signature p { margin: 0; padding: 0; }
        .signature .name { margin-top: 60px; font-weight: bold; text-decoration: underline; }
    </style>
</head>
<body>
    @foreach($exam->examSessions as $session)
        <div class="report-container">
            <div class="report-header">
                <h3>BERITA ACARA PELAKSANAAN UJIAN</h3>
                <h4>TAHUN AJARAN 2024/2025</h4>
            </div>

            <table class="report-table">
                <tr><td class="label">Mata Pelajaran</td><td>{{ $exam->subject }}</td></tr>
                <tr><td class="label">Tanggal Ujian</td><td>{{ $exam->exam_date->format('d F Y') }}</td></tr>
                <tr><td class="label">Ruang Ujian</td><td>{{ $session->room->name }}</td></tr>
                <tr><td class="label">Waktu Sesi</td><td>{{ $session->session_time }}</td></tr>
                <tr><td class="label">Nama Pengawas</td><td>{{ $session->supervisor->name }}</td></tr>
            </table>

            <table class="report-table">
                @php
                    $hadir = $session->attendances->where('status', 'hadir')->count();
                    $tidak_hadir = $session->attendances->where('status', 'tidak hadir')->count();
                    $total_peserta = $session->attendances->count();
                @endphp
                <tr><td class="label">Jumlah Peserta Seharusnya</td><td>{{ $total_peserta }} orang</td></tr>
                <tr><td class="label">Jumlah Peserta Hadir</td><td>{{ $hadir }} orang</td></tr>
                <tr><td class="label">Jumlah Peserta Tidak Hadir</td><td>{{ $tidak_hadir }} orang</td></tr>
            </table>

            <div class="notes-section">
                <strong>Catatan Selama Ujian Berlangsung:</strong>
                @if($session->eventNotes->count() > 0)
                    <ul>
                        @foreach($session->eventNotes as $note)
                            <li>{{ $note->note }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>Tidak ada catatan kejadian selama ujian berlangsung.</p>
                @endif
            </div>

            <div class="signature-section">
                <div class="signature">
                    <p>Bontang, {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
                    <p>Pengawas,</p>
                    <p class="name">{{ $session->supervisor->name }}</p>
                    <p>NIP. ............................</p>
                </div>
            </div>
        </div>

        @if(!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach
</body>
</html>

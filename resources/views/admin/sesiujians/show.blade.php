<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detail Sesi: {{ $sesiUjian->ujian->subject }}
        </h2>
    </x-slot>

    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title">Daftar Peserta di Sesi Ini</h2>
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th>No. Meja</th>
                            <th>Nama Siswa</th>
                            <th>NIS</th>
                            <th>Kelas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sesiUjian->kartuUjians as $kartuUjian)
                        <tr>
                            <td>{{ $kartuUjian->table_number }}</td>
                            <td>{{ $kartuUjian->siswa->name }}</td>
                            <td>{{ $kartuUjian->siswa->nis }}</td>
                            <td>{{ $kartuUjian->siswa->class }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

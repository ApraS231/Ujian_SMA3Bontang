<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Buat Sesi Ujian Baru') }}
        </h2>
    </x-slot>

    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.sesiujians.store') }}">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Ujian</span>
                        </label>
                        <select id="ujian_id" name="ujian_id" class="select select-bordered">
                            @foreach($ujians as $ujian)
                                <option value="{{ $ujian->id }}">{{ $ujian->subject }} ({{ $ujian->exam_date->format('d M Y') }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Kelas yang Akan Dijadwalkan</span>
                        </label>
                        <select id="class" name="class" class="select select-bordered">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($classes as $class)
                                <option value="{{ $class }}">{{ $class }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-control mt-4">
                    <label class="label">
                        <span class="label-text">Ruangan Ujian</span>
                    </label>
                    <select id="ruang_id" name="ruang_id" class="select select-bordered">
                        <option value="">-- Pilih Ruangan --</option>
                        @foreach($ruangs as $ruang)
                            <option value="{{ $ruang->id }}">{{ $ruang->name }} (Kapasitas: {{ $ruang->capacity }} orang)</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-control mt-4">
                    <label class="label">
                        <span class="label-text">Pengawas</span>
                    </label>
                    <select id="supervisor_id" name="supervisor_id" class="select select-bordered">
                        <option value="">-- Pilih Pengawas --</option>
                        @foreach($supervisors as $supervisor)
                            <option value="{{ $supervisor->id }}">{{ $supervisor->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-control mt-4">
                    <label class="label">
                        <span class="label-text">Waktu Sesi</span>
                    </label>
                    <input id="session_times" name="session_times" type="text" class="input input-bordered" value="{{ old('session_times') }}" required>
                    <label class="label">
                        <span class="label-text-alt">Contoh: 08:00 - 10:00. Jika butuh lebih dari 1 sesi, pisahkan dengan koma. Contoh: 08:00 - 10:00, 10:30 - 12:30</span>
                    </label>
                </div>

                <div class="card-actions justify-end mt-6">
                    <button type="submit" class="btn btn-primary">Buat Sesi Otomatis</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

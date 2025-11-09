<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Wizard Kartu Ujian - Langkah 3: Atur Siswa
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="mb-4">
                        <p><strong>Mata Pelajaran:</strong> {{ $exam->subject }}</p>
                        <p><strong>Tanggal:</strong> {{ $exam->exam_date->format('d F Y') }}</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-error mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.kartu-ujian.store-step-3', $exam) }}" method="POST">
                        @csrf
                        <div class="space-y-6">
                            @foreach ($rooms as $room)
                                <div class="card bordered">
                                    <div class="card-body">
                                        <h3 class="card-title">{{ $room->name }} (Kapasitas: {{ $room->capacity }})</h3>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="form-control">
                                                <label class="label">
                                                    <span class="label-text">Pilih Kelas</span>
                                                </label>
                                                <select name="rooms[{{ $room->id }}][class]" class="select select-bordered w-full">
                                                    <option disabled selected>Pilih kelas</option>
                                                    @foreach ($classes as $class)
                                                        <option value="{{ $class }}">{{ $class }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-control">
                                                <label class="label">
                                                    <span class="label-text">Nomor Meja Mulai</span>
                                                </label>
                                                <input type="number" name="rooms[{{ $room->id }}][seat_start]" class="input input-bordered w-full" value="1" min="1" max="{{ $room->capacity }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>


                        <div class="mt-6">
                             <a href="{{ route('admin.kartu-ujian.create-step-2', $exam) }}" class="btn">Kembali</a>
                            <button type="submit" class="btn btn-primary">Selesai & Buat Kartu Ujian</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

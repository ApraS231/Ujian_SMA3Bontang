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

                    <div class="mb-6 pb-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Detail Ujian</h3>
                        <p class="mt-1 text-sm text-gray-600">
                            <strong>Mata Pelajaran:</strong> {{ $exam->subject }} |
                            <strong>Tanggal:</strong> {{ $exam->exam_date->format('d F Y') }}
                        </p>
                    </div>

                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
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
                                <div class="p-4 border border-gray-200 rounded-lg shadow-sm">
                                    <h3 class="text-lg font-medium text-gray-900">{{ $room->name }}</h3>
                                    <p class="text-sm text-gray-500 mb-4">Kapasitas: {{ $room->capacity }}</p>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="class_{{ $room->id }}" class="block text-sm font-medium text-gray-700">Pilih Kelas</label>
                                            <select name="rooms[{{ $room->id }}][class]" id="class_{{ $room->id }}"
                                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                <option disabled selected>Pilih kelas</option>
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class }}">{{ $class }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label for="seat_start_{{ $room->id }}" class="block text-sm font-medium text-gray-700">Nomor Meja Mulai</label>
                                            <input type="number" name="rooms[{{ $room->id }}][seat_start]" id="seat_start_{{ $room->id }}"
                                                   class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                                   value="1" min="1" max="{{ $room->capacity }}">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-8 flex justify-between">
                            <a href="{{ route('admin.kartu-ujian.create-step-2', $exam) }}"
                               class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Kembali
                            </a>
                            <button type="submit"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Selesai & Buat Kartu Ujian
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

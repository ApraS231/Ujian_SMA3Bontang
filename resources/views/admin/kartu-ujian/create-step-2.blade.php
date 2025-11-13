<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Wizard Kartu Ujian - Langkah 2: Pilih Ruangan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="mb-6 pb-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Detail Sesi Ujian</h3>
                        <p class="mt-1 text-sm text-gray-600">
                            <strong>Mata Pelajaran:</strong> {{ $examSession->subject->subject }} <br>
                            <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($examSession->exam_date)->format('d F Y') }} <br>
                            <strong>Waktu:</strong> {{ \Carbon\Carbon::parse($examSession->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($examSession->end_time)->format('H:i') }}
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

                    <form action="{{ route('admin.kartu-ujian.store-step-2', $examSession) }}" method="POST">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pilih satu atau lebih ruangan</label>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                @foreach ($rooms as $room)
                                    <label for="room_{{ $room->id }}"
                                           class="relative flex items-start p-4 border border-gray-300 rounded-md cursor-pointer hover:bg-gray-50 has-[:checked]:bg-indigo-50 has-[:checked]:border-indigo-500">
                                        <div class="flex items-center h-5">
                                            <input type="checkbox" name="room_ids[]" id="room_{{ $room->id }}" value="{{ $room->id }}"
                                                   class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <span class="font-medium text-gray-900">{{ $room->name }}</span>
                                            <p class="text-gray-500">Kapasitas: {{ $room->capacity }}</p>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-6 flex justify-between">
                            <a href="{{ route('admin.kartu-ujian.create-step-1') }}"
                               class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Kembali
                            </a>
                            <button type="submit"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Lanjut ke Langkah 3
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

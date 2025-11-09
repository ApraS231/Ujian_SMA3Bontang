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

                    <form action="{{ route('admin.kartu-ujian.store-step-2', $exam) }}" method="POST">
                        @csrf
                        <div class="form-control w-full mb-4">
                            <label class="label">
                                <span class="label-text">Pilih satu atau lebih ruangan</span>
                            </label>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                @foreach ($rooms as $room)
                                    <label class="label cursor-pointer bordered rounded-lg p-4 justify-start">
                                        <input type="checkbox" name="room_ids[]" value="{{ $room->id }}" class="checkbox checkbox-primary mr-4" />
                                        <span class="label-text">{{ $room->name }} (Kapasitas: {{ $room->capacity }})</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-6">
                            <a href="{{ route('admin.kartu-ujian.create-step-1') }}" class="btn">Kembali</a>
                            <button type="submit" class="btn btn-primary">Lanjut ke Langkah 3</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

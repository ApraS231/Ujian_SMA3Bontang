<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Wizard Kartu Ujian - Langkah 1: Buat Ujian
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if ($errors->any())
                        <div class="alert alert-error mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.kartu-ujian.store-step-1') }}" method="POST">
                        @csrf
                        <div class="form-control w-full mb-4">
                            <label class="label">
                                <span class="label-text">Mata Pelajaran</span>
                            </label>
                            <input type="text" name="subject" placeholder="Contoh: Matematika Wajib" class="input input-bordered w-full" required />
                        </div>

                        <div class="form-control w-full mb-4">
                            <label class="label">
                                <span class="label-text">Tanggal Ujian</span>
                            </label>
                            <input type="date" name="exam_date" class="input input-bordered w-full" required />
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="btn btn-primary">Lanjut ke Langkah 2</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

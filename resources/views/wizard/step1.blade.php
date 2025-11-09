<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-base-content leading-tight">
            {{ __('Wizard Ujian - Langkah 1') }}
        </h2>
    </x-slot>

    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <ul class="steps">
                <li class="step step-primary">Buat Ujian</li>
                <li class="step">Pilih Ruangan</li>
                <li class="step">Atur Siswa</li>
            </ul>

            <h2 class="card-title mt-6">Langkah 1: Buat Sesi Ujian</h2>

            <form action="{{ route('wizard.step1.store') }}" method="POST" class="mt-4 space-y-4">
                @csrf
                <div class="form-control">
                    <label class="label" for="subject">
                        <span class="label-text">Mata Pelajaran</span>
                    </label>
                    <input type="text" name="subject" id="subject" class="input input-bordered w-full" required>
                </div>
                <div class="form-control">
                    <label class="label" for="exam_date">
                        <span class="label-text">Tanggal Ujian</span>
                    </label>
                    <input type="date" name="exam_date" id="exam_date" class="input input-bordered w-full" required>
                </div>
                <div class="card-actions justify-end mt-4">
                    <button type="submit" class="btn btn-primary">Lanjut ke Langkah 2</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

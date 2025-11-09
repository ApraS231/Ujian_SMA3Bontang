@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-center">
            <div class="w-full lg:w-1/2">
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <ul class="steps">
                            <li class="step step-primary">Buat Ujian</li>
                            <li class="step">Pilih Ruangan</li>
                            <li class="step">Atur Siswa</li>
                        </ul>
                        <h2 class="card-title">Wizard Ujian - Langkah 1: Buat Sesi Ujian</h2>
                        <form action="{{ route('wizard.step1.store') }}" method="POST">
                            @csrf
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Mata Pelajaran</span>
                                </label>
                                <input type="text" name="subject" id="subject" class="input input-bordered" required>
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Tanggal Ujian</span>
                                </label>
                                <input type="date" name="exam_date" id="exam_date" class="input input-bordered" required>
                            </div>
                            <div class="card-actions justify-end mt-4">
                                <button type="submit" class="btn btn-primary">Lanjut ke Langkah 2</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

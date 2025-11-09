@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-center">
            <div class="w-full lg:w-1/2">
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <ul class="steps">
                            <li class="step step-primary">Buat Ujian</li>
                            <li class="step step-primary">Pilih Ruangan</li>
                            <li class="step">Atur Siswa</li>
                        </ul>
                        <h2 class="card-title">Wizard Ujian - Langkah 2: Pilih Ruangan</h2>
                        <form action="{{ route('wizard.step2.store', ['ujian' => $ujian]) }}" method="POST">
                            @csrf
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Pilih Ruangan</span>
                                </label>
                                @foreach ($ruangs as $ruang)
                                    <label class="label cursor-pointer">
                                        <span class="label-text">{{ $ruang->name }} (Kapasitas: {{ $ruang->capacity }})</span>
                                        <input type="checkbox" name="ruangs[]" value="{{ $ruang->id }}" class="checkbox checkbox-primary" />
                                    </label>
                                @endforeach
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Pilih Pengawas</span>
                                </label>
                                <select name="supervisor_id" id="supervisor_id" class="select select-bordered" required>
                                    @foreach ($supervisors as $supervisor)
                                        <option value="{{ $supervisor->id }}">{{ $supervisor->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="card-actions justify-end mt-4">
                                <button type="submit" class="btn btn-primary">Lanjut ke Langkah 3</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

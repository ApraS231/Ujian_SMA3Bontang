@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-center">
            <div class="w-full lg:w-2/3">
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <ul class="steps">
                            <li class="step step-primary">Buat Ujian</li>
                            <li class="step step-primary">Pilih Ruangan</li>
                            <li class="step step-primary">Atur Siswa</li>
                        </ul>
                        <h2 class="card-title">Wizard Ujian - Langkah 3: Atur Siswa ke Ruangan</h2>

                        <form action="{{ route('wizard.step3', ['ujian' => $ujian]) }}" method="GET" class="mb-4">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Filter by Class:</span>
                                </label>
                                <select name="class" id="class" class="select select-bordered" onchange="this.form.submit()">
                                    <option value="">All Classes</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class }}" {{ $selectedClass == $class ? 'selected' : '' }}>{{ $class }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>

                        <form action="{{ route('wizard.step3.store', ['ujian' => $ujian]) }}" method="POST">
                            @csrf
                            @foreach ($sesiUjians as $sesiUjian)
                                <div class="divider">{{ $sesiUjian->ruang->name }}</div>
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text">Pilih Siswa</span>
                                    </label>
                                    <select name="assignments[{{ $sesiUjian->id }}][siswas][]" multiple class="select select-bordered h-48">
                                        @foreach ($siswas as $siswa)
                                            <option value="{{ $siswa->id }}">{{ $siswa->name }} ({{ $siswa->class }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text">Nomor Meja</span>
                                    </label>
                                    <input type="text" name="assignments[{{ $sesiUjian->id }}][table_numbers]" class="input input-bordered" placeholder="Contoh: 1,2,3,4,5">
                                </div>
                            @endforeach
                            <div class="card-actions justify-end mt-4">
                                <button type="submit" class="btn btn-primary">Selesai</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

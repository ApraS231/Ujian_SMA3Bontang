<!-- File: resources/views/admin/ujians/partials/form.blade.php -->
<form method="POST" action="{{ isset($ujian) ? route('admin.ujians.update', $ujian) : route('admin.ujians.store') }}">
    @csrf
    @if(isset($ujian))
        @method('PUT')
    @endif

    <!-- Mata Pelajaran -->
    <div class="form-control">
        <label class="label">
            <span class="label-text">Mata Pelajaran</span>
        </label>
        <input type="text" name="subject" id="subject" class="input input-bordered" value="{{ old('subject', $ujian->subject ?? '') }}" required autofocus>
        @error('subject')
            <label class="label">
                <span class="label-text-alt text-error">{{ $message }}</span>
            </label>
        @enderror
    </div>

    <!-- Tanggal Ujian -->
    <div class="form-control mt-4">
        <label class="label">
            <span class="label-text">Tanggal Ujian</span>
        </label>
        <input type="date" name="exam_date" id="exam_date" class="input input-bordered" value="{{ old('exam_date', isset($ujian) ? $ujian->exam_date->format('Y-m-d') : '') }}" required>
        @error('exam_date')
            <label class="label">
                <span class="label-text-alt text-error">{{ $message }}</span>
            </label>
        @enderror
    </div>

    <div class="flex items-center justify-end mt-4">
        <a href="{{ route('admin.ujians.index') }}" class="btn btn-ghost mr-4">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>

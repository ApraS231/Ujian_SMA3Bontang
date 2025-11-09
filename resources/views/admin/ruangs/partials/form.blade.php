<!-- File: resources/views/admin/ruangs/partials/form.blade.php -->
<form method="POST" action="{{ isset($ruang) ? route('admin.ruangs.update', $ruang) : route('admin.ruangs.store') }}">
    @csrf
    @if(isset($ruang))
        @method('PUT')
    @endif

    <!-- Nama Ruangan -->
    <div class="form-control">
        <label class="label">
            <span class="label-text">Nama Ruangan</span>
        </label>
        <input type="text" name="name" id="name" class="input input-bordered" value="{{ old('name', $ruang->name ?? '') }}" required autofocus>
        @error('name')
            <label class="label">
                <span class="label-text-alt text-error">{{ $message }}</span>
            </label>
        @enderror
    </div>

    <!-- Kapasitas -->
    <div class="form-control mt-4">
        <label class="label">
            <span class="label-text">Kapasitas</span>
        </label>
        <input type="number" name="capacity" id="capacity" class="input input-bordered" value="{{ old('capacity', $ruang->capacity ?? '') }}" required>
        @error('capacity')
            <label class="label">
                <span class="label-text-alt text-error">{{ $message }}</span>
            </label>
        @enderror
    </div>

    <div class="flex items-center justify-end mt-4">
        <a href="{{ route('admin.ruangs.index') }}" class="btn btn-ghost mr-4">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>

<!-- File: resources/views/admin/rooms/partials/form.blade.php -->
<form method="POST" action="{{ isset($room) ? route('admin.rooms.update', $room) : route('admin.rooms.store') }}">
    @csrf
    @if(isset($room))
        @method('PUT')
    @endif

    <!-- Nama Ruangan -->
    <div>
        <x-input-label for="name" :value="__('Nama Ruangan')" />
        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $room->name ?? '')" required autofocus />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <!-- Kapasitas -->
    <div class="mt-4">
        <x-input-label for="capacity" :value="__('Kapasitas')" />
        <x-text-input id="capacity" class="block mt-1 w-full" type="number" name="capacity" :value="old('capacity', $room->capacity ?? '')" required />
        <x-input-error :messages="$errors->get('capacity')" class="mt-2" />
    </div>

    <div class="flex items-center justify-end mt-4">
        <a href="{{ route('admin.rooms.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">Batal</a>
        <x-primary-button class="ml-4 bg-green-600 hover:bg-green-700">
            {{ __('Simpan') }}
        </x-primary-button>
    </div>
</form>

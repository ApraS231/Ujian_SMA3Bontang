<!-- File: resources/views/admin/ujians/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Ujian Baru') }}
        </h2>
    </x-slot>

    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            @include('admin.ujians.partials.form')
        </div>
    </div>
</x-app-layout>

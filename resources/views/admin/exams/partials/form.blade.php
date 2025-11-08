<!-- File: resources/views/admin/exams/partials/form.blade.php -->
<form method="POST" action="{{ isset($exam) ? route('admin.exams.update', $exam) : route('admin.exams.store') }}">
    @csrf
    @if(isset($exam))
        @method('PUT')
    @endif

    <!-- Mata Pelajaran -->
    <div>
        <x-input-label for="subject" :value="__('Mata Pelajaran')" />
        <x-text-input id="subject" class="block mt-1 w-full" type="text" name="subject" :value="old('subject', $exam->subject ?? '')" required autofocus />
        <x-input-error :messages="$errors->get('subject')" class="mt-2" />
    </div>

    <!-- Tanggal Ujian -->
    <div class="mt-4">
        <x-input-label for="exam_date" :value="__('Tanggal Ujian')" />
        <x-text-input id="exam_date" class="block mt-1 w-full" type="date" name="exam_date" :value="old('exam_date', isset($exam) ? $exam->exam_date->format('Y-m-d') : '')" required />
        <x-input-error :messages="$errors->get('exam_date')" class="mt-2" />
    </div>

    <div class="flex items-center justify-end mt-4">
        <a href="{{ route('admin.exams.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">Batal</a>
        <x-primary-button class="ml-4 bg-green-600 hover:bg-green-700">
            {{ __('Simpan') }}
        </x-primary-button>
    </div>
</form>

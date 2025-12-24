@extends('layouts.app')

@section('title', 'Tambah Narapidana')
@section('page-title', 'Tambah Narapidana Baru')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Form Tambah Narapidana</h2>
            <p class="text-sm text-gray-600 mt-1">Lengkapi semua data narapidana dengan benar</p>
        </div>

        <form action="{{ route('inmates.store') }}" method="POST">
            @csrf

            {{-- Data Identitas --}}
            <div class="border-b border-gray-200 pb-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Data Identitas</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Register <span class="text-red-500">*</span></label>
                        <input type="text" name="registration_number" value="{{ old('registration_number') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('registration_number') border-red-500 @enderror" required>
                        @error('registration_number')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror" required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir <span class="text-red-500">*</span></label>
                        <input type="text" name="place_of_birth" value="{{ old('place_of_birth') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('place_of_birth') border-red-500 @enderror" required>
                        @error('place_of_birth')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir <span class="text-red-500">*</span></label>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('date_of_birth') border-red-500 @enderror" required>
                        @error('date_of_birth')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                        <select name="gender" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('gender') border-red-500 @enderror" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('gender')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Agama <span class="text-red-500">*</span></label>
                        <select name="religion" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('religion') border-red-500 @enderror" required>
                            <option value="">Pilih Agama</option>
                            <option value="Islam" {{ old('religion') == 'Islam' ? 'selected' : '' }}>Islam</option>
                            <option value="Kristen" {{ old('religion') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                            <option value="Katolik" {{ old('religion') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                            <option value="Hindu" {{ old('religion') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="Buddha" {{ old('religion') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                            <option value="Konghucu" {{ old('religion') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                        </select>
                        @error('religion')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Data Pendidikan & Pekerjaan --}}
            <div class="border-b border-gray-200 pb-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Pendidikan & Pekerjaan</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pendidikan Terakhir</label>
                        <select name="education_level" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="">Pilih Pendidikan</option>
                            <option value="Tidak Sekolah" {{ old('education_level') == 'Tidak Sekolah' ? 'selected' : '' }}>Tidak Sekolah</option>
                            <option value="SD/sederajat" {{ old('education_level') == 'SD/sederajat' ? 'selected' : '' }}>SD/sederajat</option>
                            <option value="SMP/sederajat" {{ old('education_level') == 'SMP/sederajat' ? 'selected' : '' }}>SMP/sederajat</option>
                            <option value="SMA/sederajat" {{ old('education_level') == 'SMA/sederajat' ? 'selected' : '' }}>SMA/sederajat</option>
                            <option value="Diploma" {{ old('education_level') == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                            <option value="Sarjana" {{ old('education_level') == 'Sarjana' ? 'selected' : '' }}>Sarjana</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan Terakhir</label>
                        <input type="text" name="last_job" value="{{ old('last_job') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Contoh: Petani, Buruh, Wiraswasta">
                    </div>
                </div>
            </div>

            {{-- Data Hukum --}}
            <div class="border-b border-gray-200 pb-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Data Hukum</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tindak Pidana <span class="text-red-500">*</span></label>
                        <input type="text" name="crime_type" value="{{ old('crime_type') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('crime_type') border-red-500 @enderror" required>
                        @error('crime_type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Masuk <span class="text-red-500">*</span></label>
                        <input type="date" name="entry_date" value="{{ old('entry_date') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('entry_date') border-red-500 @enderror" required>
                        @error('entry_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Lama Pidana (Bulan) <span class="text-red-500">*</span></label>
                        <input type="number" name="sentence_length_months" value="{{ old('sentence_length_months') }}" min="1" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('sentence_length_months') border-red-500 @enderror" required>
                        @error('sentence_length_months')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Sisa Pidana (Bulan) <span class="text-red-500">*</span></label>
                        <input type="number" name="remaining_sentence_months" value="{{ old('remaining_sentence_months') }}" min="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('remaining_sentence_months') border-red-500 @enderror" required>
                        @error('remaining_sentence_months')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Residivisme</label>
                        <input type="number" name="recidivism_count" value="{{ old('recidivism_count', 0) }}" min="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <p class="mt-1 text-xs text-gray-500">Jumlah pengulangan tindak pidana</p>
                    </div>
                </div>
            </div>

            {{-- Data Tambahan --}}
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Data Tambahan</h3>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pelatihan yang Diikuti</label>
                        <input type="text" name="training_attended" value="{{ old('training_attended') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Contoh: Pelatihan Las, Rehabilitasi Narkoba">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Program Kerja</label>
                        <input type="text" name="work_program" value="{{ old('work_program') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Contoh: Tamping kebersihan, Bengkel las">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Kesehatan</label>
                        <textarea name="health_notes" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Riwayat penyakit atau kondisi kesehatan khusus">{{ old('health_notes') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Buttons --}}
            <div class="flex items-center justify-end gap-4">
                <a href="{{ route('inmates.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

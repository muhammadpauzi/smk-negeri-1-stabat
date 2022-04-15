@extends('layouts.app')

@section('content')
<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center mb-3">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Teacher
                </div>
                <h2 class="page-title">
                    Create New Teacher
                </h2>
            </div>
        </div>

        <form action="{{ route('teachers.store') }}" method="post">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-2">
                        <div class="card-header">
                            <h4 class="card-title">Form Create Teacher</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Name of teacher <span class="text-danger">*</span></label>
                                        <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}">
                                        @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="address">Address <span class="text-danger">*</span></label>
                                        <textarea id="address" class="form-control" name="address" rows="6" placeholder="Address of teacher..">{{ old('address') }}</textarea>
                                        @error('address')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-2">
                        <div class="card-header">
                            <h4 class="card-title">Unique Number</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="nuptk">NUPTK <span class="text-danger">*</span></label>
                                        <input type="text" maxlength="16" onkeypress="return /[0-9]/i.test(event.key)" id="nuptk" class="form-control" name="nuptk" value="{{ old('nuptk') }}">
                                        @error('nuptk')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="nip">NIP <span class="text-danger">*</span></label>
                                        <input type="text" maxlength="18" onkeypress="return /[0-9]/i.test(event.key)" id="nip" class="form-control" name="nip" value="{{ old('nip') }}">
                                        @error('nip')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-2">
                        <div class="card-header">
                            <h4 class="card-title">Teacher Status</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="jenis_ptk">Jenis PTK <span class="text-danger">*</span></label>
                                <input type="text" id="jenis_ptk" list="datalistJenisPTK" class="form-control" name="jenis_ptk" value="{{ old('jenis_ptk') }}">
                                <datalist id="datalistJenisPTK">
                                    @foreach($jenis_ptks as $jenis_ptk)
                                    <option value="{{ $jenis_ptk['jenis_ptk'] }}" />
                                    @endforeach
                                </datalist>
                                @error('jenis_ptk')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="tugas_tambahan">Tugas Tambahan <span class="text-danger">*</span></label>
                                <input type="text" id="tugas_tambahan" class="form-control" name="tugas_tambahan" value="{{ old('tugas_tambahan') }}">
                                @error('tugas_tambahan')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="golongan">Golongan <span class="text-danger">*</span></label>
                                <input type="text" id="golongan" list="datalistGolongan" class="form-control" name="golongan" value="{{ old('golongan') }}">
                                <datalist id="datalistGolongan">
                                    @foreach($golongans as $golongan)
                                    <option value="{{ $golongan['golongan'] }}" />
                                    @endforeach
                                </datalist>
                                @error('golongan')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer flex justify-content-end align-items-center">
                            <div>
                                <a href="{{ route('teachers.index') }}" class="btn btn-light">Cancel</a>
                                <button type="submit" class="btn btn-primary">Create Teacher</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center mb-3">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Student
                </div>
                <h2 class="page-title">
                    Create New Student
                </h2>
            </div>
        </div>

        <form action="{{ route('students.store') }}" method="post">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-2">
                        <div class="card-header">
                            <h4 class="card-title">Form Create Student</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Name of student <span class="text-danger">*</span></label>
                                        <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}">
                                        @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="address">Address <span class="text-danger">*</span></label>
                                        <textarea id="address" class="form-control" name="address" rows="6" placeholder="Address of student..">{{ old('address') }}</textarea>
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
                                        <label class="form-label" for="nisn">NISN <span class="text-danger">*</span></label>
                                        <input type="text" maxlength="10" onkeypress="return /[0-9]/i.test(event.key)" id="nisn" class="form-control" name="nisn" value="{{ old('nisn') }}">
                                        @error('nisn')
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
                            <h4 class="card-title">Student Data</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="place_of_birth">Place of Brith <span class="text-danger">*</span></label>
                                <input type="text" id="place_of_birth" class="form-control" name="place_of_birth" value="{{ old('place_of_birth') }}">
                                @error('place_of_birth')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="date_of_birth">Date of Birth <span class="text-danger">*</span></label>
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <rect x="4" y="5" width="16" height="16" rx="2" />
                                            <line x1="16" y1="3" x2="16" y2="7" />
                                            <line x1="8" y1="3" x2="8" y2="7" />
                                            <line x1="4" y1="11" x2="20" y2="11" />
                                            <line x1="11" y1="15" x2="12" y2="15" />
                                            <line x1="12" y1="15" x2="12" y2="18" />
                                        </svg>
                                    </span>
                                    <input type="date" class="form-control" id="date_of_birth" value="{{ old('date_of_birth') }}" placeholder="Select a date" name="date_of_birth" />
                                </div>
                                @error('date_of_birth')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card mb-2">
                        <div class="card-header">
                            <h4 class="card-title">Student Status</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="gender">Gender <span class="text-danger">*</span></label>
                                <select class="form-select" name="gender" id="gender">
                                    <option value="pria">Pria</option>
                                    <option value="wanita">Wanita</option>
                                </select>
                                @error('gender')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="religion">Religion <span class="text-danger">*</span></label>
                                <input type="text" id="religion" list="datalistReligion" class="form-control" name="religion" value="{{ old('religion') }}">
                                <datalist id="datalistReligion">
                                    @foreach($religions as $religion)
                                    <option value="{{ $religion['religion'] }}" />
                                    @endforeach
                                </datalist>
                                @error('religion')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="rombongan_belajar">Rombongan Belajar <span class="text-danger">*</span></label>
                                <input type="text" id="rombongan_belajar" list="datalistRombonganBelajar" class="form-control" name="rombongan_belajar" value="{{ old('rombongan_belajar') }}">
                                <datalist id="datalistRombonganBelajar">
                                    @foreach($rombongan_belajars as $rombongan_belajar)
                                    <option value="{{ $rombongan_belajar['rombongan_belajar'] }}" />
                                    @endforeach
                                </datalist>
                                @error('rombongan_belajar')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer flex justify-content-end align-items-center">
                            <div>
                                <a href="{{ route('students.index') }}" class="btn btn-light">Cancel</a>
                                <button type="submit" class="btn btn-primary">Create Student</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
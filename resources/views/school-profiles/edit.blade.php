@extends('layouts.app')

@section('content')
<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center mb-3">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    School Profile
                </div>
                <h2 class="page-title">
                    Edit School Profile
                </h2>
            </div>
        </div>

        <form action="{{ route('dashboard.school-profile.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-2">
                        <div class="card-header">
                            <h4 class="card-title">Form Edit School Profile</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Name of school <span class="text-danger">*</span></label>
                                        <input type="text" id="name" class="form-control" name="name" autocomplete="school-name" value="{{ old('name', $profile->name) }}">
                                        @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="address">Address <span class="text-danger">*</span></label>
                                        <textarea id="address" class="form-control" name="address" rows="6" placeholder="Address of school..">{{ old('address', $profile->address) }}</textarea>
                                        @error('address')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                                        <input type="text" id="email" class="form-control" name="email" autocomplete="school-email" value="{{ old('email', $profile->email) }}">
                                        @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-2">
                        <div class="card-header">
                            <h4 class="card-title">Profil Kepala Sekolah</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="kepala-sekolah">Name of Kepala Sekolah <span class="text-danger">*</span></label>
                                        <input type="text" id="kepala-sekolah" class="form-control" name="kepala_sekolah" autocomplete="school-kepala_sekolah" value="{{ old('kepala_sekolah', $profile->kepala_sekolah) }}">
                                        @error('kepala_sekolah')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="kata-sambutan">Kata Sambutan <span class="text-danger">*</span></label>
                                        <textarea id="kata-sambutan" class="form-control" name="kata_sambutan" rows="6" placeholder="Address of school..">{{ old('kata_sambutan', $profile->getKataSambutanWithNewLine()) }}</textarea>
                                        @error('kata_sambutan')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <small class="text-muted block">Separate it with the character "\n" if you want to create a new paragraph. Example: ('...Allah Yang Maha Esa. \n Karena Atas ...')</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-2">
                        <div class="card-header">
                            <h4 class="card-title">Phone & Postal Number</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="phone-number">Phone Number <span class="text-danger">*</span></label>
                                        <input type="text" id="phone-number" class="form-control" name="phone_number" autocomplete="school-phone-number" value="{{ old('phone_number', $profile->phone_number) }}">
                                        @error('phone_number')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="postal-number">Phone Number <span class="text-danger">*</span></label>
                                        <input type="text" id="postal-number" class="form-control" name="postal_number" autocomplete="school-postal-number" value="{{ old('postal_number', $profile->postal_number) }}">
                                        @error('postal_number')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-2">
                        <div class="card-header">
                            <h4 class="card-title">Upload School Profile Image</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <div class="form-label">Kepala Sekolah Image</div>

                                        <input type="hidden" name="old-kepala-sekolah-image" value="{{ $profile->kepala_sekolah_image }}">
                                        @if($profile->kepala_sekolah_image)
                                        <img class="w-100 block rounded overflow-hidden mb-2" id="img-preview" src="{{ asset('storage/' . $profile->kepala_sekolah_image) }}" alt="">
                                        @endif

                                        <input type="file" class="form-control mb-2" name="kepala_sekolah_image" />
                                        @error('kepala_sekolah_image')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                        <small class="text-muted block">Choose file if you want to replace the previous image.</small>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-label">Logo</div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <input type="hidden" name="old-logo" value="{{ $profile->logo }}">
                                                @if($profile->logo)
                                                <img class="w-100 block rounded overflow-hidden mb-2" id="img-preview" src="{{ asset('storage/' . $profile->logo) }}" alt="">
                                                @endif
                                            </div>
                                            <div class="col-md-9">
                                                <input type="file" class="form-control mb-2" name="logo" />
                                                @error('logo')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                                <small class="text-muted block">Choose file if you want to replace the previous image.</small>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer flex justify-content-end align-items-center">
                            <div>
                                <a href="{{ route('dashboard.school-profile.index') }}" class="btn btn-light">Cancel</a>
                                <button type="submit" class="btn btn-primary">Update School Profile</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
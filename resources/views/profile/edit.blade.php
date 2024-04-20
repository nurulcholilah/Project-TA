@extends("layouts.apps")
@section("wrapper")
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">User Profile</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href=""><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    @role('admin')
                                    <h6><b>Edit Password</b></h6>
                                    @endrole
                                </div>
                            </div>
                            <form method="post" action="{{ route('password.update') }}" name="myFormP">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <!-- Your profile image and details here -->
                                    <div class="d-flex flex-column align-items-center text-center">
                                        <img src="{{ url('assets/images/avatars/avatar-2.png')}}" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                                        <div class="mt-3">
                                            <h4>{{ Auth::user()->name }}</h4>
                                        </div>
                                    </div>
                                    <hr class="my-4" />
                                    @role('admin')
                                    <!-- Form fields for password update -->
                                    <div class="form-group">
                                        <label class="form-label">Password Saat Ini</label>
                                        <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                            <!-- Input field for current password -->
                                            <input class="input100 form-control" value="" name="current_password" type="password" placeholder="Password Saat Ini">
                                        </div>
                                    </div>
                                    @endrole
                                    @role('admin')
                                    <div class="form-group">
                                        <label class="form-label">Password Baru</label>
                                        <div class="wrap-input100 validate-input input-group" id="Password-toggle1">
                                            <!-- Input field for new password -->
                                            <input class="input100 form-control" value="" name="password" type="password" placeholder="Password Baru">
                                        </div>
                                    </div>
                                    @endrole
                                    @role('admin')
                                    <div class="form-group">
                                        <label class="form-label">Konfirmasi Password</label>
                                        <div class="wrap-input100 validate-input input-group" id="Password-toggle2">
                                            <!-- Input field for password confirmation -->
                                            <input class="input100 form-control" value="" type="password" name="password_confirmation" placeholder="Konfirmasi Password">
                                        </div>
                                    </div>
                                    @endrole
                                </div>
                                <div class="card-footer text-end">
                                    <!-- Submit button -->
                                    @role('admin')
                                    <button type="submit" class="btn btn-primary px-3">Perbarui</button>
                                    <!-- Display status message -->
                                    @if (session('status') === 'password-updated')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600"></p>
                                    @endif
                                    @endrole
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header">
                                    <div class="card-title"><h6><b>Profil</b></h6></div>
                                </div>
                                <form action="{{ route('profile.update', $user->id) }}" method="POST" name="myFormUpdate" enctype="multipart/form-data" onsubmit="return validateUpdate()">
                                    @csrf
                                    @method('PATCH')
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Nama</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" id="name" placeholder="Nama Lengkap">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Email</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" id="email" placeholder="Email">

                                                @error('email')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                                <div>
                                                    <p class="mt-2 text-sm text-gray-800">Your email address is unverified.
                                                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                            Click here to re-send the verification email.
                                                        </button>
                                                    </p>
                                                    @if (session('status') === 'verification-link-sent')
                                                    <p class="mt-2 font-medium text-sm text-green-600">
                                                        A new verification link has been sent to your email address.
                                                    </p>
                                                    @endif
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        @role('admin')
                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9 text-secondary">
                                                <button type="submit" class="btn btn-primary px-3">Simpan Perubahan</button>
                                            </div>
                                        </div>
                                        @endrole
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include("partials.style")
    <title>ADMIFIN</title>
</head>

<body>
    <div class="wrapper">
        <div class="authentication-header"></div>
        <div class="authentication-forgot d-flex align-items-center justify-content-center">
            <div class="card forgot-box">
                <div class="card-body">
                    <div class="p-4 rounded">
                        <div class="text-center">
                            <img src="assets/images/icons/lock.png" width="120" alt="" />
                        </div>
                        <h4 class="mt-5 font-weight-bold">Forgot Password?</h4>
                        <p class="text-muted">Enter your registered email ID to reset the password</p>
                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="my-4">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="form-control form-control-lg" type="email" name="email" :value="old('email')" required autofocus />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">Send</button>
                                <a href="{{ route('login') }}" class="btn btn-white btn-lg"><i class='bx bx-arrow-back me-1'></i>Back to Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@include("partials.script")

</html>
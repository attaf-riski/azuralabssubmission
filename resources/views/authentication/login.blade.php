@extends('authenticationtemplate')
@section('body')
    <section class="sign-in">
        <div class="container">
            <div class="signin-header mt-5">
                <h1 class="form-title text-center">Ataf's Book Management</h1>
            </div>
            <div class="signin-content mb-5 p-0" >

                <div class="signin-image">
                    <figure><img src="{{ asset('images/signin-image.jpg') }}" alt="sing up image"></figure>
                </div>

                <div class="signin-form">
                    <h2 class="form-title">Sign in</h2>
                    <form action="{{ route('login-proses') }}" method="post">

                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session()->has('failed'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('failed') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @csrf
                        <div class="form-group">
                            <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="email" id="your_name" placeholder="example@mail.com"
                                autocomplete="off" required value="{{ old('email') }}" />

                        </div>
                        <div class="form-group">
                            <label for="password"><i class="zmdi zmdi-lock mb-5"></i></label>
                            <input type="password" name="password" id="password" placeholder="Password" />
                            <span class="form-label-description">
                                <a href="{{ route('forgot-password') }}">I forgot password</a>
                            </span>
                        </div>

                        <div class="form-group form-button">
                            <input type="submit" name="signin" id="signin" class="form-submit" value="Log in" />
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </form>

                    <div class="text-secondary mt-3">
                        Don't have account yet? <a href="{{ route('register') }}" tabindex="-1">Sign up</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

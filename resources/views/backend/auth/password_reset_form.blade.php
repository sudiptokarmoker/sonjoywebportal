@extends('backend.layouts.master_default')
@section('content')
<!-- login area start -->
<section class="login-page">
    <div class="container">
        <div class="row">
            <div class="login">
                <div class="form text-center p20 bg-white sign-in bg-shadow">
                    <div class="logo">
                        <img src="{{ asset('backend/assets_v2/images/logo.png') }}" class="login-logo img-fluid">
                    </div>
                    <h3>Type Your Email Address</h3>
                    <form method="POST" action="{{ route('admin.password.forget.submit') }}" class="p20">
                        @csrf
                        @include('backend.layouts.partials.messages')
                        <div class="form">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="floatingInput"
                                        placeholder="name@example.com" name="email">
                                    <label for="floatingInput">Email address</label>
                                </div>
                                <div class="mt10">
                                    <button
                                        class="btn w-100 color-white button-sm bg-dark-blue waves-effect waves-light" type="submit">Submit</button>
                                </div>
                            </div>
                    </form>
                </div>
                <!--    sign in-->
            </div>
        </div>
        <!--contact us -->
    </div>
</section>
<style>
    .login-page .login {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        min-height: 93vh;
        width: 100%;
    }

    .login-page .login img.login-logo {
        text-align: center;
        margin: 23px auto;
        margin-top: 0px
    }

    .login-page .login .form {
        margin: auto;
        width: 450px;
        max-width: 100%;
        background: #fff;
        border-radius: 3px;
    }

</style>

<!-- jQuery  -->
<script src="{{ asset('backend/assets_v2/js/jquery.min.js') }}"></script>
<script src="{{ asset('backend/assets_v2/js/bootstrap.min.js') }}"></script>
@endsection
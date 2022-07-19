@extends('backend.layouts.master_default')
@section('content')
    <!-- login area start -->
    <section class="login-page">
        <div class="container">
            <div class="row">
                <div class="login">
                    <div class="form text-center p20 bg-white sign-in bg-shadow">
                        <div class="logo">
                            <img src="{{ asset('backend/assets_v2/images/logo.png') }}" class="login-logo img-fluid"/>
                        </div>
                        <h3>Type new password information</h3>
                        <form method="POST" action="{{ route('admin.new.password.process') }}" class="p20">
                            @csrf
                            @include('backend.layouts.partials.messages')
                            <input type="hidden" name="token" value="{{ $token }}"/>
                            <input type="hidden" name="email" value="{{ $email }}"/>
                            <div class="form">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="password"
                                        placeholder="New password" name="password">
                                    <label for="password">New Password</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="password_confirmation"
                                        placeholder="New confirm password" name="password_confirmation">
                                    <label for="password_confirmation">Confirm new password</label>
                                </div>
                                <div class="mt10">
                                    <button
                                        class="btn w-100 color-white button-sm bg-dark-blue waves-effect waves-light" type="submit">Save</button>
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
    <!-- jQuery  -->
    <script src="{{ asset('backend/assets_v2/js/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/assets_v2/js/bootstrap.min.js') }}"></script>
@endsection

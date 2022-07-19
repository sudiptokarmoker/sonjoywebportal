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
                    @include('backend.layouts.partials.messages')
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
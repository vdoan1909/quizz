@extends('client.layout.master')

@section('title')
    Đăng ký
@endsection

@section('banner')
    <div class="section page-banner">

        <img class="shape-1 animation-round" src="{{ asset('theme/client/assets/images/shape/shape-8.png') }}" alt="Shape">

        <img class="shape-2" src="{{ asset('theme/client/assets/images/shape/shape-23.png') }}" alt="Shape">

        <div class="container">
            <div class="page-banner-content">
                <h2 class="title"><span>Đăng ký</span></h2>
            </div>
        </div>
        <div class="shape-icon-box">

            <img class="icon-shape-1 animation-left" src="{{ asset('theme/client/assets/images/shape/shape-5.png') }}"
                alt="Shape">

            <div class="box-content">
                <div class="box-wrapper">
                    <i class="flaticon-badge"></i>
                </div>
            </div>

            <img class="icon-shape-2" src="{{ asset('theme/client/assets/images/shape/shape-6.png') }}" alt="Shape">

        </div>

        <img class="shape-3" src="{{ asset('theme/client/assets/images/shape/shape-24.png') }}" alt="Shape">

        <img class="shape-author" src="{{ asset('theme/client/assets/images/author/author-11.jpg') }}" alt="Shape">

    </div>
@endsection

@section('content')
    <div class="section section-padding">
        <div class="container">
            <div class="register-login-wrapper">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="register-login-images">
                            <div class="shape-1">
                                <img src="{{ asset('theme/client/assets/images/shape/shape-26.png') }}" alt="Shape">
                            </div>


                            <div class="images">
                                <img src="{{ asset('theme/client/assets/images/register-login.png') }}"
                                    alt="Register Login">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="register-login-form">
                            <h3 class="title">Đăng ký <span>Ngay</span></h3>
                            <div class="form-wrapper">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="single-form">
                                        <input type="text" placeholder="Họ tên" name="name">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="single-form">
                                        <input type="email" placeholder="Email" name="email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="single-form">
                                        <input type="password" placeholder="Mật khẩu" name="password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="single-form">
                                        <input type="password" placeholder="Xác nhận mật khẩu" name="password_confirmation">
                                        @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="single-form">
                                        <button class="btn btn-primary btn-hover-dark w-100">Đăng ký</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

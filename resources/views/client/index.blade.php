@extends('client.layout.master')

@section('title')
    Trang chủ
@endsection

@section('banner')
    <div class="section slider-section">
        <div class="slider-shape">
            <img class="shape-1 animation-round" src="{{ asset('theme/client/assets/images/shape/shape-8.png') }}"
                alt="Shape">
        </div>

        <div class="container">
            <div class="slider-content">
                <h4 class="sub-title">Start your favourite course</h4>
                <h2 class="main-title">Now learning from anywhere, and build your <span>bright career.</span></h2>
                <p>It has survived not only five centuries but also the leap into electronic typesetting.</p>
            </div>
        </div>
        <div class="slider-courses-box">

            <img class="shape-1 animation-left" src="{{ asset('theme/client/assets/images/shape/shape-5.png') }}"
                alt="Shape">

            <img class="shape-2" src="{{ asset('theme/client/assets/images/shape/shape-6.png') }}" alt="Shape">

        </div>
        <div class="slider-rating-box">
            <img class="shape animation-up" src="{{ asset('theme/client/assets/images/shape/shape-7.png') }}"
                alt="Shape">
        </div>
        <div class="slider-images">
            <div class="images">
                <img src="{{ asset('theme/client/assets/images/slider/slider-1.png') }}" alt="Slider">
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="courses-top">
        <div class="section-title shape-01">
            <h2 class="main-title">Tất cả <span>Môn học</span></h2>
        </div>
        <div class="courses-search">
            <form action="#">
                <input type="text" placeholder="Search your course">
                <button><i class="flaticon-magnifying-glass"></i></button>
            </form>
        </div>
    </div>

    <div class="tab-content courses-tab-content">
        <div class="tab-pane fade show active" id="tabs1">
            <div class="courses-wrapper">
                <div class="row">
                    @foreach ($subjects as $item)
                        <div class="col-lg-4 col-md-6">
                            <div class="single-courses">
                                <div class="courses-images">
                                    <a href="{{ route('client.subjects.detail', $item->slug) }}">
                                        <img style="height: 260px;" src="{{ \Storage::url($item->image) }}"
                                            alt="Courses"></a>
                                </div>

                                <div class="courses-content">
                                    <h4 class="title">
                                        <a href="{{ route('client.subjects.detail', $item->slug) }}">
                                            {{ $item->name }}
                                        </a>
                                    </h4>

                                    <p class="description">
                                        {{ \Str::limit($item->description, 60) }}
                                    </p>

                                    <div class="courses-meta">
                                        <span> <i class="icofont-read-book"></i> 29 đăng ký </span>
                                    </div>

                                    <form class="mt-3" action="{{ route('client.subjects.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="subject_id" value="{{ $item->id }}">
                                        @if (Auth::User())
                                            <input type="hidden" name="user_id" value="{{ Auth::User()->id }}">
                                        @endif
                                        <button type="submit" class="btn btn-primary">Đăng ký</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="courses-btn text-center">
        <a href="courses.html" class="btn btn-secondary btn-hover-primary">Other Course</a>
    </div>

    @if (session('user_subject_success'))
        <div class="fui-toast top-eff-show fui-toast-success"
            style="top: 0px; justify-content: flex-end; transform: translateY(0px);">
            <div class="fui-toast-box iconCss">
                <div class="fui-toast-icon">
                    <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 512 512">
                        <path
                            d="M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0S0 114.6 0 256S114.6 512 256 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z">
                        </path>
                    </svg>
                </div>
                <div class="fui-toast-body">{{ session('user_subject_success') }}</div>
            </div>
        </div>
    @endif

    @if (session('user_subject_error'))
        <div class="fui-toast top-eff-show fui-toast-error"
            style="top: 0px; justify-content: flex-end; transform: translateY(0px);">
            <div class="fui-toast-box iconCss">
                <div class="fui-toast-icon">
                    <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 512 512">
                        <path
                            d="M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0S0 114.6 0 256S114.6 512 256 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z">
                        </path>
                    </svg>
                </div>
                <div class="fui-toast-body">{{ session('user_subject_error') }}</div>
            </div>
        </div>
    @endif
@endsection

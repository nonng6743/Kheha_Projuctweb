<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
        html {
            line-height: 1.15;
            -webkit-text-size-adjust: 100%
        }

        body {
            margin: 0
        }

        a {
            background-color: transparent
        }

        [hidden] {
            display: none
        }

        html {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            line-height: 1.5
        }

        *,
        :after,
        :before {
            box-sizing: border-box;
            border: 0 solid #e2e8f0
        }

        a {
            color: inherit;
            text-decoration: inherit
        }

        svg,
        video {
            display: block;
            vertical-align: middle
        }

        video {
            max-width: 100%;
            height: auto
        }

        .bg-white {
            --bg-opacity: 1;
            background-color: #fff;
            background-color: rgba(255, 255, 255, var(--bg-opacity))
        }

        .bg-gray-100 {
            --bg-opacity: 1;
            background-color: #f7fafc;
            background-color: rgba(247, 250, 252, var(--bg-opacity))
        }

        .border-gray-200 {
            --border-opacity: 1;
            border-color: #edf2f7;
            border-color: rgba(237, 242, 247, var(--border-opacity))
        }

        .border-t {
            border-top-width: 1px
        }

        .flex {
            display: flex
        }

        .grid {
            display: grid
        }

        .hidden {
            display: none
        }

        .items-center {
            align-items: center
        }

        .justify-center {
            justify-content: center
        }

        .font-semibold {
            font-weight: 600
        }

        .h-5 {
            height: 1.25rem
        }

        .h-8 {
            height: 2rem
        }

        .h-16 {
            height: 4rem
        }

        .text-sm {
            font-size: .875rem
        }

        .text-lg {
            font-size: 1.125rem
        }

        .leading-7 {
            line-height: 1.75rem
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto
        }

        .ml-1 {
            margin-left: .25rem
        }

        .mt-2 {
            margin-top: .5rem
        }

        .mr-2 {
            margin-right: .5rem
        }

        .ml-2 {
            margin-left: .5rem
        }

        .mt-4 {
            margin-top: 1rem
        }

        .ml-4 {
            margin-left: 1rem
        }

        .mt-8 {
            margin-top: 2rem
        }

        .ml-12 {
            margin-left: 3rem
        }

        .-mt-px {
            margin-top: -1px
        }

        .max-w-6xl {
            max-width: 72rem
        }

        .min-h-screen {
            min-height: 100vh
        }

        .overflow-hidden {
            overflow: hidden
        }

        .p-6 {
            padding: 1.5rem
        }

        .py-4 {
            padding-top: 1rem;
            padding-bottom: 1rem
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem
        }

        .pt-8 {
            padding-top: 2rem
        }

        .fixed {
            position: fixed
        }

        .relative {
            position: relative
        }

        .top-0 {
            top: 0
        }

        .right-0 {
            right: 0
        }

        .shadow {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06)
        }

        .text-center {
            text-align: center
        }

        .text-gray-200 {
            --text-opacity: 1;
            color: #edf2f7;
            color: rgba(237, 242, 247, var(--text-opacity))
        }

        .text-gray-300 {
            --text-opacity: 1;
            color: #e2e8f0;
            color: rgba(226, 232, 240, var(--text-opacity))
        }

        .text-gray-400 {
            --text-opacity: 1;
            color: #cbd5e0;
            color: rgba(203, 213, 224, var(--text-opacity))
        }

        .text-gray-500 {
            --text-opacity: 1;
            color: #a0aec0;
            color: rgba(160, 174, 192, var(--text-opacity))
        }

        .text-gray-600 {
            --text-opacity: 1;
            color: #718096;
            color: rgba(113, 128, 150, var(--text-opacity))
        }

        .text-gray-700 {
            --text-opacity: 1;
            color: #4a5568;
            color: rgba(74, 85, 104, var(--text-opacity))
        }

        .text-gray-900 {
            --text-opacity: 1;
            color: #1a202c;
            color: rgba(26, 32, 44, var(--text-opacity))
        }

        .underline {
            text-decoration: underline
        }

        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        .w-5 {
            width: 1.25rem
        }

        .w-8 {
            width: 2rem
        }

        .w-auto {
            width: auto
        }

        .grid-cols-1 {
            grid-template-columns: repeat(1, minmax(0, 1fr))
        }

        @media (min-width:640px) {
            .sm\:rounded-lg {
                border-radius: .5rem
            }

            .sm\:block {
                display: block
            }

            .sm\:items-center {
                align-items: center
            }

            .sm\:justify-start {
                justify-content: flex-start
            }

            .sm\:justify-between {
                justify-content: space-between
            }

            .sm\:h-20 {
                height: 5rem
            }

            .sm\:ml-0 {
                margin-left: 0
            }

            .sm\:px-6 {
                padding-left: 1.5rem;
                padding-right: 1.5rem
            }

            .sm\:pt-0 {
                padding-top: 0
            }

            .sm\:text-left {
                text-align: left
            }

            .sm\:text-right {
                text-align: right
            }
        }

        @media (min-width:768px) {
            .md\:border-t-0 {
                border-top-width: 0
            }

            .md\:border-l {
                border-left-width: 1px
            }

            .md\:grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr))
            }
        }

        @media (min-width:1024px) {
            .lg\:px-8 {
                padding-left: 2rem;
                padding-right: 2rem
            }
        }

        @media (prefers-color-scheme:dark) {
            .dark\:bg-gray-800 {
                --bg-opacity: 1;
                background-color: #2d3748;
                background-color: rgba(45, 55, 72, var(--bg-opacity))
            }

            .dark\:bg-gray-900 {
                --bg-opacity: 1;
                background-color: #1a202c;
                background-color: rgba(26, 32, 44, var(--bg-opacity))
            }

            .dark\:border-gray-700 {
                --border-opacity: 1;
                border-color: #4a5568;
                border-color: rgba(74, 85, 104, var(--border-opacity))
            }

            .dark\:text-white {
                --text-opacity: 1;
                color: #fff;
                color: rgba(255, 255, 255, var(--text-opacity))
            }

            .dark\:text-gray-400 {
                --text-opacity: 1;
                color: #cbd5e0;
                color: rgba(203, 213, 224, var(--text-opacity))
            }

            .dark\:text-gray-500 {
                --tw-text-opacity: 1;
                color: #6b7280;
                color: rgba(107, 114, 128, var(--tw-text-opacity))
            }
        }

    </style>

    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/css/maicons.css">
    <link rel="stylesheet" href="/assets/vendor/animate/animate.css">
    <link rel="stylesheet" href="/assets/vendor/owl-carousel/css/owl.carousel.css">
    <link rel="stylesheet" href="/assets/vendor/fancybox/css/jquery.fancybox.css">
    <link rel="stylesheet" href="/assets/css/theme.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

    </style>
</head>

<body class="antialiased">

    <div class="back-to-top"></div>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a href="{{ url('/') }}" class="navbar-brand">Kheha<span class="text-primary">K.6</span></a>

                <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarContent"
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="navbar-collapse collapse" id="navbarContent">
                    <ul class="navbar-nav ml-auto pt-3 pt-lg-0">
                        <li class="nav-item active">
                            <a href="{{ url('/') }}" class="nav-link">หน้าเเรก</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.login') }}" class="nav-link">สำหรับผู้ดูเเลระบบ</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('manager.login') }}" class="nav-link">สำหรับผู้จัดการตลาด</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('seller.login') }}" class="nav-link">สำหรับร้านค้า</a>
                        </li>
                        <li class="nav-item">
                            <a href="reportchat.php" class="nav-link ">เเจ้งปัญหา</a>
                        </li>

                        @if (Route::has('login'))
                            @auth
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        {{ Auth::guard('web')->user()->firstname }}
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="{{ url('/user/home') }}">Dashboard</a></li>
                                        <li><a class="dropdown-item" href="{{ route('user.logout') }}"
                                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                                            <form action="{{ route('user.logout') }}" method="post" class="d-none"
                                                id="logout-form">@csrf</form>
                                    </ul>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a href="{{ route('user.login') }}" class="nav-link ">เข้าสู่ระบบ</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a href="{{ route('user.register') }}" class="nav-link">สมัครสมาชิก</a>
                                    </li>
                                @endif
                            @endauth
                        @endif


                    </ul </div>
                </div> <!-- .container -->
        </nav> <!-- .navbar -->

        <div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false"
            data-bs-interval="false">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="/images/promotionweb/โปรโมชั่น.png" class="d-block w-100" alt="...">
                </div>

                @foreach ($allpromotions as $row)
                    <div class="carousel-item ">
                        <img src="/images/promotionweb/{{ $row->image }}" class="d-block w-100" alt="...">
                    </div>
                @endforeach

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

    </header>

    <br>
    <div class="wrapper">
        <div class="container-md">
            <section class="content">
                <div class="card card-solid">
                    <form class="d-flex" action="{{ route('searchname') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <input class="form-control me-2" type="search" placeholder="Search" name="namesearch"
                            id="namesearch" aria-label="Search" value="{{ old('namesearch') }}">
                        <button class="btn btn-primary" type="submit">ค้นหา</button>
                    </form>
                </div>
            </section>
        </div>
    </div>

    <div class="page-section">
        <div class="container">
            <div class="text-center">
                <h2 class="title-section">หมวดหมู่สินค้า</h2>
            </div>
            <div class="row justify-content-center">
                @foreach ($allcategories as $row)
                    <div class="col-md-6 col-lg-4 col-xl-3 py-3 mb-3">
                        <div class="text-center">
                            <div class="img-fluid mb-4">
                                <img src="/images/categorys/{{ $row->image }}" alt="" width="120px" height="120px">
                                <h5><a
                                        href="{{ url('productCategory/' . $row->namecategory) }}">{{ $row->namecategory }}</a>
                                </h5>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </div> <!-- .container -->
    </div> <!-- .page-section -->

    @if ($countcheckactionuser === 0)

        <div class="page-section">
            <div class="container">
                <div class="text-center">
                    <h2 class="title-section">สินค้าทั้งหมด</h2>
                </div>
            </div>
            <div class="container mt-5">
                <div class="row">
                    @foreach ($allproducts as $row)
                        <div class="col-md-3">
                            <div class="card">
                                <div class="text-center">
                                    <br />
                                    <img src="/images/products_seller/{{ $row->image }}" width="200px"
                                        height="200px">
                                </div>
                                <div class="text-center">
                                    <br />
                                    <h4>{{ $row->nameproduct }}</h4>
                                    <h6>{{ $row->detail }}</h6>
                                    <span class="text-success">
                                        <h5>ราคา {{ $row->price }} บาท</h5>
                                    </span>
                                    <h6>มีผู้เข้าชมเเล้ว: {{ $row->view }} </h6>
                                    <a href="{{ url('productpage/' . $row->id) }}"
                                        class="btn btn-primary">ดูรายละเอียดเพิ่มเติม</a>
                                </div>
                                <br />
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    @else
        <div class="page-section">
            <div class="container">
                <div class="text-center">
                    <h2 class="title-section">สินค้าเเนะนำ</h2>
                </div>
            </div>
            <div class="container mt-5">
                <div class="row">
                    @foreach ($product_subcategory as $row)
                        <div class="col-md-3">
                            <div class="card">
                                <div class="text-center">
                                    <br />
                                    <img src="/images/products_seller/{{ $row->image }}" width="200px"
                                        height="200px">
                                </div>
                                <div class="text-center">
                                    <br />
                                    <h4>{{ $row->nameproduct }}</h4>
                                    <h6>{{ Str::substr($row->detail, 0, 20, 'UTF-8') . '...' }}</h6>
                                    <span class="text-success">
                                        {{ number_format($row->price, 2) }}
                                        บาท</h5>
                                    </span>
                                    <h6>มีผู้เข้าชมเเล้ว: {{ $row->view }} </h6>
                                    <a href="{{ url('productpage/' . $row->id) }}"
                                        class="btn btn-primary">ดูรายละเอียดเพิ่มเติม</a>
                                </div>
                                <br />
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>

        <div class="page-section">
            <div class="container">
                <div class="text-center">
                    <h2 class="title-section">สินค้าทั้งหมด</h2>
                </div>
            </div>
            <div class="container mt-5">
                <div class="row">
                    @foreach ($allproducts as $row)
                        <div class="col-md-3">
                            <div class="card">
                                <div class="text-center">
                                    <br />
                                    <img src="/images/products_seller/{{ $row->image }}" width="200px"
                                        height="200px">
                                </div>
                                <div class="text-center">
                                    <br />
                                    <h4>{{ $row->nameproduct }}</h4>
                                    <h6>{{ Str::substr($row->detail, 0, 20, 'UTF-8') . '...' }}</h6>
                                    <span class="text-success">
                                        {{ number_format($row->price, 2) }}
                                        บาท</h5>
                                    </span>
                                    <h6>มีผู้เข้าชมเเล้ว: {{ $row->view }} </h6>
                                    <a href="{{ url('productpage/' . $row->id) }}"
                                        class="btn btn-primary">ดูรายละเอียดเพิ่มเติม</a>
                                </div>
                                <br />
                            </div>
                        </div>
                    @endforeach
                    <div class="container ">
                        <div class="row">
                            <div class="text-center">
                                <br>
                        <a href="{{ url('productall/') }}"
                            class="btn btn-primary">ดูสินค้าเพิ่มเติม</a>
                            </div>
                    </div>

                </div>

            </div>
        </div>

    @endif


</body>



</html>

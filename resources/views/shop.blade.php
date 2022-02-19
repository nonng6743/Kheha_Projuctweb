<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shop</title>
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


</head>

<body class="antialiased">
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
                        <a href="./manager/loginManager.php" class="nav-link">สำหรับผู้จัดการตลาด</a>
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
    <br>
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
    <br>
    <br>

    <div class="container">
        <div class="row">
            <div class="col">
                <img src="/images/shops_seller/{{ $shop->image }}" alt="" width="500px" height="450px">
            </div>
            <div class="col-12 col-sm-6">
                <h3 class="my-3">ชื่อร้านค้า : {{ $shop->nameshop }}</h3>
                <h4 class="my-3">ชื่อเจ้าของร้านค้า : {{ $shop->seller->firstname }}
                    {{ $shop->seller->lastname }}</h4>
                <h5 class="my-3">เบอร์โทรศัพท์ติดต่อ: {{ $shop->seller->phone }}</h5>
                <h5 class="my-3">ประเภทของร้านค้า : {{ $shop->category_type }}</h5>
                @if ($count > 0)
                    @if ($countfollow > 0)
                        @php
                            $value = 0;
                        @endphp
                        <a type="button" class="btn btn-danger"
                            href="{{ url('followshop/shopid=' . $shop->id . '/' . $value) }}">ติดตามร้านค้าเเล้ว</a>
                    @else
                         @php
                            $value = 1;
                        @endphp
                        <a type="button" class="btn btn-danger"
                            href="{{ url('followshop/shopid=' . $shop->id . '/' . $value) }}">ติดตามร้านค้า</a>
                    @endif




                @endif

            </div>
        </div>
        <br>


    </div>

</body>



</html>

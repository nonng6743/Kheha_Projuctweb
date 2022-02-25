<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Name</title>
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
                        <a href="{{ route('manager.login') }}" class="nav-link">สำหรับผู้จัดการตลาด</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('seller.login') }}" class="nav-link">สำหรับร้านค้า</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('reportpage')}}" class="nav-link ">เเจ้งปัญหา</a>
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

    <div class="container">
        <div class="row">
            <div class="col">
                <img src="/images/products_seller/{{ $product->image }}" alt="" width="450px" height="450px">
            </div>
            <div class="col-12 col-sm-6">
                <br>
                <br>
                <h3 class="my-3">ชื่อสินค้า : {{ $product->nameproduct }}</h3>
                <h4 class="my-3">รายละเอียดสินค้า</h4>
                <p>{{ $product->detail }}</p>
                <hr>
                <h5 class="my-3">หมวดหมู่ประเภทสินค้า : <a
                        href="{{ url('productsubcategory/' . $product->subcategory->namesubcategory) }}">{{ $product->subcategory->namesubcategory }}</a>
                </h5>
                <h5 class="my-3">ร้านค้า : <a href="{{url('shop/' .$product->shop->id)}}">{{ $product->shop->nameshop }}</a> </h5>
                <h5 class="my-3">ช่องทางการติดต่อ : <a>{{ $product->shop->seller->phone }}</a></label></h5>
                <h5 class="my-3">ผู้ขาย : <a>{{ $product->shop->seller->firstname }}
                        {{ $product->shop->seller->lastname }}</a> </label></h5>

                <h4 class="my-3">ราคาสินค้า : <a
                        class="text-success">{{ number_format($product->price, 2) }}</a> บาท</h4>
                <h5 class="my-3">มีผู้เข้าชมเเล้ว: {{ $counts }} </h5>
            </div>
        </div>
        <br>
        <div class="alert alert-dark" role="alert">
            สินค้าในหมวดหมู่เดียวกัน
        </div>
        <div class="container mt-5">
            <div class="row">
                @foreach ($subproduct as $row)
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
                                <h6></h6>
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

</body>



</html>

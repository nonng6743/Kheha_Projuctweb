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
    <link rel="stylesheet" href="/css/stylechat.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <style>
        #map {
            height: 100%;

        }

        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

    </style>

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
                        <a href="{{ route('reportpage') }}" class="nav-link ">เเจ้งปัญหา</a>
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
                <h5 class="my-3">ประเภทของร้านค้า : {{ $shop->category->namecategory }}</h5>
                @php
                    $lat = $shop->lat;
                    $lng = $shop->long;
                    echo '<script type="text/javascript">
                        ';
                        echo "var lat = '$lat';";
                        echo "var lng = '$lng';"; // ส่งค่า $data จาก PHP ไปยังตัวแปร data ของ Javascript
                        echo '
                    </script>';
                @endphp

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
                    <br>
                    <br>
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    ติดต่อร้านค้า
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <main class="content">
                                        <div class="container p-0">
                                            <h1 class="h3 mb-3">ข้อความ</h1>
                                            <div class="card">
                                                <div class="row g-0">
                                                    <div class="position-relative">
                                                        <div class="chat-messages ">
                                                            <br>
                                                            @foreach ($message as $row)
                                                                @if ($row->status === 'user')
                                                                    <div class="chat-message-right pb-4">
                                                                        <div
                                                                            class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                                                            <div class="font-weight-bold mb-1">
                                                                                คุณ</div>
                                                                            {{ $row->message }}
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                @if ($row->status === 'seller')
                                                                    <div class="chat-message-left pb-4">
                                                                        <div
                                                                            class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                                                            <div class="font-weight-bold mb-1">
                                                                                {{ $row->shop->nameshop }}
                                                                            </div>
                                                                            {{ $row->message }}
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="flex-grow-0 py-3 px-4 border-top">
                                                    <form class="d-flex"
                                                        action="{{ route('message', ['id' => $id]) }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="input-group">
                                                            <input type="text" class="form-control"
                                                                placeholder="ส่งข้อความหาร้านค้า" name="message"
                                                                id="message" value="{{ old('message') }} ">
                                                            <button type="submit" name="sand"
                                                                class="btn btn-warning">ส่ง</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                </div>
                            </div>
                            </main>
                        </div>
                    </div>

            </div>
        </div>

        @endif

    </div>
    <hr>
    <div class="cantainer">
        <div class="alert alert-primary" role="alert">
            ตำเเหน่งร้านค้า
        </div>
        <div class="row">
            <div class="col">
                <div id="map"></div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
            </div>
        </div>
    </div>
    <hr>
    <div class="container">
        <div class="alert alert-primary" role="alert">
            สินค้าจากร้านค้า
        </div>
        <div class="container mt-5">
            <div class="row">
                @foreach ($products as $row)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="text-center">
                                <br />
                                <img src="/images/products_seller/{{ $row->image }}" width="200px" height="200px">
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
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <script type="text/javascript">
        var map;

        var position = {
            lat: (parseFloat(lat)),
            lng: (parseFloat(lng))
        };

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: position,
                zoom: 18
            });
            var marker = new google.maps.Marker({
                position: position,
                map: map,
            });

        }
    </script>

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATSEBp-3BMGJh4j5Cpdk1XrP1Q_kcoOkk&callback=initMap&libraries=&v=weekly"
        async></script>



</body>



</html>

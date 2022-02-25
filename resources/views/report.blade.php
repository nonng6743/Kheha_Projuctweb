<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report</title>
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

<body>
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

    <div class="page-section">
        <div class="container">
            <div class="text-center">
                <h2 class="title-section">เเจ้งปัญหา</h2>
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col-lg-8">
                    <form action="{{ route('reportpost') }}" class="form-contact" method="post"
                        autocomplete="off">
                        @if (Session::get('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        @if (Session::get('fail'))
                            <div class="alert alert-danger">
                                {{ Session::get('fail') }}
                            </div>
                        @endif

                        @csrf
                        <div class="row">
                            <div class="col-12 py-2">
                                <label for="report" class="fg-grey">รายละเอียดการเเจ้งปัญหา</label>
                                <textarea type="text" class="form-control" id="report" name="report"
                                    rows="8" value="{{ old('report') }}"></textarea>
                                <span class="text-danger">@error('report'){{ $message }}
                                    @enderror</span>
                            </div>

                            <div class="col-12 mt-3">
                                <button type="submit" class="btn btn-primary px-5">เเจ้งปํญหา</button>
                            </div>

                        </div>
                    </form>
                    <br>
                </div>
            </div>

        </div>
    </div>



</body>

</html>

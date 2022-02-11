<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Register</title>

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

                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/home') }}"
                                class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
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


                </ul>
            </div>
        </div> <!-- .container -->
    </nav> <!-- .navbar -->

    <div class="page-section">
        <div class="container">
            <div class="text-center">
                <h3 class="title-section mb-3">สมัครสมาชิก</h3>
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col-lg-8">
                    <form action="{{ route('user.create') }}" class="form-contact" method="post" autocomplete="off">
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
                            <div class="col-sm-6 py-2">
                                <label for="firstname" class="fg-grey">ชื่อ</label>
                                <input type="text" class="form-control" id="firstname" name="firstname"
                                    placeholder="ชื่อ" value="{{ old('firstname') }}">
                                <span class="text-danger">@error('firstname'){{ $message }} @enderror</span>
                            </div>
                            <div class="col-sm-6 py-2">
                                <label for="lastname" class="fg-grey">นามสกุล</label>
                                <input type="text" class="form-control" id="lastname" name="lastname"
                                    placeholder="นามสกุล" value="{{ old('lastname') }}">
                                <span class="text-danger">@error('lastname'){{ $message }} @enderror</span>
                            </div>
                            <div class="col-sm-6 py-2">
                                <label for="gender" class="fg-grey">เพศ</label>
                                <select class="form-control" type="gender" id="gender" name="gender"
                                    value="{{ old('gender') }}">
                                    <option value=""></option>
                                    <option value="ชาย">ชาย</option>
                                    <option value="หญิง">หญิง</option>
                                </select>
                                <span class="text-danger">@error('gender'){{ $message }} @enderror</span>
                            </div>
                            <div class="col-sm-6 py-2">
                                <label for="phone" class="fg-grey">เบอร์โทรศัพท์</label>
                                <input type="number" class="form-control" id="phone" name="phone"
                                    value="{{ old('phone') }}" placeholder=" เบอร์โทรศัพท์">
                                <span class="text-danger">@error('phone'){{ $message }} @enderror</span>
                            </div>
                            <div class="col-12 py-2">
                                <label for="email" class="fg-grey">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                    value="{{ old('email') }}">
                                <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                            </div>
                            <div class="col-12 py-2">
                                <label for="password" class="fg-grey">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="password" value="{{ old('password') }}">
                                <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                            </div>
                            <div class="col-12 py-2">
                                <label for="cpassword" class="fg-grey">Confirm Password</label>
                                <input type="password" class="form-control" id="cpassword" name="cpassword"
                                    placeholder="confirm Password" value="{{ old('cpassword') }}">
                                <span class="text-danger">@error('cpassword'){{ $message }} @enderror</span>
                            </div>

                            <div class="col-12 mt-3">
                                <button type="submit" class="btn btn-primary px-5">สมัครสมาชิก</button>
                            </div>

                        </div>
                    </form>
                    <br>
                </div>
            </div>
        </div> <!-- .container -->
    </div> <!-- .page-section -->

</body>

</html>

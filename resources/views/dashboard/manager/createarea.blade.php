<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager CreateAreas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
    <style>
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 90px 0 0;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
            z-index: 99;
        }

        @media (max-width: 767.98px) {
            .sidebar {
                top: 11.5rem;
                padding: 0;
            }
        }

        .navbar {
            box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .1);
        }

        @media (min-width: 767.98px) {
            .navbar {
                top: 0;
                position: sticky;
                z-index: 999;
            }
        }

        .sidebar .nav-link {
            color: #333;
        }

        .sidebar .nav-link.active {
            color: #0d6efd;
        }

    </style>
</head>

<body>
    <nav class="navbar navbar-light bg-light p-3">
        <div class="d-flex col-12 col-md-3 col-lg-2 mb-2 mb-lg-0 flex-wrap flex-md-nowrap justify-content-between">
            <a href="{{ url('/') }}" class="navbar-brand">Kheha<span class="text-primary">K.6</span></a>
            <button class="navbar-toggler d-md-none collapsed mb-3" type="button" data-toggle="collapse"
                data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="col-12 col-md-5 col-lg-8 d-flex align-items-center justify-content-md-end mt-3 mt-md-0">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-expanded="false">
                    {{ Auth::guard('manager')->user()->firstname }} {{ Auth::guard('manager')->user()->lastname }}
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="{{ route('manager.logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                        <form action="{{ route('manager.logout') }}" method="post" class="d-none"
                            id="logout-form">@csrf</form>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('manager.home') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-home">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>
                                <span class="ml-2">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('manager.editseller') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-users">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                <span class="ml-2">บัญชีร้านค้าที่รออนุมัติ</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('manager.messageseller') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-users">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                <span class="ml-2">รายชื่อผู้ติดต่อ</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{route('manager.homecreatepromotion')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-shopping-cart">
                                    <circle cx="9" cy="21" r="1"></circle>
                                    <circle cx="20" cy="21" r="1"></circle>
                                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6">
                                    </path>
                                </svg>
                                <span class="ml-2">สร้างโปรโมชั่นสำหรับเว็บ</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('manager.homepromotion')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-shopping-cart">
                                    <circle cx="9" cy="21" r="1"></circle>
                                    <circle cx="20" cy="21" r="1"></circle>
                                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6">
                                    </path>
                                </svg>
                                <span class="ml-2">โปรโมชั่นสำหรับเว็บ</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('manager.createareas') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-archive">
                                    <polyline points="21 8 21 21 3 21 3 8"></polyline>
                                    <rect x="1" y="3" width="22" height="5"></rect>
                                    <line x1="10" y1="12" x2="14" y2="12"></line>
                                </svg>
                                <span class="ml-2">สร้างพื้นที่เช่าเเผงร้านค้า</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('manager.approveareas') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-check-square">
                                    <polyline points="9 11 12 14 22 4"></polyline>
                                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                </svg>
                                <span class="ml-2">อนุมัติเเผงร้านค้า</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </nav>
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('manager.home') }}">หน้าเเรก</a></li>
                        <li class="breadcrumb-item active" aria-current="page">สร้างโปรโมชั่นสำหรับเว็บ</li>
                    </ol>
                </nav>

                <h1 class="h2">สร้างโปรโมชั่นสำหรับเว็บ</h1>
                <br>
                <div class="col-12 col-xl mb-4 mb-lg-0">
                    <div class="card">
                        <h5 class="card-header">รายละเอียดการสร้างโปรโมชั่นสำหรับเว็บ</h5>
                        <form action="{{ route('manager.createarea') }}" class="form-contact" method="post"
                            autocomplete="off" enctype="multipart/form-data">
                            @if (Session::get('success'))
                                <br>
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
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 py-2">
                                        <label for="namearea" class="fg-grey">ชื่อเเผงร้านค้า</label>
                                        <input type="text" class="form-control" id="namearea"
                                            name="namearea" value="{{ old('namearea') }}">
                                        <span class="text-danger">@error('namearea'){{ $message }}
                                            @enderror</span>
                                    </div>
                                    <div class="col-12 py-2">
                                        <label for="detail" class="fg-grey">รายละเอียดเเผงร้านค้า</label>
                                        <input type="text" class="form-control" id="detail"
                                            name="detail" value="{{ old('detail') }}">
                                        <span class="text-danger">@error('detail'){{ $message }}
                                            @enderror</span>
                                    </div>
                                    <div class="col-12 py-2">
                                        <label for="scale" class="fg-grey">ขนาดเเผงร้านค้า</label>
                                        <input type="text" class="form-control" id="scale"
                                            name="scale" value="{{ old('scale') }}">
                                        <span class="text-danger">@error('scale'){{ $message }}
                                            @enderror</span>
                                    </div>
                                    <div class="col-12 py-2">
                                        <label for="rentalfee" class="fg-grey">ราคาค่าเช่าเเผงร้านค้า</label>
                                        <input type="number" class="form-control" id="rentalfee"
                                            name="rentalfee" value="{{ old('rentalfee') }}">
                                        <span class="text-danger">@error('rentalfee'){{ $message }}
                                            @enderror</span>
                                    </div>
                                    <div class="col-12 py-2">
                                        <label for="lat" class="fg-grey">lat</label>
                                        <input type="text" class="form-control" id="lat"
                                            name="lat" value="{{ old('lat') }}">
                                        <span class="text-danger">@error('lat'){{ $message }}
                                            @enderror</span>
                                    </div>
                                    <div class="col-12 py-2">
                                        <label for="long" class="fg-grey">long	</label>
                                        <input type="text" class="form-control" id="long"
                                            name="long" value="{{ old('long') }}">
                                        <span class="text-danger">@error('long'){{ $message }}
                                            @enderror</span>
                                    </div>


                                    <div class="col-12 py-2">
                                        <label for="image" class="fg-grey">รูปเเผงร้านค้า</label>
                                        <input type="file" class="form-control" id="image" name="image"
                                            value="{{ old('image') }}">
                                        <span class="text-danger">@error('image'){{ $message }}
                                            @enderror</span>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-primary px-5">สร้างเเผงร้านค้า</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>




            </main>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script>
        new Chartist.Line('#traffic-chart', {
            labels: ['January', 'Februrary', 'March', 'April', 'May', 'June'],
            series: [
                [23000, 25000, 19000, 34000, 56000, 64000]
            ]
        }, {
            low: 0,
            showArea: true
        });
    </script>
</body>

</html>

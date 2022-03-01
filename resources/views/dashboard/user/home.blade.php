<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
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
                    {{ Auth::guard('web')->user()->firstname }}
                    {{ Auth::guard('web')->user()->lastname }}
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="{{ route('user.logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                        <form action="{{ route('user.logout') }}" method="post" class="d-none"
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
                                <a class="nav-link active" aria-current="page" href="{{ route('user.home') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-home">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                    <span class="ml-2">หน้าเเรก</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </nav>
                <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('user.home')}}">หน้าเเรก</a></li>
                        </ol>
                    </nav>
                    <h1 class="h2">หน้าเเรก</h1>
                    <div class="row my-4">
                        <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0">
                            <div class="card">
                                <h5 class="card-header">จำนวนร้านค้าที่คุณติดตาม</h5>
                                <div class="card-body">
                                    <h5 class="card-title">{{$countfollow}} ร้านค้า</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
                            <div class="card">
                                <h5 class="card-header">Revenue</h5>
                                <div class="card-body">
                                    <h5 class="card-title">$2.4k</h5>
                                    <p class="card-text">Feb 1 - Apr 1, United States</p>
                                    <p class="card-text text-success">4.6% increase since last month</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
                            <div class="card">
                                <h5 class="card-header">Purchases</h5>
                                <div class="card-body">
                                    <h5 class="card-title">43</h5>
                                    <p class="card-text">Feb 1 - Apr 1, United States</p>
                                    <p class="card-text text-danger">2.6% decrease since last month</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
                            <div class="card">
                                <h5 class="card-header">Traffic</h5>
                                <div class="card-body">
                                    <h5 class="card-title">64k</h5>
                                    <p class="card-text">Feb 1 - Apr 1, United States</p>
                                    <p class="card-text text-success">2.5% increase since last month</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-lg-0">
                            <div class="card">
                                <h5 class="card-header">Latest transactions</h5>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Order</th>
                                                    <th scope="col">Product</th>
                                                    <th scope="col">Customer</th>
                                                    <th scope="col">Total</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">17371705</th>
                                                    <td>Volt Premium Bootstrap 5 Dashboard</td>
                                                    <td>johndoe@gmail.com</td>
                                                    <td>€61.11</td>
                                                    <td>Aug 31 2020</td>
                                                    <td><a href="#" class="btn btn-sm btn-primary">View</a></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">17370540</th>
                                                    <td>Pixel Pro Premium Bootstrap UI Kit</td>
                                                    <td>jacob.monroe@company.com</td>
                                                    <td>$153.11</td>
                                                    <td>Aug 28 2020</td>
                                                    <td><a href="#" class="btn btn-sm btn-primary">View</a></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">17371705</th>
                                                    <td>Volt Premium Bootstrap 5 Dashboard</td>
                                                    <td>johndoe@gmail.com</td>
                                                    <td>€61.11</td>
                                                    <td>Aug 31 2020</td>
                                                    <td><a href="#" class="btn btn-sm btn-primary">View</a></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">17370540</th>
                                                    <td>Pixel Pro Premium Bootstrap UI Kit</td>
                                                    <td>jacob.monroe@company.com</td>
                                                    <td>$153.11</td>
                                                    <td>Aug 28 2020</td>
                                                    <td><a href="#" class="btn btn-sm btn-primary">View</a></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">17371705</th>
                                                    <td>Volt Premium Bootstrap 5 Dashboard</td>
                                                    <td>johndoe@gmail.com</td>
                                                    <td>€61.11</td>
                                                    <td>Aug 31 2020</td>
                                                    <td><a href="#" class="btn btn-sm btn-primary">View</a></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">17370540</th>
                                                    <td>Pixel Pro Premium Bootstrap UI Kit</td>
                                                    <td>jacob.monroe@company.com</td>
                                                    <td>$153.11</td>
                                                    <td>Aug 28 2020</td>
                                                    <td><a href="#" class="btn btn-sm btn-primary">View</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <a href="#" class="btn btn-block btn-light">View all</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-xl-4">
                            <div class="card">
                                <h5 class="card-header">Traffic last 6 months</h5>
                                <div class="card-body">
                                    <div id="traffic-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <footer class="pt-5 d-flex justify-content-between">
                        <span>Copyright © 2019-2020 <a href="https://themesberg.com">Themesberg</a></span>
                        <ul class="nav m-0">
                            <li class="nav-item">
                                <a class="nav-link text-secondary" aria-current="page" href="#">Privacy Policy</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary" href="#">Terms and conditions</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary" href="#">Contact</a>
                            </li>
                        </ul>
                    </footer>
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

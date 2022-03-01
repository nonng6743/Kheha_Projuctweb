<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller HomeMessage</title>
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
                    {{ Auth::guard('seller')->user()->firstname }}
                    {{ Auth::guard('seller')->user()->lastname }}
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="{{ route('seller.logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                        <form action="{{ route('seller.logout') }}" method="post" class="d-none"
                            id="logout-form">@csrf</form>
                </ul>
            </div>
        </div>
    </nav>
    @if (Auth::guard('seller')->user()->role === 'noseller')
        <div class="container">
            <br>
            <h1>รอการอนุมัติจากผู้จัดการตลาด</h1>
        </div>
    @else
        <div class="container-fluid">
            <div class="row">
                <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                    <div class="position-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('seller.home') }}">
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
                                <a class="nav-link" href="{{ route('seller.usermessage') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-users">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>
                                    <span class="ml-2">รายชื่อผู้ติดต่อคุณ</span>
                                </a>
                            </li>
                            @php($i = 1)
                            @foreach ($message as $row)
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ url('seller/messageuser/userId=' . $row->id_user) }}">
                                        <span class="ml-2">{{ $i++ }}. {{ $row->user->firstname }}
                                            {{ $row->user->lastname }}</span>
                                    </a>
                                </li>
                            @endforeach


                        </ul>
                    </div>
                </nav>

            </div>
        </div>
    @endif

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

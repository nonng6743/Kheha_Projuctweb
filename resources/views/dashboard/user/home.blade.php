<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Dashborad | Home</title>

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
                </ul>
            </div>
            <div className="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                <a class="btn btn-danger" href="{{ route('user.logout') }}"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">ออกจากระบบ</a>
                <form action="{{ route('user.logout') }}" method="post" class="d-none" id="logout-form">@csrf
                </form>
            </div>
        </div>
    </nav>


    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3" style="margin-top: 45px">
                <h4>user Dashboard</h4>
                <hr>
                <table class="table table-striped table-inverse table-responsive">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ Auth::guard('web')->user()->firstname }}</td>
                            <td>{{ Auth::guard('web')->user()->email }}</td>
                            <td>
                                <a href="{{ route('user.logout') }}"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                                <form action="{{ route('user.logout') }}" method="post" class="d-none"
                                    id="logout-form">@csrf</form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>

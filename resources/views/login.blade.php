<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LookSet</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar" style="background-color: #221ef9;">
        <div class="container-fluid px-lg-5">
            <a class="navbar-brand" href="/">
                    <img src="/lookset.png" alt="Logo" height="50" class="d-inline-block align-text-top">
                </a>
            </div>
    </nav>

    <div class="container py-5 ">
        <div class="py-5">
            <div class="w-25 center border rounded-5 mx-auto">
                <div class="box">
                    <h1>Login</h1>
                </div>

                @if ($errors->any())
                <div class="mt-4 bg-danger bg-gradient py-1">
                    <ul>
                        @foreach ($errors->all() as $item)
                            <li> {{ $item }} </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="" method="POST">
                    @csrf
                    <div class="px-5 py-4">
                        <div class="mb-2">
                            <input type="email" value="{{ old('email') }}" name="email" class="form-control" placeholder="E-mail">
                        </div>
                        <div class="mb-4">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="d-grid mb-4">
                            <button name="submit" type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

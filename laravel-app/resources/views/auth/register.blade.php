<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
        integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous">
    </script>

    <title>Register user</title>
    <style>
        .btn-color {
            background-color: #0e1c36;
            color: #fff;

        }

        .btn-color:hover {
            background-color: #0e1c36;
            color: #fff;

        }

        .profile-image-pic {
            height: 200px;
            width: 200px;
            object-fit: cover;
        }

        .cardbody-color {
            background-color: #ebf2fa;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card my-5">

                        <!--Form register user-->
                        <form class="card-body cardbody-color p-lg-5" action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="text-center">
                                <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png"
                                    class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px"
                                    alt="profile">
                            </div>

                            <div class="mb-3">
                                <input type="text" class="form-control" name="name" id="name" required
                                    class="form-control @error('name') is-invalid @enderror" placeholder="Name">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" name="email" id="email" required
                                    class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" id="password" name="password" required
                                    class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required
                                    class="form-control"  placeholder="Confirm Password">
                            </div>
                            <div class="text-center"><button type="submit"
                                    class="btn btn-color px-5 mb-5 w-100">Register</button></div>
                            <div id="emailHelp" class="form-text text-center text-dark">
                                <a href="{{ route('login') }}" class="text-dark fw-bold"> Already registered?</a>
                            </div>
                            <div class="form-text text-center mb-5 text-dark">
                                <a href="/" class="text-dark fw-bold">Home</a>
                            </div>
                        </form>
                        <!--End form register user-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

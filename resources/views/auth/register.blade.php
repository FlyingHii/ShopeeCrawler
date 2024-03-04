<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shopee Demo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container-fluid p-5 bg-primary text-white text-center">
    <a href="{{route('products.list')}}" style="text-decoration: none; color: white"><h1>Shop Demo</h1> </a>
    <p>Register Page</p>
</div>

<div class="container mt-5">
    <div class="row">
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{session()->get('success')}}
            </div>
        @endif
        <form method="POST" action="{{route('registerPost')}}">
            @csrf
            <h1><div class="row justify-content-center">Register</div></h1>
            <div class="mb-3 mt-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
                @if (session()->has('name'))
                    <span class="text-danger">
                        {{session()->first('name')}}</span>
                @endif
            </div>
            <div class="mb-3 mt-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                @if (session()->has('email'))
                    <span class="text-danger">
                        {{session()->first('email')}}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="text" class="form-control" id="password" placeholder="Enter password" name="password">
                @if (session()->has('password'))

                    <span class="text-danger">
                        {{session()->first('password')}}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
            <a href="{{route('login')}}"><button class="btn btn-info">Already have account? Login here</button></a>

    </div>
</div>

</body>
</html>


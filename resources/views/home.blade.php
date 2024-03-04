<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shopee Demo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

<div class="container-fluid p-5 bg-primary text-white text-center">
    <a href="{{route('products.list')}}" style=""><h1>Shop Demo</h1> </a>
    <p>Login and Register</p>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4"><a href="{{route('login')}}"><button class="btn btn-info float">Login</button></a></div>
        <div class="col-md-4"><a href="{{route('register')}}"><button class="btn btn-success">Register</button></a></div>
        <div class="col-md-4"><a href="{{route('products.list')}}"><button class="btn btn-warning">Product List Page</button></a></div>
    </div>
</div>

</body>
</html>


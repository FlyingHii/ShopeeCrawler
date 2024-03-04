<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shopee Demo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="container-fluid p-5 bg-primary text-white text-center">
    <a href="{{route('products.list')}}" style="text-decoration:none; color: white"><h1>Shop Demo</h1> </a>
    <p>Product List Page</p>
    <a href="{{route('cart')}}">
    <button type="button" class="btn btn-success">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"></path>
        </svg>
        Cart
    </button>
    </a>
</div>

<div class="container mt-5">
    <div class="row">
        <form method="GET" action="{{route('products.list')}}">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-3">
                    <input clalss="" id="search" name="search" type="text" placeholder="Search.." value="{{old('search')}}">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </div>
                <div class="form-group col-md-6">
                    <label>Range price: </label>
                    <input clalss="md-3" id="from" name="from" type="text" placeholder="From.." value="{{old('from')}}">
                    <input clalss="md-3" id="to" name="to" type="text" placeholder="To.." value="{{old('to')}}">
                </div>
                <div class="form-group col-md-3 d-flex justify-center">
                    <label for="sort">Sort by</label>
                    <select name="sort" class="form-select" aria-label="Default select example">
                        <option value="" selected>Default</option>
                        <option value="price:asc">Ascending price</option>
                        <option value="price:desc">Descending price</option>
                        <option value="sold_amount:asc">Ascending sold amount</option>
                        <option value="sold_amount:desc">Descending sold amount</option>
                    </select>
                </div>
                <div class="form-group col-md-3 d-flex justify-center">
                    <label for="sort">Number of results</label>
                    <select name="limit" class="form-select" aria-label="Default select example">
                        <option value="6" selected>6</option>
                        <option value="9">9</option>
                        <option value="15">15</option>
                        <option value="30">30</option>
                    </select>
                </div>
            </div>
        </form>
        @forelse ($products as $product)
            <div class="col-sm-4">
                <img class="col-sm-12" src="{{$product->image}}">
                <h5>{{ $product->name }}</h5>
                <p>Price: {{ number_format($product->price) }} VNĐ</p>
                <p>Sold amount: {{ $product->sold_amount }}</p>
                <p>{{ $product->location }}</p>

                <form method="POST" action="{{route('cart.post')}}">
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-primary add-to-cart">
                        <i class="fa fa-shopping-cart"></i>
                        Add to cart
                    </button>
                </form>
            </div>

        @empty
                <p class="h1">Oops, we dont have products you need!</p>
        @endforelse
        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </div>
</div>

</body>

</html>


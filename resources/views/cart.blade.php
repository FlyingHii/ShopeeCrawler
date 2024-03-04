<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shopee Demo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

<div class="container-fluid p-5 bg-primary text-white text-center">
    <a href="{{route('products.list')}}" style="text-decoration:none; color: white"><h1>Shop Demo</h1> </a>
    <p>Cart Info</p>
    <a href="{{route('logout')}}" style="text-decoration: none; color: white">Logout</a>
    <button type="button" class="btn btn-success">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"></path>
        </svg>
        Cart
    </button>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-sm-3"><a href="{{route('products.list')}}"><button class="btn btn-success">Product List Page</button></a></div>
        <div class="col-sm-3"> Shopping Cart</div>
        <div class="table-responsive cart_info">
            @if($cart)
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Item</td>
                            <td class="description">Name</td>
                            <td class="price">Price</td>
                            <td class="quantity">Quantity</td>
                            <td class="total">Total</td>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($cart->products as $item)
                        <tr>
                            <td class="cart_product col-sm-3">
                                <a href=""><img src="{{$item->image}}" class="col-sm-12" alt=""></a>
                            </td>
                            <td class="cart_description col-sm-3">
                                <h4>{{ $item->name }}</h4>
                                <p>Location: {{ $item->location }}</p>
                                <p>Sold amount: {{ $item->sold_amount }}</p>
                            </td>
                            <td class="cart_price col-sm-2">
                                <p>{{ number_format($item->price)}} VNĐ</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <form class="form-inline" method="POST" action="{{route("cart.post")}}">
                                        <input type="hidden" name="product_id" value="{{ $item->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="cart_quantity_up">+</button>
                                        <input class="cart_quantity_input" type="text" name="curretn_quantity" value="{{$item->pivot->quantity}}" autocomplete="off" size="2">
                                    </form>
                                    <form class="form-inline" method="POST" action="{{route("cart.post")}}">
                                        <input type="hidden" name="product_id" value="{{ $item->id }}">
                                        <input type="hidden" name="quantity" value="-1">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="cart_quantity_down">-</button>
                                    </form>
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">{{ number_format($item->price*$item->pivot->quantity)}} VNĐ</p>
                            </td>
                        </tr>
                    @endforeach
                        <tr>
                            <td class="cart_product cart_product col-sm-3">

                            </td>
                            <td class="cart_description col-sm-3">
                                <h4>Total</h4>
                            </td>
                            <td class="cart_price col-sm-2">

                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button"></div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">{{ number_format($cart->total)}} VNĐ</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            @else
                <p>You have no items in the shopping cart</p>
            @endif
        </div>
    </div>
</div>

</body>

</html>


<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Index of Product List Page
     * Accept parameter to search (product name and location, paginate, price range, sort
     * */
    public function list(Request $request)
    {
        $request->validate([

        ]);
        $search = $request->get('search');
        $limit = $request->get('limit', 6);
        $sortAndDir = $request->get('sort', '');
        $priceFrom = $request->get('from', 0);
        $priceTo = $request->get('to', PHP_INT_MAX);

        $query = Product::query();

        if ($sortAndDir)
        {
            $sortAndDir = explode(":", $sortAndDir);
            $sort = $sortAndDir[0];
            $dir = $sortAndDir[1];
            $query = $query->orderBy($sort, $dir);
        }

        if($search) {
            $query->where('name', 'like', '%'.$search.'%')
                ->orWhere('location', 'like', '%'.$search.'%');
        }

        if($priceFrom)
        {;
            $query->where('price', '>=', $priceFrom);
        }

        if($priceTo)
        {
            $query->where('price', '<=', $priceTo);
        }

        session()->flashInput($request->all());
        return view('product', [
            'products' => $query->paginate($limit)->appends($request->all())
        ]);
    }

    public function store(Request $request)
    {
        $rules = [

        ];

        $validator = Validator::make($request->all(), $rules);

        $name = $request->get('name');
        $price = $request->get('price');
        $soldAmount = $request->get('sold_amount', 5);
        $location = $request->get('is_master');
        $image = $request->get('image');
        if ($validator->fails()) {
            return response()
                ->json($validator->validate())
                ->header('Error', '404');
        }
        $product = new Product();
        $product->name = $name;
        $product->price = $price;
        $product->soldAmount = $soldAmount;
        $product->location = $location;
        $product->image = $image;
        $product->save();

        return $product;
    }
}

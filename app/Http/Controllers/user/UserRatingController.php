<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;

class UserRatingController extends Controller
{
    private $rating;
    private $product;
    public function __construct(Rating $rating, Product $product)
    {
        $this->rating = $rating;
        $this->product = $product;
    }

    public function saveRating(Request $request, $id)
    {
        if ($request->ajax()) {
            $this->rating->insert([
                'product_id' => $id,
                'number' => $request->number,
                'content' => $request->contents,
                'user_id' => auth()->user()->id,
            ]);
            $product =  $this->product->find($id);
            $product -> total_number += $request->number;
            $product -> total_rate += 1;
            $product->save();
            return response()->json(['code' => '200']);
        }
    }
}

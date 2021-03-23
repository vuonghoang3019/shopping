<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class AdminRatingController extends Controller
{
    private $rating;
    public function __construct(Rating $rating)
    {
        $this->rating = $rating;
    }
    public function index()
    {
        $ratings = $this->rating->newQuery()->with(['user','product'])->get();
        return view('admin.rating.index',compact('ratings'));
    }
}

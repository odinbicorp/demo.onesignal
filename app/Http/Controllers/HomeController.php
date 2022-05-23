<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;


class HomeController extends Controller
{
    // public function __construct()
    // {
    //     parent::__construct();
    // }

    public function index()
    {
        return view("homes/index", [
            "posts" => Post::orderBy("id", "desc")->get(),
        ]);
    }
}

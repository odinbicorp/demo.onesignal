<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // public function __construct()
    // {
    //     parent::__construct();
    // }

    public function index()
    {
        return view("admins/categories/index", [
            "categories" => Category::orderBy("id", "desc")->get(),
        ]);
    }

    public function create()
    {
        return view("admins/categories/create");
    }

    public function doCreate(Request $request)
    {
        $this->validate($request, [
            "name" => "required",
        ]);

        $category = $request->only(["name"]);

        Category::create($category);

        return redirect("/admin/categories")->with("message", "Create success");
    }
}

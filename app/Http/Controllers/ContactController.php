<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('contact.index', compact('categories'));
    }

    public function confirm(Request $request)
    {
        //
    }

    public function store(Request $request)
    {
        //
    }
}

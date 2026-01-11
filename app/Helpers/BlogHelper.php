<?php

namespace App\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\MetaHelper;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class BlogHelper {

    public static function index()
    {
        $blogs = Blog::where('is_active', 1)->latest()->paginate(6);
        $recentBlogs = Blog::where('is_active', 1)->latest()->take(5)->get();

        return view('blog', compact('blogs', 'recentBlogs'));
    }

    public static function detail(Request $request, $slug)
    {
        $blog = Blog::where('slug', $slug)->where('is_active', 1)->firstOrFail();
        $recentBlogs = Blog::where('is_active', 1)->latest()->take(5)->get();

        return view('blog-detail', compact('blog', 'recentBlogs'));
    }

}











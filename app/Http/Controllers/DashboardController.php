<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $totalArticles = Article::count();
        $myArticlesCount = $user ? Article::where('user_id', $user->id)->count() : 0;
        $recentArticles = $user
            ? Article::where('user_id', $user->id)->latest()->take(5)->get()
            : collect();

        return view('pages.dashboard', compact('user', 'totalArticles', 'myArticlesCount', 'recentArticles'));
    }
}
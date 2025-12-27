<?php

namespace App\Http\Controllers;

use App\getNews;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    use getNews;
    function getView() {
        return view('account.admin.news', ["newsList" => $this->get_all_news()]);
    }
}

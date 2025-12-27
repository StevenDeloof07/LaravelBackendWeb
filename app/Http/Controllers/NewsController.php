<?php

namespace App\Http\Controllers;

use App\getNews;
use App\Models\News;
use DateTime;
use Exception;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    use getNews;
    function getView() {
        return view('account.admin.news', ["newsList" => $this->get_all_news()]);
    }
    
    function addItem(Request $request) {
        try {
            $validated = $request->validate([
            'title' => "required|string",
            "profile_picture" => "required|image|mimes:jpeg,png,jpg",
            "content" => "required|string"
        ]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', "Niet alle waarden zijn correct ingevuld");
        }
        $path = "images/news/Server.jpg";

        if ($request["profile_picture"] != null) {
            $path = "/" .  $request->file("profile_picture")->store("/images/news", "public");
        }


        
        News::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'picture_link' => $path
        ]);

        return redirect()->back();
    }

    function remove($id) {
        News::where('id', $id)->delete();
        return redirect()->back();
    }
}

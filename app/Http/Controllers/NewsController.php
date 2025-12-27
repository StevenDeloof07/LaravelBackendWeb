<?php

namespace App\Http\Controllers;

use App\getNews;
use App\Models\News;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    function change(Request $request) {
        try {
            $validated = $request->validate([
                'id' => "required|integer|exists:news",
                'title' => "required|string",
                "content" => "required|string"
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', "niet alle waarden zijn correct ingevuld");
        }

        if ($request['profile_picture']) {
            $validated['picture_link'] = "/" .  $request->file("profile_picture")->store("/images/news", "public");
        }

        News::where('id', $validated['id'])->update($validated);
        return redirect()->back();
    }

    function remove($id) {
        $newsItem = News::where('id',  "=", $id)->first();
        $newsItem->delete();
        //check for default image, don't want to delete that
        if ($newsItem['picture_link'] != "/images/news/Server.jpg") Storage::delete($newsItem['picture_link']);
        return redirect()->back();
    }
}

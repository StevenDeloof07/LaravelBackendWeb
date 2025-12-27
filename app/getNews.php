<?php

namespace App;

use App\Models\News;

trait getNews
{
    public function get_all_news() {
        $newsItems = News::get();

        $newsList = [];

        foreach ($newsItems as $item) {
            array_push($newsList, [
                'title' => $item['title'],
                'picture_link' => $item['picture_link'],
                'content' => $item['content'],
                'publication' => $item['publication']
            ]); 
        }
        return $newsItems;
    }
}

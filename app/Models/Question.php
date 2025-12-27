<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Question extends Model
{
    /** @use HasFactory<\Database\Factories\QuestionFactory> */
    use HasFactory, Notifiable;
    //
    public function category() {
        return $this->hasOne(Category::class);
    }

    public static function getAll() {
        $questions = [];
        foreach (Question::get() as $question) {
            array_push($questions,[
                "id" => $question['id'],
                "question" => $question['question'],
                "anwser" => $question['anwser'],
                "category" => Category::get()->where('id', '=', $question['category_id'])->first()['name']
            ]);
        }
        return $questions;
    }
}

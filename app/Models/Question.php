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
        $data = [];

        $categories = Category::get();

        foreach ($categories as $category) {
            $name = $category['name'];
            $questions = [];
            $question_pull = Question::get()->where("category_id", '=', $category['id']);

            foreach ($question_pull as $question) {
                array_push($questions,[
                    "id" => $question['id'],
                    "question" => $question['question'],
                    "anwser" => $question['anwser']
                ]);
            }


            array_push($data, ['name' => $name, 'questions' => $questions]);
        }

        return $data;
    }
}

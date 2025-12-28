<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
use Exception;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    function index() {
        return view("users.FAQ", ['data' => Question::getAll()]);
    } 
    function manage() {
        return view('account.admin.FAQ', ['data' => Question::getAll()]);
    }

    function addQuestion(Request $request) {
        try {
            $validated = $request->validate([
                'question' => 'required|string',
                'anwser' => 'required|string',
                'category_id' => 'required|exists:categories,id'
            ]);
        } catch (Exception $e) {
            redirect()->back()->with('error', 'niet alle waardes zijn succesvol ingevuld');
        }

        Question::create($validated);

        return redirect()->back()->with("message", "Vraag aangemaakt!");
    }

    function changeQuestion(Request $request) {
        try {
            $validated = $request->validate([
                'id' => 'integer| exists:questions,id',
                'question' => 'required|string',
                'anwser' => 'required|string',
                'category_id' => "required|integer|exists:categories,id"
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', "Niet alle data is correct ingevuld");
        }

        Question::where('id', "=", $validated['id'])->update($validated);

        return redirect()->back();
    }

    function removeQuestion(Request $request) {
        try {
            $validated = $request->validate(['id' => 'required|exists:questions,id']);
        } catch(Exception $e) {
            return redirect()->back()->with("error", "Fout: vraag lijkt niet te bestaan. Contacteer de web beheerder voor meer info");
        }

        Question::where('id', '=', $validated['id'])->delete();
        return redirect()->back();
    }

    function addCategory(Request $request) {
        try  {
            $validated = $request->validate([
                'name' => "required|string"
            ]);
        }
        catch(Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
        Category::create($validated);
        return redirect()->back()->with("message", "Categorie aangemaakt!");

    }
}

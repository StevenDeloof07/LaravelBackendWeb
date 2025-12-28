<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
use Exception;
use Illuminate\Http\Request;
use App\validateRequest;
use function PHPUnit\Framework\returnArgument;

class QuestionController extends Controller
{
    use validateRequest;
    function index() {
        return view("users.FAQ", ['data' => Question::getAll()]);
    } 
    function manage() {
        return view('account.admin.FAQ', ['data' => Question::getAll()]);
    }

    function addQuestion(Request $request) {

        try {
            $validated = $this->validateRequest($request, [
                'question' => 'required|string',
                'anwser' => 'required|string',
                'category_id' => 'required|exists:categories,id'
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }

        Question::create($validated);

        return redirect()->back()->with("message", "Vraag aangemaakt!");
    }

    function changeQuestion(Request $request) {
        try {
            $validated = $this->validateRequest($request, [
                'id' => 'integer| exists:questions,id',
                'question' => 'required|string',
                'anwser' => 'required|string',
                'category_id' => "required|integer|exists:categories,id"
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }

        Question::where('id', "=", $validated['id'])->update($validated);

        return redirect()->back();
    }

    function removeQuestion(Request $request) {
        try {
            $validated = $this->validateRequest($request, ['id' => 'required|exists:questions,id']);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $$e->getMessage());
        }


        Question::where('id', '=', $validated['id'])->delete();
        return redirect()->back();
    }

    function addCategory(Request $request) {
        try  {
            $validated = $this->validateRequest($request, [
                'name' => "required|string"
            ]);
        }
        catch(Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
        Category::create($validated);
        return redirect()->back()->with("message", "Categorie aangemaakt!");

    }
    function changeCategory(Request $request) {
        try {
            $validated = $this->validateRequest($request, [
                'id' => 'integer|exists:categories,id',
                'new_name' => 'required|string|max:32'
            ]);
        } catch(Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
        Category::where('id' , '=', $validated['id'])->update(['name' => $validated['new_name']]);
        return redirect()->back();
    }

    function removeCategory(Request $request) {
        try {
            $validated = $this->validateRequest($request, ['id' => 'exists:categories,id']);
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
        Category::where("id", $validated['id'])->delete();
        return redirect()->back();
    }
}

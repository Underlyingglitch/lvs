<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {
        if ($request->user()->can('viewAny', Question::class)) {
            $questions = Question::all()
                        ->where('school_year_id', '=', SchoolYear::current()->id);
        } else if ($request->user()->can('viewOwn', Question::class)) {
            $published = Question::where([
                ['school_year_id', '=', SchoolYear::current()->id],
                ['published', '=', 1]
            ])->get();

            $questions = auth()->user()->questions
                        ->where('school_year_id', '=', SchoolYear::current()->id)
                        ->merge($published);
        } else {
            abort(403);
        }

        return view('questions.index', [
            'questions' => $questions
        ]);
    }

    public function create()
    {
        $this->authorize('create', Question::class);

        return view('questions.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Question::class);

        $question = new Question();
        
        $question->user_id = auth()->user()->id;

        $question->title = $request->title;
        $question->content = $request->content;
        $question->school_year_id = SchoolYear::current()->id;

        $question->save();

        return redirect()->route('questions.index');
    }

    public function show(Question $question)
    {
        $this->authorize('view', $question);

        return view('questions.show', [
            'question' => $question
        ]);
    }

    public function answer(Question $question, Request $request)
    {
        $this->authorize('create', Answer::class);

        $answer = new Answer();
        $answer->content = $request->content;
        $answer->question_id = $question->id;
        $answer->user_id = auth()->user()->id;

        $answer->save();

        return redirect()->back();
    }

    public function publish(Question $question)
    {
        $this->authorize('publish', Question::class);

        $question->published = !$question->published;

        $question->save();

        return redirect()->back();
    }

    public function delete_answer(Question $question)
    {
        $this->authorize('delete', Answer::class);

        if ($question->answer) {
            $question->answer->delete();
            $question->published = 0;
            $question->save();
        }

        return redirect()->back();
    }

    public function delete(Question $question)
    {
        $this->authorize('delete', Question::class);

        return view('questions.delete', [
            'question' => $question
        ]);
    }

    public function destroy(Question $question)
    {
        abort(404, 'Kan (nog) geen vragen verwijderen');
    }
}

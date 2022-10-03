<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('questions.view')) {
            $questions = Question::all();
        } else if (Gate::allows('questions.viewown')) {
            $questions = auth()->user()->questions->all();
        } else {
            abort(403);
        }

        return view('questions.index', [
            'questions' => $questions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('questions.add');

        return view('questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('questions.add');

        $question = new Question();
        
        if (auth()->user()->buddie != null) {
            $question->buddie_id = auth()->user()->id;
        } else {
            $question->leerling_id = auth()->user()->id;
        }

        $question->title = $request->title;
        $question->content = $request->content;

        $question->save();

        return redirect()->route('questions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Gate::denies('questions.view') && Gate::denies('questions.viewown')) {
            abort(403);
        }

        $question = Question::findOrFail($id);

        if (auth()->user()->buddie != null) {
            // User is buddie
            if (auth()->user()->buddie->id != $question->buddie_id) {
                // User's buddie id is not the buddie id of this question
                abort(403);
            }
        }
        if (auth()->user()->leerling != null) {
            // User is buddie
            if (auth()->user()->leerling->id != $question->leerling_id) {
                // User's buddie id is not the buddie id of this question
                abort(403);
            }
        }

        return view('questions.show', [
            'question' => $question
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

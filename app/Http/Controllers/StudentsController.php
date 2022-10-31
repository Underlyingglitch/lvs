<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class StudentsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        if (Gate::allows('students.view')) {
            $students = User::role('student')->get();
        } else if (Gate::allows('students.viewown')) {
            $students = auth()->user()->students;
        } else {
            abort(403);
        }

        // $students = Student::all();

        return view('students.index', [
            'students' => $students
        ]);
    }

    public function show($id)
    {
        // $this->authorize('students.view');
        //If not a teacher of a buddie
        abort_if((Gate::denies('students.view') && Gate::denies('students.viewown')), 403);

        $student = User::find($id);
        abort_if(($student->buddie->id != auth()->user()->id && Gate::denies('students.view')), 403);
        
        return view('students.show', [
            'student' => $student
        ]);
    }

    public function edit($id)
    {
        $this->authorize('students.edit');

        $student = User::find($id);

        return view('students.edit', [
            'student' => $student,
            'buddies' => User::role('buddie')->get()
        ]);
    }

    public function update($id, Request $request)
    {
        $this->authorize('students.edit');

        abort_unless($request->hasValidSignature(), 401);

        $student = User::find($id);

        $student->group = $request->group;
        $student->studentid = $request->studentid;
        $student->email = $request->email;
        $student->name = $request->name;

        if ($request->buddie != 'none') {
            $student->buddie_id = $request->buddie;
        } else {
            $student->buddie_id = null;
        }
        
        $student->save();

        return redirect()->route('students.show', ['id' => $id]);
    }

    public function delete($id)
    {
        $this->authorize('students.delete');

        $student = User::find($id);

        return view('students.delete', [
            'Student' => $student
        ]);
    }

    public function destroy($id)
    {
        $this->authorize('students.delete');

        $buddie = User::find($id);

        $buddie->delete();

        return redirect()->view('students.index');
    }
}

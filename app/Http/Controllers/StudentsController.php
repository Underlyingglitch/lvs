<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {
        if ($request->user()->can('viewAny', User::class)) {
            $students = User::role('student')->get();
        } else if ($request->user()->can('viewOwn', User::class)) {
            $students = auth()->user()->students;
        } else {
            abort(403);
        }

        return view('students.index', [
            'students' => $students
        ]);
    }

    public function show(User $student)
    {
        $this->authorize('view', $student);

        if ($student->get_role() != 'student') abort(404);
        
        return view('students.show', [
            'student' => $student
        ]);
    }

    public function edit(User $student)
    {
        $this->authorize('update', $student);

        return view('students.edit', [
            'student' => $student,
            'buddies' => User::role('buddie')->get()
        ]);
    }

    public function update(User $student, Request $request)
    {
        abort_unless($request->hasValidSignature(), 401);
        $this->authorize('update', $student);

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

        return redirect()->route('students.show', ['student' => $student->id]);
    }

    public function delete(User $student)
    {
        $this->authorize('delete', $student);

        return view('students.delete', [
            'student' => $student
        ]);
    }

    public function destroy(User $student)
    {
        $this->authorize('delete', $student);

        $student->delete();

        return redirect()->view('students.index');
    }
}

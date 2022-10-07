<?php

namespace App\Http\Controllers;

use Cache;
use Carbon\Carbon;
use App\Models\Buddie;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class studentsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        if (Gate::allows('students.view')) {
            $students = Student::all();
        } else if (Gate::allows('students.viewown')) {
            $students = auth()->user()->buddie->students;
        } else {
            abort(403);
        }

        $students = Student::all();

        return view('students.index', [
            'students' => $students
        ]);
    }

    public function show($id)
    {
        // $this->authorize('students.view');
        //If not a teacher of a buddie
        abort_if((Gate::denies('students.view') && Gate::denies('students.viewown')), 403);
        
        $student = Student::find($id);
        abort_if($student->buddie->user->id != auth()->user()->id, 403);
        
        return view('students.show', [
            'student' => $student
        ]);
    }

    public function edit($id)
    {
        $this->authorize('students.edit');

        $student = Student::find($id);

        return view('students.edit', [
            'student' => $student,
            'buddies' => Buddie::all()
        ]);
    }

    public function update($id, Request $request)
    {
        $this->authorize('students.edit');

        abort_unless($request->hasValidSignature(), 401);

        $student = Student::find($id);

        $student->klas = $request->klas;
        $student->leerlingnummer = $request->leerlingnummer;
        $student->user->email = $request->email;
        $student->user->name = $request->name;

        if ($request->buddie != 'none') {
            $student->buddie_id = $request->buddie;
        } else {
            $student->buddie_id = null;
        }
        
        $student->user->save();
        $student->save();

        return redirect()->route('students.show', ['id' => $id]);
    }

    public function delete($id)
    {
        $this->authorize('students.delete');

        $student = Student::find($id);

        return view('students.delete', [
            'Student' => $student
        ]);
    }

    public function destroy($id)
    {
        $this->authorize('students.delete');

        $buddie = Student::find($id);

        $buddie->delete();

        return redirect()->view('students.index');
    }
}

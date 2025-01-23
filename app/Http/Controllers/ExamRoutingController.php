<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamRouting;
use App\Models\MyClass;
use App\Models\StudentRecord;
use App\Models\Subject;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamRoutingController extends Controller
{
    public function index(Request $request)
    {
        $update = null;
        $eid = $request->eid;
        $myClass = MyClass::select('id', 'name')->get();
        $items = ExamRouting::with(['myClass', 'subject'])->get();
        if ($eid) {
            $update = ExamRouting::find($eid);
        }
        return view('pages.support_team.exams.examRouting', compact('myClass', 'items', 'update'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'semester' => 'required',
            'class_id' => 'required',
            'subject_id' => 'required',
            'exam_date' => 'required',
            'exam_time' => 'required',
        ]);

        $exists = DB::table('exam_routings')
        ->where('class_id', $request->class_id)
        ->where('subject_id', $request->subject_id)
        ->exists();

        if ($exists) {
            return redirect()->back()->withErrors(['class_id' => 'The combination of class and subject already exists.'])->withInput();
        }

        ExamRouting::insert([
            'semester' => $request->semester,
            'class_id' => $request->class_id,
            'subject_id' => $request->subject_id,
            'exam_date' => Carbon::createFromFormat('m/d/Y', $request->exam_date)->format('Y-m-d'),
            'exam_time' => $request->exam_time,
            'created_at' => Carbon::now(),
        ]);
        return redirect()->back()->with('success', 'Exam routing added successfully');
    }

    public function update(Request $request)
    {
        ExamRouting::find($request->id)->update([
            'exam_date' => Carbon::createFromFormat('m/d/Y', $request->exam_date)->format('Y-m-d'),
            'exam_time' => $request->exam_time,
        ]);
        return redirect()->route('admin.exams.routing.index')->with('success', 'Exam routing updated successfully');
    }

    public function trash(Request $request)
    {
        $examRouting = ExamRouting::find($request->did);
        if(!$examRouting) {
            return redirect()->back()->withErrors(['class_id' => 'Exam routing not found.']);
        }
        $examRouting->delete();

        return redirect()->back()->with('success', 'Exam routing deleted successfully');
    }


    public function routing()
    {
        $student = StudentRecord::where('user_id', Auth::id())->first();
        if(empty($student))
            $student = StudentRecord::find(Auth::user()->student_id)->first();

        $items = ExamRouting::with('subject', 'myClass')->where('class_id', $student->my_class_id)->get();
        return view('pages.support_team.exams.studentRouting', compact('items'));
    }

}

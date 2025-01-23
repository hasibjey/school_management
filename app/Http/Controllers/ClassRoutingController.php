<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Custom\Student;
use App\Models\ClassRouting;
use App\Models\MyClass;
use App\Models\StudentRecord;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClassRoutingController extends Controller
{
    public function index(Request $request)
    {
        $update = null;
        $eid = $request->eid;
        $myClass = MyClass::select('id', 'name')->get();
        $items = ClassRouting::with(['myClass', 'Subject'])->select('id', 'class_day', 'class_id', 'subject_id', 'class_time')->get();

        if (isset($eid)) {
            $update = ClassRouting::find($eid);
        }

        return view('pages.support_team.classes.classRouting', compact('myClass', 'items', 'update'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_day' => 'required',
            'class_id' => 'required',
            'subject_id' => 'required',
            'class_time' => 'required'
        ]);

        ClassRouting::insert([
            'class_day' => $request->class_day,
            'class_id' => $request->class_id,
            'subject_id' => $request->subject_id,
            'class_time' => $request->class_time,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Class routing added successfully');
    }

    public function update(Request $request)
    {
        ClassRouting::find($request->id)->update([
            'class_day' => $request->class_day,
            'class_time' => $request->class_time,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('admin.class.routing.index')->with('success', 'Exam routing updated successfully');
    }

    public function trash(Request $request)
    {
        ClassRouting::where('id', $request->did)->delete();
        return redirect()->back()->with('success', 'Class routing deleted successfully');
    }

    public function routing()
    {
        $student = StudentRecord::where('user_id', auth()->id())->first();
        if (empty($student))
            $student = StudentRecord::find(Auth::user()->student_id)->first();

        $items = ClassRouting::with(['myClass', 'Subject'])
            ->where('class_id', $student->my_class_id)
            ->select('id', 'class_day', 'class_id', 'subject_id', 'class_time')
            ->orderBy('class_day')
            ->get()
            ->groupBy('class_day');
        return view('pages.support_team.classes.studentRouting', compact('items'));
    }


}

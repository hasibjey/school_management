<?php

namespace App\Http\Controllers\MyParent;
use App\Http\Controllers\Controller;
use App\Models\GuardianInfo;
use App\Repositories\StudentRepo;
use App\User;
use Illuminate\Support\Facades\Auth;

class MyController extends Controller
{
    protected $student;
    public function __construct(StudentRepo $student)
    {
        $this->student = $student;
    }

    public function children()
    {
        $student = User::with(['Student.User', 'Student.guardian_info'])->find(Auth::id());

        return view('pages.parent.children', compact('student'));
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScoreController extends Controller
{
    // list down all the class
    public function list() {
        $teacher_classes = SchoolClass::all();
        $assigned_class = null;
        $assigned_class_id = Teacher::where("user_id", Auth::id())->first()->assigned_class;
        if($assigned_class_id) {
            $assigned_class = SchoolClass::find($assigned_class_id);
        }

        return view("pages.ManageScore.class_list")->with(["teacher_classes" => $teacher_classes, "assigned_class"=>$assigned_class]);
    }

    public function list_score(int $class_id) {
        $school_class = SchoolClass::find($class_id);
        $students = Student::where('school_class', $class_id)->get();

        return view("pages.ManageScore.student_score_list")->with(["school_class"=>$school_class, "students"=>$students]);
    }

    public function delete_score(int $class_id) {
        $school_class = SchoolClass::find($class_id);
        $students = Student::where('school_class', $class_id)->get();
        return view("pages.ManageScore.student_score_delete")->with(["school_class"=>$school_class, "students"=>$students]);
    }

    public function view_generate_score(int $class_id) {
        $students = Student::where("school_class", $class_id)->get();
        return view("pages.ManageScore.student_report_view_generate")->with(["students"=>$students]);
    }

    public function view_report(int $student_id, bool $generate) {
        $student = Student::where("id", $student_id)->first();
        return view("pages.ManageScore.student_report_view")->with(["student"=>$student, "generate"=>$generate]);
    }


}

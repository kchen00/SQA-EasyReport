<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ScoreController extends Controller
{
    // list down all the class
    public function list() {
        $subject_class_pivot = DB::table("class_subject_teacher")->where("user_id", Auth::user()->id)->get();
        $subject_classes = [];

        foreach($subject_class_pivot as $subject_class) {
            array_push($subject_classes, SchoolClass::find($subject_class->schoolclass_id));
        }

        $class_teacher_class = SchoolClass::where("class_teacher", Auth::user()->id)->first();

        return view("pages.ManageScore.class_list")->with(["subject_classes" => $subject_classes, "class_teacher_class"=>$class_teacher_class]);
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

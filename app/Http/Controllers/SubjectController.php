<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Database\Seeders\SubjectsSeeder;

class SubjectController extends Controller
{
    public function list()
    {
        $items = DB::table("class_subject_teacher")->paginate(5);
        $subject_teacher = [];

        foreach($items as $item) {
            $teacher = User::find($item->user_id);
            $subject = Subject::find($item->subject_id);
            $school_class = SchoolClass::find($item->schoolclass_id);
            array_push($subject_teacher, ["teacher"=>$teacher, "subject"=>$subject, "schoolclass"=>$school_class]);
        }

        return view('pages.ManageSubject.subject_list')->with(["subject_teacher"=>$subject_teacher, "items"=>$items]);
    }

    public function search(Request $request)
    {
        $subjects = Subject::where("name", "LIKE", "%{$request->subject_search}%")->pluck('id');
        $items = DB::table("class_subject_teacher")->whereIn('subject_id', $subjects)->paginate(5);
        $subject_teacher = [];

        foreach($items as $item) {
            $teacher = User::find($item->user_id);
            $subject = Subject::find($item->subject_id);
            $school_class = SchoolClass::find($item->schoolclass_id);
            array_push($subject_teacher, ["teacher"=>$teacher, "subject"=>$subject, "schoolclass"=>$school_class]);
        }

        return view('pages.ManageSubject.subject_list')->with(["subject_teacher"=>$subject_teacher, "items"=>$items]);
    }

    public function add()
    {
        $teachers = User::where("role", User::ROLE_TEACHER)->get();
        $schoolclass = SchoolClass::all();
        $subjects = Subject::all();
        return view('pages.ManageSubject.subject_add')->with(["teachers"=>$teachers, "schoolclass"=>$schoolclass, "subjects"=>$subjects]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'teacher' => 'required',
            'schoolclass' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $subject = Subject::firstOrCreate(
            ['name' => $request->input('name')]
        );

        DB::table("class_subject_teacher")->insert([
            "user_id" => $request->input('teacher'),
            "subject_id" => $subject->id,
            "schoolclass_id" =>  $request->input('schoolclass'),
            "updated_at" => Carbon::now(),
            "created_at" => Carbon::now()
        ]);


        return redirect()->route('subject.add')->with('register_success', "Subject " . $subject->name . ' registered successfully.');
    }

    public function view(int $subject_id, int $teacher_id, int $class_id)
    {
        $query = DB::table('class_subject_teacher')->where([
            "subject_id" => $subject_id,
            "user_id" => $teacher_id,
            "schoolclass_id" => $class_id
        ])->get()->first();


        $record = [
            "subject" => Subject::find($query->subject_id),
            "teacher" => User::find($query->user_id),
            "assigned_class" => SchoolClass::find($query->schoolclass_id),
        ];

        $teachers = User::where("role", User::ROLE_TEACHER)->get();
        $schoolclass = SchoolClass::all();
        if ($record) {
            return view('pages.ManageSubject.subject_view')->with(["record"=>$record, "teachers"=>$teachers, "schoolclass"=>$schoolclass]);
        }
        abort(404, "subject not found");
    }

    public function update_store(Request $request, int $teacher_id, int $subject_id, int $class_id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'teacher' => 'required',
            'schoolclass' => 'required',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // find the subject to update
        // Update the subject name
        $subject = Subject::find($subject_id);
        $subject->name = $request->input('name');
        $subject->save();

        $update = DB::table("class_subject_teacher")->where([
            "user_id" => $teacher_id,
            "subject_id" => $subject->id,
            "schoolclass_id" => $class_id
        ])->update([
            'user_id' => $request->input('teacher'),
            'schoolclass_id' => $request->input('schoolclass')
        ]);

        return redirect()->route('subject.view', ['subject_id' => $subject_id, "teacher_id"=>$request->input("teacher"), "class_id"=>$request->input("schoolclass")])->with('edit_success', 'Subject updated successfully.');
    }

    public function destroy(int $subject_id)
    {
        $subject = Subject::findOrFail($subject_id);
        if($subject) {
            $subject_name = $subject->name;
            $subject->delete();

            // Redirect to a success page or route
            return redirect()->route('subject.list')->with('delete_success', "Subject" . $subject_name . ' deleted successfully.');

        }
    }
}

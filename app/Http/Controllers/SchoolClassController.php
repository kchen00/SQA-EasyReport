<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class SchoolClassController extends Controller
{
    public function list()
    {
        $classes = SchoolClass::paginate(10);
        return view('pages.ManageClass.class_list')->with('classes', $classes);
    }

    public function search(Request $request)
    {
        $classes = SchoolClass::where("name", "LIKE", "%{$request->class_name}%")->paginate(10);
        return view('pages.ManageClass.class_list')->with('classes', $classes);
    }

    public function view(int $class_id)
    {
        // Retrieve the class record from the database
        $class = SchoolClass::find($class_id);
        // Check if the student record exists
        if ($class) {
            // class record found, return the view with the student data
            $class_teacher = User::find($class->class_teacher);
            $subjects = Subject::all();
            $subjects_offered = [];
            foreach ($class->subjects as $offered_subject) {
                array_push($subjects_offered, $offered_subject->id);
            }
            return view('pages.ManageClass.class_view')->with(["school_class" => $class, "class_teacher" => $class_teacher, "subjects" => $subjects, "subjects_offered" => $subjects_offered]);
        }
        abort(404, "class not found");
    }

    public function update(int $class_id)
    {
        // Retrieve the class record from the database
        $class = SchoolClass::find($class_id);

        // Check if the student record exists
        if ($class) {
            // class record found, return the view with the student data
            $subjects = Subject::all();
            $subjects_offered = [];
            $teachers = User::where("role", User::ROLE_TEACHER)->get();
            foreach ($class->subjects as $offered_subject) {
                array_push($subjects_offered, $offered_subject->id);
            }
            return view('pages.ManageClass.class_update')->with(["school_class" => $class, "subjects" => $subjects, "subjects_offered" => $subjects_offered, "teachers" => $teachers]);
        }
        abort(404, "class not found");
    }

    public function add()
    {
        $subjects = Subject::all();
        $teachers = User::where("role", User::ROLE_TEACHER)->get();
        return view('pages.ManageClass.class_add')->with(["subjects" => $subjects, "teachers" => $teachers]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:school_classes,name',
            'capacity' => 'required|integer|min:20|max:30',
            'class_teacher' => 'required',
            'subject_offered' => 'required|array|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create a new student instance and save to database
        $school_class = new SchoolClass();
        $school_class->name = $request->input('name');
        $school_class->capacity = $request->input('capacity');
        $school_class->class_teacher = $request->input('class_teacher');
        $school_class->save();

        $school_class->subjects()->attach($request->input('subject_offered'), ['created_at' => Carbon::now(),'updated_at' => Carbon::now()]);

        return redirect()->route('school_class.add')->with('register_success', 'Class ' . $school_class->name . ' added successfully.');
    }

    public function update_store(Request $request, int $class_id)
    {
        // find the class to update
        $school_class = SchoolClass::find($class_id);

        $validator = Validator::make($request->all(), [
            'name' => 'required', Rule::unique("school_classes")->ignore($school_class->name),
            'capacity' => 'required|integer|min:20|max:30',
            'class_teacher' => 'required',
            'subject_offered' => 'required',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update the class information
        $school_class->name = $request->input('name');
        $school_class->capacity = $request->input('capacity');
        $school_class->class_teacher = $request->input('class_teacher');
        $school_class->subjects()->sync($request->input('subject_offered'), ['created_at' => Carbon::now(),'updated_at' => Carbon::now()]);
        $school_class->save();


        return redirect()->route('school_class.update', ['class_id' => $class_id])->with('update_success', 'Class updated successfully.');
    }

    public function destroy(int $student_id)
    {
        $school_class = SchoolClass::findOrFail($student_id);
        $school_class->delete();

        // Redirect to a success page or route
        return redirect()->route('school_class.list')->with('delete_success', 'Class deleted successfully.');
    }
}

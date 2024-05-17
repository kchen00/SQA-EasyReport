<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\Subjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SchoolClassController extends Controller
{
    public function list()
    {
        $classes = SchoolClass::paginate(10);
        return view('pages.ManageClass.class_list')->with('classes', $classes);
    }

    public function view(int $class_id)
    {
        // Retrieve the class record from the database
        $class = SchoolClass::find($class_id);

        // Check if the student record exists
        if ($class) {
            // class record found, return the view with the student data
            return view('pages.ManageClass.class_view')->with("school_class", $class);
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
            return view('pages.ManageClass.class_update')->with("school_class", $class);
        }
        abort(404, "class not found");
    }

    public function add()
    {
        $subjects = Subjects::all();
        return view('pages.ManageClass.class_add')->with("subjects", $subjects);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:school_classes,name',
            'capacity' => 'required|integer|min:20|max:30',
            'class_teacher' => 'required|string',
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
        $school_class->subject_offered = $request->input('subject_offered')[0];
        $school_class->save();


        return redirect()->route('school_class.add')->with('register_success', 'Class added successfully.');
    }

    public function update_store(Request $request, int $class_id)
    {
        // find the class to update
        $school_class = SchoolClass::find($class_id);

        $validator = Validator::make($request->all(), [
            'name' => 'required', Rule::unique("school_classes")->ignore($school_class->name),
            'capacity' => 'required|integer|min:20|max:30',
            'class_teacher' => 'required|string',
            'subject_offered' => 'required|string',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update the class information
        $school_class->name = $request->input('name');
        $school_class->capacity = $request->input('capacity');
        $school_class->class_teacher = $request->input('class_teacher');
        $school_class->subject_offered = $request->input('subject_offered');
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

<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function list()
    {
        $students = Student::paginate(10);
        return view('pages.ManageAccount.student_list')->with('students', $students);
    }

    public function view(int $student_id)
    {
        // Retrieve the student record from the database
        $student = Student::find($student_id);

        // Check if the student record exists
        if ($student) {
            // Student record found, return the view with the student data
            return view('pages.ManageAccount.student_view')->with("student", $student);
        }
        abort(404, "Student not found");
    }

    public function add()
    {
        return view('pages.ManageAccount.student_add');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'birth' => 'required|date',
            'contact' => 'required|string|max:12',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create a new student instance and save to database
        $student = new Student();
        $student->name = $request->input('name');
        $student->gender = $request->input('gender');
        $student->date_of_birth = $request->input('birth');
        $student->contact_information = $request->input('contact');
        $student->save();


        return redirect()->route('student.add')->with('register_success', 'Student added successfully.');
    }

    public function destroy(int $student_id)
    {
        $student = Student::findOrFail($student_id);
        $student->delete();

        // Redirect to a success page or route
        return redirect()->route('student.list')->with('delete_success', 'Record deleted successfully.');
    }
}

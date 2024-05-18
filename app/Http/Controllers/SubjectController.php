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

class SubjectController extends Controller
{
    public function list()
    {
        $items = DB::table("subject_teacher")->paginate(5);
        $subject_teacher = [];

        foreach($items as $item) {
            $teacher = User::find($item->user_id);
            $subject = Subject::find($item->subject_id);
            array_push($subject_teacher, ["teacher"=>$teacher, "subject"=>$subject]);
        }

        return view('pages.ManageSubject.subject_list')->with(["subject_teacher"=>$subject_teacher, "items"=>$items]);
    }

    public function add()
    {
        $teachers = User::where("role", User::ROLE_TEACHER)->get();
        return view('pages.ManageSubject.subject_add')->with(["teachers"=>$teachers]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'teacher' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create a new student instance and save to database
        $subject = new Subject();
        $subject->name = $request->input('name');
        $subject->save();

        $subject->teachers()->attach(["teacher_id"=>$request->input('teacher')], ['subject_id' => $subject->id, 'created_at' => Carbon::now(),'updated_at' => Carbon::now()]);


        return redirect()->route('subject.add')->with('register_success', "Subject " . $subject->name . ' registered successfully.');
    }

    public function view(int $subject_id)
    {
        // Retrieve the student record from the database
        $subject = Subject::find($subject_id);
        $teachers = User::where("role", User::ROLE_TEACHER)->get();

        // Check if the subject record exists
        if ($subject) {
            return view('pages.ManageSubject.subject_view')->with(["subject"=>$subject, "teachers"=>$teachers]);
        }
        abort(404, "subject not found");
    }

    public function update_store(Request $request, int $subject_id)
    {
        // find the subject to update
        $subject = Subject::find($subject_id);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'teacher' => 'required',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update the class information
        $subject->name = $request->input('name');
        $subject->teachers()->sync($request->input("teacher"));
        $subject->save();


        return redirect()->route('subject.view', ['subject_id' => $subject_id])->with('edit_success', 'Subject updated successfully.');
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

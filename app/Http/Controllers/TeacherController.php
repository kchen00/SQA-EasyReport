<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{

    public function teacherlist() {
        $teachers = User::where('role', 'teacher')->paginate(10);

        return view('pages.ManageTeacher.Admin.teacher_list', compact('teachers'));
    }

    public function viewteacher($id) {
        $teacher = User::findOrFail($id);
        return view('pages.ManageTeacher.Admin.view_teacher', compact('teacher'));
    }

    public function addteacher() {
        return view('pages.ManageTeacher.Admin.add_teacher');
    }

    public function profile() {
        $id = Auth::id();

        $teacher = User::findOrFail($id);
        return view('pages.ManageTeacher.Teacher.profile', compact('teacher'));
    }

    public function registerTeacher(Request $request) {

        $request->validate([
            'name' => 'required|string|max:100',
            'ic' => 'required|string|size:12',
            'email' => 'required|string|email|max:100|unique:users,email',
            'password' => 'required|string|min:8',
            'age' => 'required|numeric',
            'contact' => 'required|string|max:15',
            'gender' => 'required|string|in:Men,Women',
            'address' => 'required|string|max:150',
        ]);

        $teacher = User::create([
            'name' => $request->name,
            'ic' => $request->ic,
            'age' => $request->age,
            'address' => $request->address,
            'contact' => $request->contact,
            'gender' => $request->gender,
            'email' => $request->email,
            'password' => $request->password,
            'role' => User::ROLE_TEACHER,
        ]);

        $teacher->save();

        return redirect()->route('addteacher')->with('registration_success', true);
    }

    public function profileUpdate(Request $request, $id) {
        $teacher = User::findOrFail($id);
    
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'ic' => 'required|string|size:12',
            'email' => 'required|string|email|max:100|unique:users,email,' . $teacher->id,
            'age' => 'required|integer',
            'contact' => 'required|string|max:15',
            'gender' => 'required|string|in:Men,Women',
            'address' => 'required|string|max:150',

            'new_password' => 'nullable|string|min:8',
            'confirm_password' => 'nullable|string|min:8|same:new_password',
        ]);

        if ($request->filled('new_password')) {
            $teacher->password = $validated['new_password'];
        }
    
        $teacher->update([
            'name' => $validated['name'],
            'ic' => $validated['ic'],
            'email' => $validated['email'],
            'age' => (int) $validated['age'],
            'contact' => $validated['contact'],
            'gender' => $validated['gender'],
            'address' => $validated['address'],
        ]);
    
        return redirect()->route('profile')->with('update_success', true);
    }

    public function searchName(Request $request) {
        $request->validate([
            'search_name' => 'required|string|max:100',
        ]);

        $teachers = User::where('role', 'teacher')->where('name', 'LIKE', '%' . $request->search_name . '%')->paginate(10);

        if ($teachers->isNotEmpty()) {
            return view('pages.ManageTeacher.Admin.teacher_list', compact('teachers'));
        } else {
            return $this->teacherlist();
        }
    }
    

    public function deleteTeacher($id) {
        $teacher = User::findOrFail($id);
        $teacher->delete();

        return redirect()->route('allteacher')->with('delete_success', true);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\Score;
use App\Models\Student;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isNull;

class ScoreController extends Controller
{
    private $grades = [
        [
            "grade" => "A",
            "lower_bound" => 80,
            "upper_bound" => 100
        ],
        [
            "grade" => "A-",
            "lower_bound" => 75,
            "upper_bound" => 79
        ],
        [
            "grade" => "B+",
            "lower_bound" => 70,
            "upper_bound" => 74
        ],
        [
            "grade" => "B",
            "lower_bound" => 65,
            "upper_bound" => 69
        ],
        [
            "grade" => "B-",
            "lower_bound" => 60,
            "upper_bound" => 64
        ],
        [
            "grade" => "C+",
            "lower_bound" => 55,
            "upper_bound" => 59
        ],
        [
            "grade" => "C",
            "lower_bound" => 50,
            "upper_bound" => 54
        ],
        [
            "grade" => "C-",
            "lower_bound" => 45,
            "upper_bound" => 49
        ],
        [
            "grade" => "D+",
            "lower_bound" => 40,
            "upper_bound" => 44
        ],
        [
            "grade" => "D",
            "lower_bound" => 35,
            "upper_bound" => 39
        ],
        [
            "grade" => "E",
            "lower_bound" => 0,
            "upper_bound" => 34
        ],
        [
            "grade" => "F",
            "lower_bound" => 0,
            "upper_bound" => 0
        ]
    ];

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
        $subject_id = DB::table("class_subject_teacher")->where([
            "user_id" => Auth::user()->id,
            "schoolclass_id" => $class_id,
        ])->first()->subject_id;
        $scores = [];

        foreach($students as $student) {
            array_push($scores, [
                "student" => Student::find($student->id),
                "score" => Score::where([
                    "student_id" => $student->id,
                    "subject_id" => $subject_id
                ])->first()
            ]);
        };

        return view("pages.ManageScore.student_score_list")->with(["school_class"=>$school_class, "scores"=>$scores, "subject_id"=>$subject_id]);
    }

    public function store_score(Request $request, int $class_id, int $subject_id) {
        $messages = [
            'students.*.score.required' => 'The score must be provided.',
            'students.*.score.integer' => 'The score must be an integer.',
            'students.*.score.min' => 'The score must be at least 0.',
            'students.*.score.max' => 'The score must be at most 100.',
        ];

        $validator = Validator::make($request->all(), [
            'students.*.score' => 'required|integer|min:0|max:100',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        foreach($request->input("students") as $student) {
            Score::updateOrCreate(
                ["student_id" => $student["id"],
                "subject_id" => $subject_id],
                ["student_id" => $student["id"],
                "subject_id" => $subject_id,
                "score" => $student["score"],
                "full_marks" => 100]);
        };

        return redirect()->route("score.student.list", ["class_id"=>$class_id])->with("score_save_success", "Score saved successfully");
    }

    public function delete_score(int $class_id) {
        $school_class = SchoolClass::find($class_id);
        $students = Student::where('school_class', $class_id)->get();
        $subject_id = DB::table("class_subject_teacher")->where([
            "user_id" => Auth::user()->id,
            "schoolclass_id" => $class_id,
        ])->first()->subject_id;

        $scores = [];

        foreach($students as $student) {
            $score = Score::where([
                "student_id" => $student->id,
                "subject_id" => $subject_id,
            ])->whereNotNull('score')->first();

            if($score) {
                array_push($scores, [
                    "student" => Student::find($student->id),
                    "score" => $score,
                ]);

            }
        };
        return view("pages.ManageScore.student_score_delete")->with(["school_class"=>$school_class, "scores"=>$scores]);
    }

    public function delete_score_store(Request $request, int $class_id) {
        $subject_id = DB::table("class_subject_teacher")->where([
            "user_id" => Auth::user()->id,
            "schoolclass_id" => $class_id,
        ])->first()->subject_id;

        foreach($request["students"] as $student) {
            if(is_null($student["score"])) {
                Score::where([
                    "student_id" => $student["id"],
                    "subject_id" => $subject_id
                ])->delete();
            }
        }

        return redirect()->route("score.student.delete", ["class_id" => $class_id])->with("score_save_success", "delete success");
    }

    public function view_students(int $class_id) {
        $students = Student::where("school_class", $class_id)->get();
        return view("pages.ManageScore.student_report_view_generate")->with(["students"=>$students]);
    }

    public function view_report(int $student_id) {
        $scores = Score::where([
            "student_id"=>$student_id
        ])->get();

        $report = [
            "student" => Student::find($student_id),
            "scores" => [],
        ];
        foreach($scores as $score) {
            array_push($report["scores"], [
                "subject" => Subject::find($score->subject_id),
                "score" => $score
            ]);
        };

        return view("pages.ManageScore.student_report_view")->with(["report"=>$report]);
    }

    public function view_report_overall(int $student_id) {
        $total_score = 0;
        $scores = Score::where([
            "student_id"=>$student_id
        ])->get();

        $report = [
            "student" => Student::find($student_id),
            "scores" => [],
        ];

        foreach($scores as $score) {
            $total_score += $score->score;
            array_push($report["scores"], [
                "subject" => Subject::find($score->subject_id),
                "score" => $score,
                "grade" => $this->get_grade($score->score)
            ]);
        };

        $average_score = 0;
        if (count($scores) > 0) {
           $average_score = $total_score / count($scores);
        }

        $average_grade = $this->get_grade($average_score);
        return view("pages.ManageScore.student_report_overall")->with(["report"=>$report, "average_grade"=>$average_grade]);
    }

    private function get_grade($score) {
        foreach ($this->grades as $grade) {
            if ($score >= $grade['lower_bound'] && $score <= $grade['upper_bound']) {
                return $grade['grade'];
            }
        }
        return 'N/A'; // If no grade is found for the given score
    }

}

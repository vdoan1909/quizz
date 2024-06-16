<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Subject;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    const PATH_VIEW = "admin.exam.";
    const PATH_UPLOAD = "exams";

    public function index()
    {
        $data = Exam::latest("id")->with("subject")->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact("data"));
    }

    public function create()
    {
        $subjects = Subject::get();
        return view(self::PATH_VIEW . __FUNCTION__, compact("subjects"));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $request->validate(
            [
                "name" => "required|unique:exams,name",
                "time_limit" => "required|numeric",
                "number_of_questions" => "required|numeric",
                "subject_id" => "required",
                "description" => "required"
            ]
        );

        $is_create = Exam::create($data);

        if ($is_create) {
            return redirect()->route("admin.exams.index")->with("success", "Create a new exam successfully");
        } else {
            return redirect()->route("admin.exams.index")->with("error", "Create a new exam failed");
        }
    }

    public function edit(Exam $exam)
    {
        $subjects = Subject::get();
        return view(self::PATH_VIEW . __FUNCTION__, compact("exam", "subjects"));
    }

    public function update(Request $request, Exam $exam)
    {
        $data = $request->all();

        $request->validate(
            [
                "name" => "required|unique:exams,name," . $exam->id,
                "time_limit" => "required|numeric",
                "number_of_questions" => "required|numeric",
                "subject_id" => "required",
                "description" => "required"
            ]
        );

        $exam->update($data);

        return redirect()->route("admin.exams.index")->with("success", "Edit exam successfully");
    }

    public function destroy(Exam $exam)
    {
        $exam->delete();    

        return redirect()->route("admin.exams.index")->with("success", "Delete exam successfully");
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\QuestionImport;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class QuestionController extends Controller
{
    const PATH_VIEW = "admin.question.";
    const PATH_UPLOAD = "question";

    public function index()
    {
        $data = Question::latest("id")->with("exam")->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact("data"));
    }

    public function import()
    {
        $exams = Exam::get();
        return view(self::PATH_VIEW . __FUNCTION__, compact("exams"));
    }

    public function file(Request $request)
    {
        $request->validate([
            "exam_id" => "required",
            "import_file" => ["required", "file"]
        ]);

        $exam_id = $request->exam_id;
        Excel::import(new QuestionImport($exam_id), $request->file('import_file'));

        return redirect()->route("admin.questions.index")->with("success", "Import data question successfully");
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}

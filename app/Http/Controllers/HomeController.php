<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Exam;
use App\Models\UserSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->name) {
            $subjects = Subject::where("name", "like", "%" . $request->name . "%")->get();
        } else {
            $subjects = Subject::latest("id")->take(6)->get();
        }
        $count_res = UserSubject::selectRaw('subject_id, COUNT(user_id) as total')
            ->groupBy('subject_id')
            ->get();
        return view('client.index', compact("subjects", "count_res"));
    }

    public function menu(Request $request)
    {
        if ($request->name) {
            $subjects = Subject::where("name", "like", "%" . $request->name . "%")->get();
        } else {
            $subjects = Subject::latest("id")->get();
        }
        return view('client.subject.list', compact("subjects"));
    }

    public function exams(Request $request)
    {
        $id_user = null;
        $get_user_subject = null;

        if (Auth::Check()) {
            $id_user = Auth::User()->id;
        }

        $subjects = Subject::latest("id")->get();

        if ($request->name) {
            $exams = Exam::where("name", "like", "%" . $request->name . "%")->with("subject")->get();
        } else {
            $exams = Exam::latest("id")->with("subject")->get();
        }

        foreach ($subjects as $subject) {
            $get_user_subject = UserSubject::where("user_id", $id_user)
                ->where("subject_id", $subject->id)
                ->get();
        }

        return view("client.exam.list", compact("subjects", "exams", "get_user_subject"));
    }
}

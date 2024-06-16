<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubjectController extends Controller
{
    const PATH_VIEW = "admin.subject.";
    const PATH_UPLOAD = "subjects";

    public function index()
    {
        $data = Subject::latest("id")->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact("data"));
    }

    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    public function store(Request $request)
    {
        $data = $request->except("image");

        $request->validate(
            [
                "name" => "required|unique:subjects,name",
                "description" => "required",
                "image" => "required|mimes:jpg,jpeg,webp,png",
            ]
        );

        if ($request->hasFile("image")) {
            $data["image"] = Storage::put(self::PATH_UPLOAD, $request->file("image"));
        }

        $is_create = Subject::create($data);

        if ($is_create) {
            return redirect()->route("admin.subjects.index")->with("success", "Create a new subject successfully");
        } else {
            return redirect()->route("admin.subjects.index")->with("error", "Create a new subject failed");
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Subject $subject)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact("subject"));
    }

    public function update(Request $request, Subject $subject)
    {
        $data = $request->except("image");

        $request->validate(
            [
                "name" => "required|unique:subjects,name," . $subject->id,
                "description" => "required",
                "image" => "mimes:jpg,jpeg,webp,png",
            ]
        );

        if ($request->hasFile("image")) {
            $data["image"] = Storage::put(self::PATH_UPLOAD, $request->file("image"));
        }

        $currentImage = $subject->image;
        $subject->update($data);

        if ($request->hasFile('image') && $currentImage && Storage::exists($currentImage)) {
            Storage::delete($currentImage);
        }

        return redirect()->route("admin.subjects.index")->with("success", "Edit subject successfully");
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();

        if ($subject->image && Storage::exists($subject->image)) {
            Storage::delete($subject->image);
        }

        return back()->with("success", "Delete subject successfully");
    }
}

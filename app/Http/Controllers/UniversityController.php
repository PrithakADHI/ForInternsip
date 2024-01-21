<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreUniversityRequest;
use App\Http\Requests\UpdateUniversityRequest;

class UniversityController extends Controller
{
    public function index() {
        $universities = University::orderBy('order')->paginate(10);
        return view('admin.universities.index', compact('universities'));
    }

    public function create() {
        return view('admin.universities.create');
    }

    public function store(StoreUniversityRequest $request) {
        $input = $request->all();
        $input['image'] = $this->fileUpload($request, 'image', '/admin/images/universities');

        $university = University::create($input);
        $university->update(['slug' => Str::slug($request->name)]);
        return redirect()->route('admin.universities.index')->with('message', 'Created Successfully');

    }

    public function show() {
        return '';
    }

    public function edit(University $university) {
        return view('admin.universities.edit', compact('university'));
    }

    public function update(UpdateUniversityRequest $request, University $university) {
        $old_image = $university->image;
        $input = $request->all();

        $image = $this->fileUpload($request, 'image', '/admin/images/universities/');

        if ($image) {
            $this->removeFile($old_image, '/admin/images/universities');
            $input['image'] = $image;
        } else {
            unset($input['image']);
        }

        $input['slug'] = Str::slug($request->name);
        $university->update($input);
        return redirect()->route('admin.universities.index')->with('message', 'Updated Successfully');

    }

    public function destroy(University $university) {
        $this->removeFile($university->image, '/admin/images/universities/');
        $university->delete();
        return redirect()->route('admin.universities.index')->with('message', 'Deleted Successfully');
    }

    public function fileUpload(Request $request, $name, $path)

{

$imageName = '';

if ($image = $request->file($name)) {

$destinationPath = public_path() . $path;

$imageName = date('YmdHis') . $name . "-" . $image->getClientOriginalName();

$image->move($destinationPath, $imageName);

$image = $imageName;

}

return $imageName;

}

  

public function removeFile($file, $path)

{

$path = public_path() . $path . $file;

if (File::exists($path)) {

File::delete($path);

}

}
}

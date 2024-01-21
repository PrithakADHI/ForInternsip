<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;

class CourseController extends Controller
{
    public function index() {
        $courses = Course::orderBy('order')->paginate(10);
        return view('admin.courses.index', compact('courses'));
    }
    
      
    
    public function create() {
        return view('admin.courses.create');
    }
    
      
    
    public function store(StoreCourseRequest $request) {
        $input = $request->all();
        $input['image'] = $this->fileUpload($request, 'image', '/admin/images/courses');

        $course = Course::create($input);
        $course->update(['slug' => Str::slug($request->name)]);
        return redirect()->route('admin.courses.index')->with('message', 'Created Successfully');
    }
    
      
    
    public function show() {
        //
    }
    
      
    
    public function edit(Course $course) {
        return view('admin.courses.edit', compact('course'));
    }
    
      
    
    public function update(UpdateCourseRequest $request, Course $course) {
        $old_image = $course->image;
        $input = $request->all();

        $image = $this->fileUpload($request, 'image', '/admin/images/courses/');

        if ($image) {
            $this->removeFile($old_image, '/admin/images/courses');
            $input['image'] = $image;
        } else {
            unset($input['image']);
        }

        $input['slug'] = Str::slug($request->name);
        $course->update($input);
        return redirect()->route('admin.courses.index')->with('message', 'Updated Successfully');
    }
    
      
    
    public function destroy(Course $course) {
        $this->removeFile($course->image, '/admin/images/course/');
        $course->delete();
        return redirect()->route('admin.courses.index')->with('message', 'Deleted Successfully');
    
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

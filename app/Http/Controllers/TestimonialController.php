<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreTestimonialRequest;
use App\Http\Requests\UpdateTestimonialRequest;

class TestimonialController extends Controller
{
    public function index() {
        $testimonials = Testimonial::orderBy('order')->paginate(10);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create() {
        return view('admin.testimonials.create');
    }

    public function store(StoreTestimonialRequest $request) {
        $input = $request->all();
        $input['image'] = $this->fileUpload($request, 'image', '/admin/images/testimonials');

        $testimonial = Testimonial::create($input);
        $testimonial->update(['slug' => Str::slug($request->name)]);
        return redirect()->route('admin.testimonials.index')->with('message', 'Created Successfully');

    }

    public function show() {
        return '';
    }

    public function edit(Testimonial $testimonial) {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial) {
        $old_image = $testimonial->image;
        $input = $request->all();

        $image = $this->fileUpload($request, 'image', '/admin/images/testimonials/');

        if ($image) {
            $this->removeFile($old_image, '/admin/images/testimonials');
            $input['image'] = $image;
        } else {
            unset($input['image']);
        }

        $input['slug'] = Str::slug($request->name);
        $testimonial->update($input);
        return redirect()->route('admin.testimonials.index')->with('message', 'Updated Successfully');

    }

    public function destroy(Testimonial $testimonial) {
        $this->removeFile($testimonial->image, '/admin/images/testimonials/');
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('message', 'Deleted Successfully');
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

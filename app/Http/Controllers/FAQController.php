<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreFAQRequest;
use App\Http\Requests\UpdateFAQRequest;

class FAQController extends Controller
{
    public function index() {
        $faqs = FAQ::orderBy('order')->paginate(10);
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create() {
        return view('admin.faqs.create');
    }

    public function store(StoreFAQRequest $request) {
        $input = $request->all();
        $input['image'] = $this->fileUpload($request, 'image', '/admin/images/faqs');

        $faq = FAQ::create($input);
        $faq->update(['slug' => Str::slug($request->name)]);
        return redirect()->route('admin.faqs.index')->with('message', 'Created Successfully');

    }

    public function show() {
        return '';
    }

    public function edit(FAQ $faq) {
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(UpdateFAQRequest $request, FAQ $faq) {
        $old_image = $faq->image;
        $input = $request->all();

        $image = $this->fileUpload($request, 'image', '/admin/images/faqs/');

        if ($image) {
            $this->removeFile($old_image, '/admin/images/faqs');
            $input['image'] = $image;
        } else {
            unset($input['image']);
        }

        $input['slug'] = Str::slug($request->name);
        $faq->update($input);
        return redirect()->route('admin.faqs.index')->with('message', 'Updated Successfully');

    }

    public function destroy(FAQ $faq) {
        $this->removeFile($faq->image, '/admin/images/faqs/');
        $faq->delete();
        return redirect()->route('admin.faqs.index')->with('message', 'Deleted Successfully');
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

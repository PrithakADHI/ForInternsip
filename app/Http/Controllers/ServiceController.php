<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;

class ServiceController extends Controller
{
    public function index() {
        $services = Service::orderBy('order')->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    public function create() {
        return view('admin.services.create');
    }

    public function store(StoreServiceRequest $request) {
        $input = $request->all();
        $input['image'] = $this->fileUpload($request, 'image', '/admin/images/service');

        $service = Service::create($input);
        $service->update(['slug' => Str::slug($request->name)]);
        return redirect()->route('admin.services.index')->with('message', 'Created Successfully');

    }

    public function show() {
        return '';
    }

    public function edit(Service $service) {
        return view('admin.services.edit', compact('service'));
    }

    public function update(UpdateServiceRequest $request, Service $service) {
        $old_image = $service->image;
        $input = $request->all();

        $image = $this->fileUpload($request, 'image', '/admin/images/services/');

        if ($image) {
            $this->removeFile($old_image, '/admin/images/services');
            $input['image'] = $image;
        } else {
            unset($input['image']);
        }

        $input['slug'] = Str::slug($request->name);
        $service->update($input);
        return redirect()->route('admin.services.index')->with('message', 'Updated Successfully');

    }

    public function destroy(Service $service) {
        $this->removeFile($service->image, '/admin/images/services/');
        $service->delete();
        return redirect()->route('admin.services.index')->with('message', 'Deleted Successfully');
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

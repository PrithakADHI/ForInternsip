<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;

class CountryController extends Controller
{
    public function index() {
        $countries = Country::orderBy('order')->paginate(10);
        return view('admin.country.index', compact('countries'));
    }

    public function create() {
        return view('admin.country.create');
    }

    public function store(StoreCountryRequest $request) {
        $input = $request->all();
        $input['image'] = $this->fileUpload($request, 'image', '/admin/images/countries');

        $country = Country::create($input);
        $country->update(['slug' => Str::slug($request->name)]);
        return redirect()->route('admin.countries.index')->with('message', 'Created Successfully');

    }

    public function show() {
        return '';
    }

    public function edit(Country $country) {
        return view('admin.country.edit', compact('country'));
    }

    public function update(UpdateCountryRequest $request, Country $country) {
        $old_image = $country->image;
        $input = $request->all();

        $image = $this->fileUpload($request, 'image', '/admin/images/countries/');

        if ($image) {
            $this->removeFile($old_image, '/admin/images/countries');
            $input['image'] = $image;
        } else {
            unset($input['image']);
        }

        $input['slug'] = Str::slug($request->name);
        $country->update($input);
        return redirect()->route('admin.countries.index')->with('message', 'Updated Successfully');

    }

    public function destroy(Country $country) {
        $this->removeFile($country->image, '/admin/images/countries/');
        $country->delete();
        return redirect()->route('admin.countries.index')->with('message', 'Deleted Successfully');
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

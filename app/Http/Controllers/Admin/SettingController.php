<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use File;

class SettingController extends Controller
{
    public function edit()
    {
        $settings = Setting::pluck('value', 'key');
        return view('admin.setting.edit', compact('settings'));
    }

    public function update(Request $request, Setting $setting)
    {
        $siteSettings = Setting::pluck('value', 'key');

        $old_main_logo = $siteSettings['site_main_logo'];
        $old_footer_logo = $siteSettings['site_footer_logo'];
        $old_contact_image = $siteSettings['contact_image'];
        $old_fav_icon = $siteSettings['fav_icon'];
        $old_video_section_image = $siteSettings['video_section_image'];
        $old_about_section_image = $siteSettings['about_section_image'];
        $old_feature_section_image = $siteSettings['feature_section_image'];
        $old_about_page_banner = $siteSettings['about_page_banner'];
        $old_course_page_banner = $siteSettings['course_page_banner'];
        $old_country_page_banner = $siteSettings['country_page_banner'];
        $old_blog_page_banner = $siteSettings['blog_page_banner'];
        $old_service_page_banner = $siteSettings['service_page_banner'];

        $input = $request->all();
        $site_main_logo = $this->fileUpload($request, 'site_main_logo');
        $site_footer_logo = $this->fileUpload($request, 'site_footer_logo');
        $fav_icon = $this->fileUpload($request, 'fav_icon');
        $contact_image = $this->fileUpload($request, 'contact_image');
        $video_section_image = $this->fileUpload($request, 'video_section_image');
        $about_section_image = $this->fileUpload($request, 'about_section_image');
        $feature_section_image = $this->fileUpload($request, 'feature_section_image');
        $about_page_banner = $this->fileUpload($request, 'about_page_banner');
        $course_page_banner = $this->fileUpload($request, 'course_page_banner');
        $country_page_banner = $this->fileUpload($request, 'country_page_banner');
        $blog_page_banner = $this->fileUpload($request, 'blog_page_banner');
        $service_page_banner = $this->fileUpload($request, 'service_page_banner');

        //delete old file
        if ($site_main_logo) {
            $this->removeFile($old_main_logo);
            $input['site_main_logo'] = $site_main_logo;
        } else {
            unset($input['site_main_logo']);
        }

        if ($site_footer_logo) {
            $this->removeFile($old_footer_logo);
            $input['site_footer_logo'] = $site_footer_logo;
        } else {
            unset($input['site_footer_logo']);
        }

        if ($contact_image) {
            $this->removeFile($old_contact_image);
            $input['contact_image'] = $contact_image;
        } else {
            unset($input['contact_image']);
        }

        if ($fav_icon) {
            $this->removeFile($old_fav_icon);
            $input['fav_icon'] = $fav_icon;
        } else {
            unset($input['fav_icon']);
        }


        if ($video_section_image) {
            $this->removeFile($old_video_section_image);
            $input['video_section_image'] = $video_section_image;
        } else {
            unset($input['video_section_image']);
        }

        if ($about_section_image) {
            $this->removeFile($old_about_section_image);
            $input['about_section_image'] = $about_section_image;
        } else {
            unset($input['about_section_image']);
        }

        if ($feature_section_image) {
            $this->removeFile($old_feature_section_image);
            $input['feature_section_image'] = $feature_section_image;
        } else {
            unset($input['feature_section_image']);
        }

        if ($about_page_banner) {
            $this->removeFile($old_about_page_banner);
            $input['about_page_banner'] = $about_page_banner;
        } else {
            unset($input['about_page_banner']);
        }

        if ($course_page_banner) {
            $this->removeFile($old_course_page_banner);
            $input['course_page_banner'] = $course_page_banner;
        } else {
            unset($input['course_page_banner']);
        }

        if ($country_page_banner) {
            $this->removeFile($old_country_page_banner);
            $input['country_page_banner'] = $country_page_banner;
        } else {
            unset($input['country_page_banner']);
        }

        if ($blog_page_banner) {
            $this->removeFile($old_blog_page_banner);
            $input['blog_page_banner'] = $blog_page_banner;
        } else {
            unset($input['blog_page_banner']);
        }

        if ($service_page_banner) {
            $this->removeFile($old_service_page_banner);
            $input['service_page_banner'] = $service_page_banner;
        } else {
            unset($input['service_page_banner']);
        }
        //end

        foreach ($input as $key => $value) {
            $setting->updateOrCreate(['key' => $key,], [
                'key' => $key,
                'value' => $value,
            ]);
        }
        return redirect()->back()->with('message', 'Setting Updated Successfully');
    }


    public function fileUpload(Request $request, $name)
    {
        $imageName = '';
        if ($image = $request->file($name)) {
            $destinationPath = public_path() . '/admin/images/setting';
            $imageName = date('YmdHis') . $name . "-" . $image->getClientOriginalName();
            $image->move($destinationPath, $imageName);
            $image = $imageName;
            return $imageName;
        } else {
            return null;
        }
    }

    public function removeFile($file)
    {
        $path = public_path() . '/admin/images/setting/' . $file;
        if (File::exists($path)) {
            File::delete($path);
        }
    }
}

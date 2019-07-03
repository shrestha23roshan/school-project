<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Settings\Repositories\Setting\SettingRepository;
use Modules\Settings\Http\Requests\Setting\UpdateRequest;
use Modules\Configuration\Repositories\User\UserRepository;
use Modules\Settings\Http\Requests\Profile\ProfileUpdateRequest;
use Modules\Settings\Http\Requests\Profile\PasswordUpdateRequest;

class SettingsController extends Controller
{
    private $setting;
    private $user;

    public function __construct(SettingRepository $setting, UserRepository $user)
    {
        $this->setting = $setting;
        $this->user = $user;
        $this->destinationpath = 'uploads/settings/';
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function setting()
    {
        return view('settings::Setting.setting')
        ->withSetting($this->setting->find('1'));
            
    }

     /**
     * Update the setting resource in storage.
     * @param  UpdateRequest $request
     * @return Response
     */
    public function updateSetting(UpdateRequest $request)
    {
        $data = $request->except('site_logo', 'site_favicon');

        $siteLogo = $request->site_logo;
        if($siteLogo) {
            $extension = strchr($siteLogo->getClientOriginalName(), '.');
            $new_file_name = 'logo_' . str_random(10) . '_' . time();
            $site_logo = $siteLogo->move($this->destinationpath, $new_file_name.$extension);
            $data['site_logo'] = isset($site_logo) ? $new_file_name . $extension : NULL;
        }

        $siteFavicon = $request->site_favicon;
        if($siteFavicon) {
            $extension = strchr($siteFavicon->getClientOriginalName(), '.');
            $new_file_name = 'favicon_' . str_random(10) . '_' . time();
            $site_favicon = $siteFavicon->move($this->destinationpath, $new_file_name.$extension);
            $data['site_favicon'] = isset($site_favicon) ? $new_file_name . $extension : NULL;
        }
        $setting = $this->setting->update('1', $data);

        if($setting){
            return redirect()->route('admin.settings.index')
                ->withSuccessMessage('Settings is saved successfully.');
        }
        return redirect()->back()->withInput()
            ->withWarningMessage('Settings can not be saved.');
    }

    /**
     * Return profile view.
     * @return Response
     */
    public function profile()
    {
        return view('settings::Profile.profile');
    }

    /**
     * Update the profile resource in storage.
     * @param  ProfileUpdateRequest $request
     * @return Response
     */
    public function updateProfile(ProfileUpdateRequest $request)
    {
        $user = $this->user->find(auth()->id());

        $data = $request->except('image_icon');

        // Retrieve previous User image icon name
        $temp = $user->image_icon;

        $imagePath = null;
        if($temp != null){
            $oldImageName = $temp.'-s.jpg';
            $imagePath = 'uploads/settings/profile/'.$oldImageName;
        }
    
        $imageFile = $request->file('image_icon');
        if($imageFile){
            // Remove previous user image icon from profile folder
            if(file_exists($imagePath)){
                unlink($imagePath);
            }
            
            $tmpFilePath = 'uploads/settings/profile/';
            $hardPath = str_slug($data['full_name'], '-'). '-' .md5(time());
            $img = Image::make($imageFile);

            $img->fit(80, 80)->save($tmpFilePath.$hardPath.'-s.jpg');
            $user->image_icon = $hardPath;
        }

        $user->username = $data['username'];
        $user->full_name = $data['full_name'];
        $user->designation = $data['designation'];
        $user->save();
        if($user->save()){
            return redirect()->back()->withInput()
                ->withSuccessMessage('Profile is updated successfully.');
        }
        return redirect()->back()->withInput()
            ->withWarningMessage('Profile can not be updated.');
    }

     /**
     * Update the password resource in storage.
     * @param  ProfileUpdateRequest $request
     * @return Response
     */
    public function updatePassword(PasswordUpdateRequest $request)
    {
        $credentials = $request->only('password', 'password_confirmation');
        $user = Auth::user();
        $user->password = bcrypt($credentials['password']);
        $user->save();
        if($user->save()){
            return redirect()->back()
                ->withSuccessMessage('Password is updated successfully.');
        }
        return redirect()->back()
            ->withWarningMessage('Password can not be updated.');
    }
}

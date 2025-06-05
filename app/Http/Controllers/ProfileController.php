<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

use function PHPUnit\Framework\fileExists;

class ProfileController extends Controller
{
    //go to profile in dashboard
    public function profile(){
        $user = Auth::user();
        $image = $this->getImage();
        if(Auth::user()->role == 'user'){
            return view('Client.Template.Profile.index',compact('user','image'));
        }
        return view('Admin.Template.Profile.index',compact('user','image'));
    }

    //password page
    public function passwordChange(){
        $user = Auth::user();
        $image = $this->getImage();
        if(Auth::user()->role == 'user'){
            return view('Client.Template.Profile.psw',compact('user','image'));
        }
        return view('Admin.Template.Profile.changePsw',compact('user','image'));
    }

    //change password
    public function passwordUpdate(Request $request){
        $DBpassword = Auth::user()->password;

        if(Hash::check($request->oldPassword, $DBpassword)){
            $this->CheckPasswordValidation($request);

            User::whereId(Auth::user()->id)->update([
                'password' => Hash::make($request->newPassword)
            ]);

            Alert::success('SUCCESS','Your Password Changed Successfully.');
            Auth::logout();

            //remove session and regenerate token
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            //go to login page
            return redirect('/');

        }else{
            Alert::error('FAIL','password is no same our records. Try Again... ');
            return back();
        }
    }


    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = Auth::user();
        $image = $this->getImage();

        if (Auth::user()->role == 'user') {
           return view('Client.Template.Profile.edit',compact('user','image'));
        }

        return view('Admin.Template.Profile.profileUpdate',compact('user','image'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $this->profileValidation($request);
        $data = $this->getProfileData($request);

        if($request->hasFile('profile')){
            //if user profile upload next time check have profile and remove exist file
            if(Auth::user()->profile != null){
                if(file_exists(public_path().'/photo/'. Auth::user()->profile)){
                    unlink(public_path().'/photo/'. Auth::user()->profile);
                }
            }
            //fist time user was upload his profile
            $ProfileName = uniqid().$request->file('profile')->getClientOriginalName();
            $request->file('profile')->move(public_path().'/photo/',$ProfileName);
            $data['profile'] = $ProfileName;
        }else{
            $data['profile'] = Auth::user()->profile;
        }


        User::whereId(Auth::user()->id)->update($data);
        Alert::success('Account Update', 'Success Account Updated');
        return to_route('profile.index');
    }
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    //check password validation
    private function CheckPasswordValidation($request){
        $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|min:6|same:newPassword',
        ]);
    }

    //get profile data
    private function getProfileData($request){
        return[
            'name' => $request->name,
            'nickname' => $request->nickname,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'profile' => $request->profile
        ];
    }

    //check profile info validation
    private function profileValidation($request){
       $request->validate([
        'name' => 'required|unique:users,name,'.Auth::user()->id,
        'email' => 'required|unique:users,email,'.Auth::user()->id,
        'phone' => 'required',
        'address' => 'max:200',
        'profile' => 'file|mimes:jpg,jpeg,png,webp,svg,gif'
       ]);
    }

    //CAll image path
    private function getImage(){
        $user = Auth::user();
         // Default image path
        $defaultImage = asset('/photo/default-user.jpg');

        // Determine the image source
        if ($user->profile) {
            // Check if it's a URL (social login)
            if (filter_var($user->profile, FILTER_VALIDATE_URL)) {
                return $image = $user->profile;
            } else {
                // Otherwise, assume it's stored locally in storage
                return $image = asset('/photo/' . $user->profile);
            }
        } else {
            return $image = $defaultImage;
        }
    }
}

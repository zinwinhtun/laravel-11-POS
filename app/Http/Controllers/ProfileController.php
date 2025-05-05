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

class ProfileController extends Controller
{
    //go to profile in dashboard
    public function profile(){
        $user = Auth::user();
        return view('Admin.Template.Profile.index',compact('user'));
    }

    //password page
    public function passwordChange(){
        $user = Auth::user();
        return view('Admin.Template.Profile.changePsw',compact('user'));
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
        return view('Admin.Template.Profile.profileUpdate',compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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
}

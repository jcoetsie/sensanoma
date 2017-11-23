<?php

namespace App\Http\Controllers;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Auth;
use Image;

class UserController extends Controller
{
    public function profile(){
        return view('user.profile',array('user'=>Auth::user() ));
    }

    public function update(UserRequest $request, User $user){

        if($request->hasFile('avatar'))
        {
            $oldavatar = Auth::user()->avatar;
            \File::delete('uploads/avatars/' . $oldavatar);

            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->fit(200,200)
                                ->save(public_path('uploads/avatars/' . $filename));
                $user = Auth::user();
                $user->avatar = $filename;
                $user->save();

        }
        else if($request->input('name'))
        {
            Auth::user()->update($request->toArray());
        }
        return view('user.profile',array('user'=>Auth::user() ));
    }

    public function destroy(User $user){

        if(Auth::user()->hasRole('admin'))
        {
            Auth::user()->account()->delete();
        }
        else
        {
            Auth::user()->destroy(Auth::id());
        }

        return redirect(route('home'))->with('success', 'The User has been deleted');
    }
}

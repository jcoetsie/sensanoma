<?php

namespace App\Http\Controllers;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Image;

class UserController extends Controller
{
    public function profile()
    {
        return view('user.profile',array('user'=>Auth::user() ));
    }

    public function update(UserRequest $request, User $user){

        $user = Auth::user();



        if($request->hasFile('avatar')) {
            $oldavatar = $user->avatar;
            \File::delete('uploads/avatars/' . $oldavatar);

            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->fit(200,200)
                                ->save(public_path('uploads/avatars/' . $filename));

                $user->avatar = $filename;
                $user->save();

        } else if($request->input('name')) {
            Auth::user()->update($request->toArray());
        }




        /*else {

            if($request->input('current_password')) {
                $current_password = $request->input('current_password');

                if(Hash::check($current_password, auth()->user()->getAuthPassword())) {
                    $user->password = Hash::make($request->input('password'));
                    $user->name = $request['name'];
                    $user->save();
                }
            }

            //Auth::user()->update($request->toArray());
        }

        /*
        else if($request->input('name')) {
            Auth::user()->update($request->toArray());
        }
        else if($request->input('current_password')){
            $password = $request->input('password');
            dd($password);

            if($request->input('current_password') == Auth::user()->password){

                $newpwd = $request->input('password');

                $user = Auth::user();

                $user->password = bcrypt($newpwd);

                $user->save();
            }
        }
        */

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

    public function viewerDestroy($id){

        //travaille a faire ici encle
        $user = User::find($id);

        $user->delete();

        return redirect(route('home'))->with('success', 'The User has been deleted');
    }
}

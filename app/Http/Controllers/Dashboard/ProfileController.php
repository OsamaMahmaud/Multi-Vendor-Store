<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Symfony\Component\Intl\Locales;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use App\Http\Requests\User\RequestUser;

class ProfileController extends Controller
{
    public function edit(){

        $user=Auth::user();

        $countries=Countries::getNames(); // //getNames('ar')

        $locales=Locales::getNames(); //getNames('ar')

    //   return  $user->profile->first_name;

        // $user->fill($user->$request->all())->save();

        return view('dashboard.Profile.edit',compact('user','countries','locales'));


    }

    public function update(RequestUser $request){

        $user=$request->user(); //= Auth::user();

        $user->profile->fill($request->all())->save();

        return redirect()->route('dashboard.user.profile')->with('success',__('site.updated_successfully'));


    }


}

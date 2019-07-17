<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::whereUuid($id)->first();
        return view('auth.profile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::whereUuid($id)->first();
        //Validate name, email and password fields
        $request->validate(
            [
                'firstname'=>'required|max:120',
                'lastname'=>'required|max:120',
                'contactnumber'=>'required|max:20',
            ]
        );

        $input = $request->only(['firstname', 'lastname', 'contactnumber', 'status_is']); //Retreive the name, email and password fields

        $user->fill($input)->save();


        flash('Profile successfully updated.')->success();
        return redirect()->route('profile.edit', $user->uuid);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

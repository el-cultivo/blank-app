<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\ClientController;

use App\Http\Requests\Users\UpdateEmailRequest;
use App\Http\Requests\Users\UpdatePasswordRequest;

use App\Notifications\Users\UpdatePasswordNotification;
use App\Notifications\Users\UpdateMailNotification;

use App\User;

use App\Models\Users\Card;
use App\Models\Users\BankAccount;

use Redirect;

use Response;

class UserController extends ClientController
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show');
    }


    public function updateEmail(UpdateEmailRequest $request, User $user)
    {
        $input = $request->all();

        $clone = $user;

        $user->email = $input["email"];

        if (!$user->save()) {
            return Redirect::back()->withErrors(["El email no pudo ser actualizdo correctamente"]);
        }

        $clone->notify( new UpdateMailNotification);

        return Redirect::route('user::home',$user->name)->with('status', "El email fue correctamente actualizado");
    }


    public function updatePassword(UpdatePasswordRequest $request, User $user)
    {
        $input = $request->all();

        $user->password = bcrypt( $input["password"] ) ;

        if (!$user->save()) {
            return Redirect::back()->withErrors(["La contraseña no pudo ser actualizda correctamente"]);
        }

        $user->notify( new UpdatePasswordNotification);

        return Redirect::route('user::home',$user->name)->with('status', "La contraseña fue correctamente actualizada");
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function createUser(Request $request): mixed
    {
        return User::create([
            'id' => $request->user_id,
            'name' => $request->name,
        ]);
    }

}

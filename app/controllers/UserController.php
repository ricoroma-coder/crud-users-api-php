<?php

namespace App\Controllers;

use App\General\Request;
use App\Models\User;

class UserController
{
    public function store(Request $request)
    {
        $obj = new User();
        $obj->setAttributes($request->all());

        try
        {
            $obj->save();
        }
        catch (\Exception $e)
        {
            response()->json(['success' => false, 'message' => 'Internal error (dberror)'], 500);
        }

        response()->json(['success' => true, 'message' => 'User registered'], 201);
    }
}

<?php

namespace App\Controllers;

use App\General\Request;
use App\Models\User;

class UserController
{
    public function store(Request $request)
    {
        if (empty($request->params()))
            $obj = new User();
        else
        {
            $id = $request->params()['id'];
            $obj = User::query()->find($id);

            if (is_null($obj))
                response()->json(['success' => false, 'message' => 'User not found'], 404);
        }

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

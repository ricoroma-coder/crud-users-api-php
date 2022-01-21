<?php

namespace App\Controllers;

use App\General\Request;
use App\Models\User;
use App\Validation\UserRouteValidation;

class UserController
{
    public function store(Request $request)
    {
        UserRouteValidation::store($request);

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

    public function find(Request $request)
    {
        UserRouteValidation::find($request);

        $id = $request->params()['id'];
        $obj = User::query()->find($id);

        if (is_null($obj))
            response()->json(['success' => false, 'message' => 'User not found'], 404);

        response()->json($obj->getAttributes());
    }

    public function delete(Request $request)
    {
        UserRouteValidation::delete($request);

        $obj = User::query()->find($request->all()->id);

        try
        {
            $obj->delete();
        }
        catch (\Exception $e)
        {
            response()->json(['success' => false, 'message' => 'Internal error (dberror)'], 500);
        }

        response()->json(['success' => true, 'message' => 'User deleted']);
    }

    public function specialFilter(Request $request)
    {
        $route = $request->base();
        $field = '';
        $getAll = true;

        switch ($route)
        {
            case '/api/find/states':
                $field = 'state';
            break;
            case '/api/find/cities':
                $field = 'city';
            break;
            case '/api/find/addresses':
                $field = 'address';
            break;
            default:
                response()->json(['success' => false, 'message' => 'No treatment for this route'], 500);
            break;
        }

        $response = [];

        if ($getAll)
        {
            foreach (User::all() as $user)
            {
                $response[] = [
                    'id' => $user->getAttribute('id'),
                    'name' => $user->getAttribute('name'),
                    $field => $user->getAttribute($field),
                ];
            }
        }

        response()->json($response);
    }
}

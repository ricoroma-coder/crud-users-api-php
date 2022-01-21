<?php

namespace App\Validation;

use App\General\Request;
use App\Models\User;

class UserRouteValidation
{
    public static function store(Request $request)
    {
        $values = $request->all();

        if (substr($request->uri(), -1) == "0")
            response()->json(['success' => false, 'message' => 'Attribute id is invalid'], 400);
        else if (empty($request->params()))
        {
            foreach (['name', 'address', 'city', 'state'] as $attribute)
            {
                if (!isset($values->$attribute))
                    response()->json(['success' => false, 'message' => "Attribute {$attribute} is required"], 400);

                if ($attribute == 'name')
                {
                    $obj = User::query()->where('name', $values->name)->first();

                    if (!is_null($obj))
                        response()->json(['success' => false, 'message' => 'Attribute name is already in use'], 409);
                }
            }
        }
        else
        {
            $id = $request->params()['id'];
            if (!isset($id))
                response()->json(['success' => false, 'message' => 'Attribute id is invalid'], 400);

            $obj = User::query()->where('name', $values->name)->first();

            if (!is_null($obj) && $obj->getAttribute('id') != $id)
                response()->json(['success' => false, 'message' => 'Attribute name is already in use'], 409);
        }
    }

    public static function find(Request $request)
    {
        if (substr(
            $request->uri(), -1) == "0" ||
            empty($request->params()) ||
            !isset($request->params()['id']) ||
            $request->params()['id'] <= 0 ||
            !is_numeric($request->params()['id'])
        )
            response()->json(['success' => false, 'message' => 'Attribute id is invalid'], 400);
    }

    public static function delete(Request $request)
    {
        $message = '';
        $status = 400;
        $id = $request->all()->id ?? null;

        if (!isset($id))
            $message = 'Attribute id is required';
        else if (empty($id) || $id <= 0 || !is_numeric($id))
            $message = 'Attribute id is not valid';

        $obj = User::query()->find($id);

        if (is_null($obj))
        {
            $message = 'User not found';
            $status = 404;
        }

        if (!empty($message))
            response()->json(['success' => false, 'message' => $message], $status);
    }
}

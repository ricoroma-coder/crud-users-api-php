<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $attributes = [
        'id' => '',
        'name' => '',
        'address' => '',
        'city' => '',
        'state' => '',
    ];
    public $incrementing = true;
    public $timestamps = false;

    public function setAttributes($attributes)
    {
        foreach ($attributes as $key => $value)
        {
            if (in_array($key, array_keys($this->attributes)))
                $this->setAttribute($key, $value);
            else
                response()->json(['success' => false, 'message' => "Attribute {$key} is not expected"], 400);
        }
    }
}

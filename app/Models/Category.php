<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Validator;

class Category extends Model
{
	protected $table = 'category';
    protected $fillable = ['name', 'description', 'image', 'created_at'];

    public function saveData($data = array())
    {
        $this->fill($data);

        $rules = [
            'id'  =>  'required',
            'name'  =>  'required'
        ];

        $validator = Validator::make($data, $rules)->validate();

        $this->save();

        return true;
    }
}

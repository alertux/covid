<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Validator;

class Diagnosis extends Model
{
	protected $table = 'diagnosis';
    protected $fillable = ['name', 'check_at', 'state', 'path', 'url', 'detail'];

    public function saveData($data = array())
    {
        $this->fill($data);

        $rules = [
            'id'  =>  'required',
            'name'  =>  'required',
            'check_at'  =>  'required',
            'state'  =>  'required'
        ];

        $validator = Validator::make($data, $rules)->validate();

        $this->save();

        return true;
    }
}

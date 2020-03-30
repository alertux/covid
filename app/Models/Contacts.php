<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Validator;

class Contacts extends Model
{
	protected $table = 'contacts';
    protected $fillable = ['name', 'meet_at', 'detail', 'other'];

    public function saveData($data = array())
    {
        $this->fill($data);

        $rules = [
            'id'  =>  'required',
            'name'  =>  'required',
            'meet_at'  =>  'required',
            'detail'  =>  'required'
        ];

        $validator = Validator::make($data, $rules)->validate();

        $this->save();

        return true;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Validator;

class Places extends Model
{
	protected $table = 'places';
    protected $fillable = ['place_name', 'visit_at', 'end_at', 'country', 'summary', 'persons'];

    public function saveData($data = array())
    {
        $this->fill($data);

        $rules = [
            'id'  =>  'required',
            'place_name'  =>  'required',
            'visit_at'  =>  'required',
            'country'  =>  'required',
            'summary'  =>  'required',
            'persons'  =>  'required'
        ];

        $validator = Validator::make($data, $rules)->validate();

        $this->save();

        return true;
    }
}

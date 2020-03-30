<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Validator;

class Report extends Model
{
	protected $table = 'report';
    protected $fillable = ['complaint', 'report_at', 'country', 'summary'];

    public function saveData($data = array())
    {
        $this->fill($data);

        $rules = [
            'id'  =>  'required',
            'complaint'  =>  'required',
            'report_at'  =>  'required',
            'country'  =>  'required',
            'summary'  =>  'required'
        ];

        $validator = Validator::make($data, $rules)->validate();

        $this->save();

        return true;
    }
}

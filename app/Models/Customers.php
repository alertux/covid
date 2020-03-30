<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Faker\Provider\Uuid;
use Validator;

class Customers extends Model
{
    protected $fillable = ['nit', 'dui', 'giro', 'address', 'city', 'nrc', 'name', 'email', 'phone', 'fax', 'company_name', 'department'];

    public function saveData($data = array())
    {
        $this->fill($data);

        $rules = [
            'name'  =>  'required'
        ];

        $validator = Validator::make($data, $rules)->validate();

        $this->save();

        return true;
    }

}

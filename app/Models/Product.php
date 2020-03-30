<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Validator;

class Product extends Model
{
	protected $table = 'product';
    protected $fillable = ['name', 'description', 'image', 'created_at', 'barcode', 'inventary_min', 'price_in', 'price_out', 'unit', 'presentation', 'user_id', 'category_id', 'is_active'];

    public function saveData($data = array())
    {
        $this->fill($data);

        $rules = [
            'id'  =>  'required',
            'name'  =>  'required',
            'description'  =>  'required',
            'inventary_min'  =>  'required',
            'price_in'  =>  'required',
            'price_out'  =>  'required',
            'unit'  =>  'required',
            'barcode' => 'required'
        ];

        $validator = Validator::make($data, $rules)->validate();

        $this->save();

        return true;
    }
}

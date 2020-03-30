<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator, Hash;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'birthday'
    ];

    protected $guarded = ['password'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    

    /**
    * Get the permission record of the user
    **/
    public function permission()
    {
        return $this->belongsTo('App\Models\Permission');
    }

    public function is_account()
    {
        return true;
    }

    public function saveUser($data = array())
    {
        $this->fill($data);

        $validate_messages = [
            'username.required' =>  trans('validation.username_required'),
            'password.required' =>  trans('validation.password_required'),
            'password_confirmation.required' =>  trans('validation.password_confirmation_required'),
            'password_confirmation.same' =>  trans('validation.password_confirmation_not_match'),
        ];

        $rules = [
            'username'  =>  'required',
            'email'  =>  'required',
            'birthday'  =>  'required',
        ];

        if (!$this->id || (isset($data['password']) && !empty($data['password']))) {
            $rules['password'] = 'required|min:6';
            $rules['password_confirmation'] = 'required|min:6|same:password';
        }

        $validator = Validator::make($data, $rules, $validate_messages)->validate();

        $errors = array();
        
        $oldUser = User::where('username', $this->username)->first();
        if (!empty($oldUser) && $oldUser->id != $this->id) {
            $errors[] = ['username' => trans('validation.username_duplicated')];
        }

        if (!empty($errors)) {
            return $errors;
        }

        if (isset($data['password']) && !empty($data['password'])) {
            $this->password = Hash::make($data['password']);
        }

        $this->save();

        return true;

    }
    
    public static function savePasswordById($user_id, $password)
    {
        $user = User::where('id', $user_id)->first();
        $user->password = Hash::make($password); 
        $user->save();

        return true;     
    }

}

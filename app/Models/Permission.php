<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    
    const ROLE_BOSS = 'B';
    const ROLE_ACCOUNT = 'C';
    const ROLE_WHOLESALE = 'W';
    const ROLE_RETAIL = 'R';
    const ROLE_NUMPO = 'N';
    const ROLE_MANAGER = 'M';
}

<?php

namespace Modules\Auth\App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthenticationActivity extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

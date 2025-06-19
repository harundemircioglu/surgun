<?php

namespace Modules\Plant\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Plant\Database\factories\SeedBankFactory;

class SeedBank extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    
    protected static function newFactory(): SeedBankFactory
    {
        //return SeedBankFactory::new();
    }
}

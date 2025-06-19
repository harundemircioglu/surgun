<?php

namespace Modules\Plant\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Plant\Database\factories\SeedCabinetFactory;

class SeedCabinet extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    
    protected static function newFactory(): SeedCabinetFactory
    {
        //return SeedCabinetFactory::new();
    }
}

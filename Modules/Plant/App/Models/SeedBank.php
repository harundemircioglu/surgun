<?php

namespace Modules\Plant\App\Models;

use Illuminate\Database\Eloquent\Model;

class SeedBank extends Model
{
    protected $guarded = [];

    public function accessionNotebook()
    {
        return $this->belongsTo(AccesionNotebook::class, 'accesion_notebook_id', 'id');
    }

    public function seedCabinet()
    {
        return $this->belongsTo(SeedCabinet::class, 'seed_cabinet_id', 'id');
    }
}

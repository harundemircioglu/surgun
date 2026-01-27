<?php

namespace Modules\Plant\App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Log\Traits\Auditable;

class SeedBank extends Model
{
    use Auditable;

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

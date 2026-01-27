<?php

namespace Modules\Plant\App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Log\Traits\Auditable;

class PlantStatus extends Model
{
    use Auditable;

    protected $guarded = [];

    public function accesionNotebook()
    {
        return $this->belongsTo(AccesionNotebook::class, 'accesion_notebook_id', 'id');
    }

    public function gardeLocation()
    {
        return $this->belongsTo(GardenLocation::class, 'garden_location_id', 'id');
    }
}

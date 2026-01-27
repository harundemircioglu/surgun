<?php

namespace Modules\Plant\App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Auth\App\Models\User;
use Modules\Log\Traits\Auditable;

class AccesionNotebook extends Model
{
    use Auditable;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function material()
    {
        return $this->belongsTo(PlantMaterial::class, 'plant_material_id', 'id');
    }

    public function origin()
    {
        return $this->belongsTo(PlantOrigin::class, 'plant_origin_id', 'id');
    }
}

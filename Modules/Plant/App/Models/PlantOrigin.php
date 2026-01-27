<?php

namespace Modules\Plant\App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Log\Traits\Auditable;

class PlantOrigin extends Model
{
    use Auditable;

    protected $guarded = [];
}

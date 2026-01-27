<?php

namespace Modules\Plant\App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Log\Traits\Auditable;

class SeedCabinet extends Model
{
    use Auditable;

    protected $guarded = [];
}

<?php

namespace Modules\Authorization\Entities;

use Modules\Core\Traits\HasTranslations;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use HasTranslations;

    public $translatable = ['display_name'];
    protected static $logAttributes = ['name'];
    protected static $logOnlyDirty = true;
}

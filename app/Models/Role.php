<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as ModelsRole;

class Role extends ModelsRole
{
    use HasFactory;
    public function canAccessFilament(): bool
    {
        return $this->hasRole(['Admin','Viewer','User','EC','CPO','ED']);
    }
}

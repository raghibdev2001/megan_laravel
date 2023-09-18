<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModulePermission extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Module()
    {
        return $this->belongsTo(Module::class);
    }
}

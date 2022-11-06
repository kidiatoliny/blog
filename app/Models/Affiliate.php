<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Affiliate extends BaseModel
{
    use HasFactory;

    public $timestamps = false;

    public function banners() : HasMany
    {
        return $this->hasMany(Banner::class);
    }
}
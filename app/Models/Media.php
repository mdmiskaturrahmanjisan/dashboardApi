<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = ['collection_name', 'original_url'];
    public function mediable() { return $this->morphTo(); }
}


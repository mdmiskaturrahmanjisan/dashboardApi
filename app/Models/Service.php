<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title','duration','duration_unit','required_servicemen',
        'discount','price','service_rate','type','category_id','status','user_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function media() { return $this->morphMany(Media::class, 'mediable'); }
    public function user() { return $this->belongsTo(User::class); }
}


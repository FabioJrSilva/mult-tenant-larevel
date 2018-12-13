<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    use TenantTrait;

    protected $fillable = ['title', 'image', 'body', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comments::class, 'post_id', 'id');
    }
}

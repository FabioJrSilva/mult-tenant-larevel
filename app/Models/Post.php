<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Tenant\Traits\TenantTrait;

class Post extends Model
{

    use TenantTrait;

    protected $fillable = ['title', 'body', 'user_id'];

     public function user()
     {
         return $this->belongsTo(User::class);
     }
}

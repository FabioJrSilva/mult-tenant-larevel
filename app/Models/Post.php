<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\Tenant\TenantScope;
use App\Observers\Tenant\TenantObserver;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'user_id'];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new TenantScope);

        static::observe(new TenantObserver);
    }

     public function user()
     {
         return $this->belongsTo(User::class);
     }
}

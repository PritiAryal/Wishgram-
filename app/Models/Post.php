<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

}

/*php artisan migrate:rollback --step=1*/
/*SQLSTATE[HY000]: General error: 1364 Field 'user_id' doesn't have a default value (SQL: insert into `posts` (`caption`, `image`, `updated_at`, `created_at`) values (Beautiful Flower always brightens my day., C:\Users\dell\AppData\Local\Temp\php1861.tmp, 2020-11-05 16:33:00, 2020-11-05 16:33:00))*/
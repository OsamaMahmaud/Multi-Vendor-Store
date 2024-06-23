<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;

    protected $primaryKey='user_id';

    protected $fillable=['user_id', 'first_name', 'last_name', 'birthday', 'gender', 'street_address', 'city', 'state', 'postal_code', 'country', 'locale'];


        public function user(): BelongsTo
        {
            return $this->belongsTo(User::class, 'user_id', 'id')->withDefault();
        }



}

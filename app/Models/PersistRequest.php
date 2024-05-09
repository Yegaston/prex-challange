<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersistRequest extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'path',
        'request_body',
        'response_body',
        'status_code',
        'origin_ip'
    ];

   protected $casts = [
        'request_body' => 'json',
        'response_body' => 'json',
   ];
}

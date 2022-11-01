<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tender extends Model
{
    use HasFactory;

    const CREATED_AT = 'updated_at';

    protected $primaryKey = 'code';

    protected $fillable = [
        'code',
        'number',
        'status',
        'name',
        'updated_at'
    ];

    protected $hidden = [
        'updated_at'
    ];

    protected $guarded = [
        'code',
        'updated_at'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DIR extends Model
{
    use HasFactory;
    protected $fillable = [
        'team',
        'shift',
        'division',
        'ps',
        'case_nature',
        'case_date',
        'time',
        'caller_phone',
        'case_description',
        'location',
        'camera_id',
        'evidence',
        'finding_remarks',
        'pco_names',
        'images',
    ];
    protected $casts = [
        'images' => 'array',
    ];
}

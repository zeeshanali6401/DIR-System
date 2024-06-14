<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DIR extends Model
{
    use HasFactory;
    protected $fillable = [
        'case_id',
        'caller_phone',
        'case_date_time',
        'time',
        'ps',
        'case_nature',
        'location',
        'case_description',
        'camera_id',
        'evidence',
        'cro',
        'face_trace',
        'anpr_passing',
        'finding_remarks',
        'team',
        'culprit',
        'fir_number',
        'feedback',
        'shift',
        'division',
        'pco_names',
        'images',
        'user_id',
        'user_ip',
        'user_hostname',
        'status',
        'user_email',
        'field_force',
        'local_cameras',
        'gang_name',
        'supervisor_id',
        'pco_id',
    ];
    protected $casts = [
        'images' => 'array',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'name' ,
        'leave_subject',
        'description',
        'leave_start_date',
        'leave_end_date',
        'is_full_day',
        'leave_balance',
        'leave_reason',
        'work_reliever'
    ];

    protected $casts = [

        'leave_start_date' => 'date',
        'leave_end_date' => 'date'
        
    ];




}
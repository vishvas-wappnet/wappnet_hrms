<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'leave_subject',
        'description',
        'leave_start_date',
        'leave_end_date',
        'is_full_day',
        'leave_balance',
        'leave_reason',
        'work_reliever',
        'status',
        'approved',
        'user_id'
    ];


    protected $dates = [
        'leave_start_date',
        'leave_end_date',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function scopeCurrentUser($query)
    {
        return $query->where('user_id', auth()->user()->id);
    }

    protected $casts = [

        'leave_start_date' => 'date',
        'leave_end_date' => 'date'

    ];


    public function getRemainingLeaveAttribute()
    {
        $totalLeave = config('leave.total_leave');
        $usedLeave = $this->user->leaves()->whereYear('leave_start_date', now()->year)->sum('leave_days');

        return $totalLeave - $usedLeave;
    }



}
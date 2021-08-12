<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    protected $table = 'performance';
    protected $fillable = array('name', 'month', 'start_date', 'end_date', 'working_report', 'goal', 'goal_report', 'target', 'present', 'absent', 'leave', 'payment', 'bonus', 'overtime', 'due_work_time', 'gap_time', 'complain', 'remark' );
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorStat extends Model
{
    use HasFactory;

    public function visitors(){
    return $this->hasMany(Visitor::class, 'visit_date', 'date');
    }

    protected $fillable = [
        'date',
        'visitor_count',
    ];

}

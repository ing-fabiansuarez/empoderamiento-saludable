<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    /** @use HasFactory<\Database\Factories\SurveyFactory> */
    use HasFactory;

    protected $fillable = [
        'uuid',
        'names',
        'surnames',
        'mail',
        'gender',
        'age',
        'weight',
        'height',
        'waist',
        'daily_activity',
        'fruit_consumption',
        'antihypertensive_medication',
        'elevated_glucose',
        'family_history',
        'bmi',
        'score',
        'risk_level',
    ];
}

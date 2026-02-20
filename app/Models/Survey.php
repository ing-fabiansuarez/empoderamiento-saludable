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
        'gender',
        'age',
        'weight',
        'height',
        'waist',
        'act',
        'food',
        'htn',
        'glu',
        'fam',
        'bmi',
        'score',
        'risk_level',
    ];
}

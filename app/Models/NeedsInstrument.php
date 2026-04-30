<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NeedsInstrument extends Model
{
    /** @use HasFactory<\Database\Factories\NeedsInstrumentFactory> */
    use HasFactory;

    protected $fillable = [
        'uuid',
        'role',
        'risk_level',
        'barrier',
        'barrier_other',
        'perception_vs_reality',
        'failure_loop',
        'hopes',
    ];
}

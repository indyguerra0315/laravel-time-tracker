<?php

namespace App\Models;

use App\Traits\Uuid as UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    use UuidTrait;

    protected $fillable = [
        'id',
        'name',
        'startTime',
        'endTime',
        'totalTime',
        'isOpen',
    ];
}

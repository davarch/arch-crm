<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class JobTitle extends Model
{
    use HasFactory;

    /**
     * @var array<string>
     */
    protected $fillable = [
        'uuid',
        'name',
    ];
}

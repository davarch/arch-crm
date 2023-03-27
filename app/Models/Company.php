<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Company extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * @var array<string>
     */
    protected $fillable = [
        'uuid',
        'name',
        'email',
        'phone',
        'website',
    ];
}

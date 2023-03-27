<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Contact extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * @var array<string>
     */
    protected $fillable = [
        'uuid',
        'title',
        'first_name',
        'middle_name',
        'last_name',
        'preferred_name',
        'email',
        'phone',
    ];
}

<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Project extends Model
{
    use HasUuid;
    use HasFactory;
    use SoftDeletes;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'name',
    ];

    /**
     * @return HasMany<Interaction>
     */
    public function interactions(): HasMany
    {
        return $this->hasMany(
            related: Interaction::class,
            foreignKey: 'project_id',
        );
    }
}

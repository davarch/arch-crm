<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Interaction extends Model
{
    use HasUuid;
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'type',
        'content',
        'user_id',
        'contact_id',
        'project_id',
    ];

    /**
     * @return BelongsTo<User, Interaction>
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'user_id',
        );
    }

    /**
     * @return BelongsTo<Contact, Interaction>
     */
    public function contact(): BelongsTo
    {
        return $this->belongsTo(
            related: Contact::class,
            foreignKey: 'contact_id',
        );
    }

    /**
     * @return BelongsTo<Project, Interaction>
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(
            related: Project::class,
            foreignKey: 'project_id',
        );
    }
}

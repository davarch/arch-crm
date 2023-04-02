<?php

declare(strict_types=1);

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use TiMacDonald\JsonApi\JsonApiResource;

/**
 * @property string $type
 * @property int $contact_id
 * @property ?string $content
 * @property ?int $project_id
 */
final class InteractionResource extends JsonApiResource
{
    /**
     * @return array<string, int|string|null>
     */
    public function toAttributes(Request $request): array
    {
        return [
            'type' => $this->type,
            'contact' => $this->contact_id,
            'content' => $this->content ?? '',
            'project' => $this->project_id ?? null,
        ];
    }
}

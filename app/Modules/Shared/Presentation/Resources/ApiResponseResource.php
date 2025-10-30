<?php

namespace Modules\Shared\Presentation\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Shared\Application\DTOs\MessageDTO;

class ApiResponseResource extends JsonResource
{
    private ?string $resourceClass;


    public function __construct($resource, ?string $resourceClass = null)
    {
        parent::__construct($resource);
        $this->resourceClass = $resourceClass;
    }

    public function toArray($request): array
    {
        if ($this->resource instanceof MessageDTO) {
            $payload = $this->resource->payload;

            if ($this->resourceClass) {
                if (is_array($payload)) {
                    $payload = $this->resourceClass::collection(collect($payload));
                } elseif ($payload !== null) {
                    $payload = new $this->resourceClass($payload);
                }
            }

            return [
                'success' => $this->resource->success,
                'code'    => $this->resource->code,
                'message' => $this->resource->message,
                'payload' => $payload
            ];
        }

        $payload = $this->resourceClass && is_array($this->resource)
            ? $this->resourceClass::collection(collect($this->resource))
            : $this->resource;

        return [
            'success' => true,
            'code'    => 200,
            'payload' => $payload
        ];
    }

    public function toResponse($request)
    {
        return response()->json($this->toArray($request));
    }
}
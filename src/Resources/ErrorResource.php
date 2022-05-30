<?php

namespace Petliakss\BudgetControl\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *   @OA\Xml(name="Error")
 * )
 */
class ErrorResource extends JsonResource
{
    /**
     * @OA\Property(
     *     title="Message",
     *     description="Error message",
     *     default="Not found"
     * )
     *
     * @var string
     */
    private string $message;

    /**
     * @var string $resource
     */
    public $resource;

    public function __construct($resource)
    {
        parent::__construct($resource);
    }

    public function toArray($request)
    {
        return [
            'message' => $this->resource
        ];
    }
}

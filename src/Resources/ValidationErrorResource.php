<?php

namespace Petliakss\BudgetControl\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *   @OA\Xml(name="ValidationError")
 * )
 */
class ValidationErrorResource extends JsonResource
{
    /**
     * @OA\Property(
     *     title="Message",
     *     description="Error message",
     *     default="Unprocessable Entity"
     * )
     *
     * @var string
     */
    private string $message;

    /**
     * @OA\Property(
     *     title="Errors",
     *     description="Errors array",
     *     type="object",
     *     @OA\Property(
     *          type="array",
     *          property="field_name",
     *          @OA\Items(
     *              type="string"
     *          )
     *     )
     * )
     *
     * @var array
     */
    private $errors;

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
            'message' => $this->resource,
            'errors' => [
                'field' => ['error message']
            ]
        ];
    }
}

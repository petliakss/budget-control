<?php

namespace Petliakss\BudgetControl\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Petliakss\BudgetControl\Models\Category;

/**
 * @OA\Schema(
 *   schema="CategoryItem",
 *   @OA\Xml(name="CategoryItem")
 * )
 */
class CategoryResource extends JsonResource
{
    /**
     * @OA\Property(
     *     title="ID",
     *     description="Category ID",
     *     default="1"
     * )
     * @var int
     */
    private int $id;

    /**
     * @OA\Property(
     *     title="Type ID",
     *     description="Category type ID",
     *     default="1-2"
     * )
     * @var integer
     */
    private int $type_id;

    /**
     * @OA\Property(
     *     title="Name",
     *     description="Category name",
     *     default="Some name"
     * )
     * @var string
     */
    private string $name;

    /**
     * @var Category $resource
     */
    public $resource;

    /**
     * CategoryResource constructor.
     * @param $resource
     */
    public function __construct($resource)
    {
        parent::__construct($resource);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'type_id' => $this->resource->type_id,
            'name' => $this->resource->name,
        ];
    }
}

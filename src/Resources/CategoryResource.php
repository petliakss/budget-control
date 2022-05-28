<?php

namespace Petliakss\BudgetControl\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Petliakss\BudgetControl\Models\Category;

class CategoryResource extends JsonResource
{
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

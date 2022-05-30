<?php

namespace Petliakss\BudgetControl\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Petliakss\BudgetControl\Models\Category;

/**
 * @OA\Schema(
 *   schema="BalanceItem",
 *   @OA\Xml(name="BalanceItem")
 * )
 */
class BalanceResource extends JsonResource
{
    /**
     * @OA\Property(
     *     title="Balance",
     *     description="Balance",
     *     default="1.00 or -1.00"
     * )
     * @var string
     */
    private string $balance;

    /**
     * @var string $resource
     */
    public $resource;

    /**
     * BalanceResource constructor.
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
            'balance' => $this->resource
        ];
    }
}

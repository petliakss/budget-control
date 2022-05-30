<?php

namespace Petliakss\BudgetControl\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Petliakss\BudgetControl\Models\PaymentsHistory;

/**
 * @OA\Schema(
 *   schema="PaymentsHistoryItem",
 *   @OA\Xml(name="PaymentsHistoryItem")
 * )
 */
class PaymentHistoryItemResource extends JsonResource
{
    /**
     * @OA\Property(
     *     title="ID",
     *     description="Item ID",
     *     default="1"
     * )
     * @var int
     */
    private int $id;

    /**
     * @OA\Property(
     *     title="Type ID",
     *     description="Item type ID",
     *     default="1"
     * )
     * @var int
     */
    private int $type_id;

    /**
     * @OA\Property(
     *     title="Type name",
     *     description="Item type name",
     *     default="Type name"
     * )
     * @var string
     */
    private string $type_name;

    /**
     * @OA\Property(
     *     title="Category ID",
     *     description="Item category ID",
     *     default="1"
     * )
     * @var int
     */
    private int $category_id;

    /**
     * @OA\Property(
     *     title="Category name",
     *     description="Category name",
     *     default="Category name"
     * )
     * @var string
     */
    private string $category_name;

    /**
     * @OA\Property(
     *     title="Is required",
     *     description="Is payment regular",
     *     default="false"
     * )
     * @var boolean
     */
    private bool $is_required;

    /**
     * @OA\Property(
     *     title="Sum",
     *     description="Item sum",
     *     default="1.00"
     * )
     * @var string
     */
    private string $sum;

    /**
     * @OA\Property(
     *     title="Comment",
     *     description="Item comment",
     *     default="Some comment or null",
     *     nullable=true
     * )
     * @var string
     */
    private string $comment;

    /**
     * @OA\Property(
     *     title="Created at",
     *     description="Item date",
     *     default="2022-02-24 05:30:00"
     * )
     * @var string
     */
    private string $created_at;
    /**
     * @var PaymentsHistory $resource
     */
    public $resource;

    /**
     * PaymentHistoryItemResource constructor.
     * @param $resource
     */
    public function __construct($resource)
    {
        parent::__construct($resource);
    }

    /**\
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'type_id' => $this->resource->type_id,
            'type_name' => $this->resource->type_id_name,
            'category_id' => $this->resource->category_id,
            'category_name' => $this->resource->category->name,
            'is_required' => $this->resource->is_required_string,
            'sum' => $this->resource->amount,
            'comment' => $this->resource->comment,
            'created_at' => Carbon::parse($this->resource->created_at)->format('d.m.Y'),
        ];
    }
}

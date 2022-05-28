<?php

namespace Petliakss\BudgetControl\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Petliakss\BudgetControl\Models\PaymentsHistory;

class PaymentHistoryItemResource extends JsonResource
{
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
            'sum' => $this->resource->sum,
            'comment' => $this->resource->comment,
            'created_at' => Carbon::parse($this->resource->id)->format('d.m.Y'),
        ];
    }
}

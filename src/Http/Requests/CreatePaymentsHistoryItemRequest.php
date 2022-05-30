<?php

namespace Petliakss\BudgetControl\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Petliakss\BudgetControl\Models\PaymentsHistoryModelInterface;

class CreatePaymentsHistoryItemRequest extends FormRequest implements PaymentsHistoryModelInterface
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'type_id' => ['required', 'numeric'],
            'sum' => ['required', 'numeric'],
            'category_id' => [
                'required',
                Rule::exists('categories', 'id')->where(function ($query) {
                    return $query->where('type_id', $this->getTypeId());
                }),
            ]
        ];
    }

    /**
     * @return int
     */
    public function getTypeId(): int
    {
        return $this->input('type_id');
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->input('category_id');
    }

    /**
     * @return boolean
     */
    public function getIsRequired(): bool
    {
        return (bool)$this->input('is_required', false);
    }

    /**
     * @return string|null
     */
    public function getComment(): ?string
    {
        return $this->input('comment', null);
    }

    /**
     * @return Carbon
     */
    public function getCreatedDate(): Carbon
    {
        return $this->has('created_date') ? Carbon::parse($this->input('created_date')) : now();
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return 1;
    }

    /**
     * @return float
     */
    public function getSum(): float
    {
        return convert_sum_for_db($this->input('sum'));
    }
}

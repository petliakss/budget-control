<?php

namespace Petliakss\BudgetControl\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Petliakss\BudgetControl\Interfaces\FiltersInterface;

class GetCategoriesItemsRequest extends FormRequest implements FiltersInterface
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
        return [];
    }

    /**
     * @return int|null
     */
    public function getTypeId(): ?int
    {
        return $this->input('type_id', null);
    }

    /**
     * @return string|null
     */
    public function getSearchString(): ?string
    {
        return $this->input('search_string', null);
    }

    /**
     * @return string|null
     */
    public function getSearchField(): ?string
    {
        return $this->input('search_field', config('pss_my_budget_config.filters.categories_default_search_field'));
    }

    /**
     * @return int|null
     */
    public function getItemsPerPage(): ?int
    {
        return $this->input('items_per_page', config('pss_my_budget_config.filters.items_per_page'));
    }

    /**
     * @return int
     */
    public function getItemsSkip(): int
    {
        return $this->input('items_skip', config('pss_my_budget_config.filters.items_skip'));
    }

    /**
     * @return string
     */
    public function getOrderByDirection(): string
    {
        return $this->input('order_by_direction', config('pss_my_budget_config.filters.order_by_direction'));
    }

    /**
     * @return string|null
     */
    public function getOrderByField(): ?string
    {
        return $this->input('order_by_field', config('pss_my_budget_config.filters.categories_order_by_field'));
    }

    /**
     * @return Carbon|null
     */
    public function getDateFrom(): ?Carbon
    {
        return null;
    }

    /**
     * @return Carbon|null
     */
    public function getDateTo(): ?Carbon
    {
        return null;
    }
}

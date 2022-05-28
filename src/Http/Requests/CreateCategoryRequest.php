<?php

namespace Petliakss\BudgetControl\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Petliakss\BudgetControl\Models\CategoryModelInterface;

class CreateCategoryRequest extends FormRequest implements CategoryModelInterface
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
            'type_id' => ['required', 'numeric', 'min:1', 'max:2'],
            'name' => ['required', 'string']
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
     * @return string
     */
    public function getName(): string
    {
        return $this->input('name');
    }
}

<?php

namespace Petliakss\BudgetControl\Services;

use Illuminate\Database\Eloquent\Collection;
use Petliakss\BudgetControl\Interfaces\FiltersInterface;
use Petliakss\BudgetControl\Models\Category;
use Petliakss\BudgetControl\Models\CategoryModelInterface;

class CategoryService implements CategoryServiceInterface
{
    /**
     * @param FiltersInterface $model
     * @return Collection
     */
    public function getItemsList(FiltersInterface $model): Collection
    {
        $typeId = $model->getTypeId();
        $searchString = $model->getSearchString();
        $itemsSkip = $model->getItemsSkip();
        $itemsPerPage = $model->getItemsPerPage();

        return Category::query()
            ->when($typeId !== null, function ($query) use($typeId) {
                $query->where('type_id', $typeId);
            })
            ->when($searchString !== null, function ($query) use($model) {
                $query->where($model->getSearchField(), $model->getSearchString());
            })
            ->when($itemsSkip > 0, function ($query) use ($itemsSkip) {
                $query->skip($itemsSkip);
            })
            ->when($itemsPerPage !== null, function ($query) use ($itemsPerPage) {
                $query->take($itemsPerPage);
            })
            ->orderBy($model->getOrderByField(), $model->getOrderByDirection())
            ->get();
    }

    /**
     * @param CategoryModelInterface $model
     * @return bool
     */
    public function create(CategoryModelInterface $model): bool
    {
        Category::create($model->all());
        return true;
    }

    /**
     * @param CategoryModelInterface $model
     * @param Category $category
     * @return bool
     */
    public function update(CategoryModelInterface $model, Category $category): bool
    {
        $category->fill($model->all());
        $category->save();
        return true;
    }
}

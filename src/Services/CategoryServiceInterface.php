<?php

namespace Petliakss\BudgetControl\Services;

use Illuminate\Database\Eloquent\Collection;
use Petliakss\BudgetControl\Interfaces\FiltersInterface;
use Petliakss\BudgetControl\Models\Category;
use Petliakss\BudgetControl\Models\CategoryModelInterface;

interface CategoryServiceInterface
{
    /**
     * @param FiltersInterface $model
     * @return Collection
     */
    public function getItemsList(FiltersInterface $model): Collection;

    /**
     * @param CategoryModelInterface $model
     * @return bool
     */
    public function create(CategoryModelInterface $model): bool;

    /**
     * @param CategoryModelInterface $model
     * @param Category $category
     * @return bool
     */
    public function update(CategoryModelInterface $model, Category $category): bool;
}

<?php

namespace Petliakss\BudgetControl\Services;

use Illuminate\Database\Eloquent\Collection;
use Petliakss\BudgetControl\Interfaces\FiltersInterface;
use Petliakss\BudgetControl\Models\PaymentsHistory;
use Petliakss\BudgetControl\Models\PaymentsHistoryModelInterface;

interface PaymentsHistoryServiceInterface
{
    /**
     * @param PaymentsHistoryModelInterface $model
     * @return bool
     */
    public function create(PaymentsHistoryModelInterface $model): bool;

    /**
     * @param PaymentsHistory $item
     * @param PaymentsHistoryModelInterface $model
     * @return bool
     */
    public function update(PaymentsHistory $item, PaymentsHistoryModelInterface $model): bool;

    /**
     * @param FiltersInterface $model
     * @return Collection
     */
    public function getItemsList(FiltersInterface $model): Collection;

    /**
     * @return string
     */
    public function getBalance(): string;
}

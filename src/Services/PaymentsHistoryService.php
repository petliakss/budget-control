<?php

namespace Petliakss\BudgetControl\Services;

use Illuminate\Database\Eloquent\Collection;
use Petliakss\BudgetControl\Interfaces\FiltersInterface;
use Petliakss\BudgetControl\Models\PaymentsHistory;
use Petliakss\BudgetControl\Models\PaymentsHistoryModelInterface;

class PaymentsHistoryService implements PaymentsHistoryServiceInterface
{
    /**
     * @param PaymentsHistoryModelInterface $model
     * @return bool
     */
    public function create(PaymentsHistoryModelInterface $model): bool
    {
        $paymentsHistoryItem = new PaymentsHistory();
        $paymentsHistoryItem->fill($model->all());
        $paymentsHistoryItem->sum = $model->getSum();
        $paymentsHistoryItem->is_required = $model->getIsRequired();
        $paymentsHistoryItem->user_id = $model->getUserId();
        $paymentsHistoryItem->created_at = $model->getCreatedDate();
        $paymentsHistoryItem->save();
        return true;
    }

    /**
     * @param PaymentsHistory $item
     * @param PaymentsHistoryModelInterface $model
     * @return bool
     */
    public function update(PaymentsHistory $item, PaymentsHistoryModelInterface $model): bool
    {
        $item->fill($model->all());
        $item->is_required = $model->getIsRequired();
        $item->save();
        return true;
    }

    /**
     * @param FiltersInterface $model
     * @return Collection
     */
    public function getItemsList(FiltersInterface $model): Collection
    {
        $typeId = $model->getTypeId();
        $searchString = $model->getSearchString();
        $dateFrom = $model->getDateFrom();
        $dateTo = $model->getDateTo();
        $itemsSkip = $model->getItemsSkip();
        $itemsPerPage = $model->getItemsPerPage();

        return PaymentsHistory::with('category')
            ->when($typeId !== null, function ($query) use ($typeId) {
                $query->where('type_id', $typeId);
            })
            ->when($searchString !== null, function ($query) use ($model) {
                $query->where($model->getSearchField(), 'like', '%'.$model->getSearchString().'%');
            })
            ->when(($dateFrom !== null && $dateTo !== null), function ($query) use ($model) {
                $query->whereBetween('created_at', [
                    $model->getDateFrom()->toDateTimeString(),
                    $model->getDateTo()->toDateTimeString()
                ]);
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
     * @return string
     */
    public function getBalance(): string
    {
        $result = PaymentsHistory::selectRaw("SUM(if(type_id = 1, sum, 0)) - SUM(if(type_id = 2, sum, 0)) as balance")
            ->first();
        return convert_sum_for_view($result->balance);
    }
}

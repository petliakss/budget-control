<?php

namespace Petliakss\BudgetControl\Interfaces;

use Carbon\Carbon;

interface FiltersInterface
{
    /**
     * @return int|null
     */
    public function getTypeId(): ?int;

    /**
     * @return string|null
     */
    public function getSearchString(): ?string;

    /**
     * @return string|null
     */
    public function getSearchField(): ?string;

    /**
     * @return int|null
     */
    public function getItemsPerPage(): ?int;

    /**
     * @return int
     */
    public function getItemsSkip(): int;

    /**
     * @return string
     */
    public function getOrderByDirection(): string;

    /**
     * @return string|null
     */
    public function getOrderByField(): ?string;

    /**
     * @return Carbon|null
     */
    public function getDateFrom(): ?Carbon;

    /**
     * @return Carbon|null
     */
    public function getDateTo(): ?Carbon;
}

<?php

namespace Petliakss\BudgetControl\Models;

use Carbon\Carbon;

interface PaymentsHistoryModelInterface
{
    /**
     * @return int
     */
    public function getTypeId(): int;

    /**
     * @return int
     */
    public function getCategoryId(): int;

    /**
     * @return int
     */
    public function getIsRequired(): int;

    /**
     * @return string|null
     */
    public function getComment(): ?string;

    /**
     * @return Carbon
     */
    public function getCreatedDate(): Carbon;

    /**
     * @return int
     */
    public function getUserId(): int;

    /**
     * @return float
     */
    public function getSum(): float;

    public function all();
}

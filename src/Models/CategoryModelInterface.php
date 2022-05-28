<?php

namespace Petliakss\BudgetControl\Models;

interface CategoryModelInterface
{
    /**
     * @return int
     */
    public function getTypeId(): int;

    /**
     * @return string
     */
    public function getName(): string;

    public function all();
}

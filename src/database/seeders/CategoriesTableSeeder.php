<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Petliakss\BudgetControl\Models\Category;
use Petliakss\BudgetControl\Models\PaymentsHistory;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        $categories = [
            [
                'name' => 'Зарплатня',
                'type_id' => PaymentsHistory::TYPE_INCOMES
            ],
            [
                'name' => 'Інше',
                'type_id' => PaymentsHistory::TYPE_INCOMES
            ],
            [
                'name' => 'Інше',
                'type_id' => PaymentsHistory::TYPE_OUTCOMES
            ],
            [
                'name' => 'Житло',
                'type_id' => PaymentsHistory::TYPE_OUTCOMES
            ],
            [
                'name' => 'Їжа',
                'type_id' => PaymentsHistory::TYPE_OUTCOMES
            ],
            [
                'name' => 'Одяг',
                'type_id' => PaymentsHistory::TYPE_OUTCOMES
            ],
            [
                'name' => 'Машина',
                'type_id' => PaymentsHistory::TYPE_OUTCOMES
            ],
            [
                'name' => 'Розваги',
                'type_id' => PaymentsHistory::TYPE_OUTCOMES
            ]
        ];
        Category::insert($categories);
    }
}

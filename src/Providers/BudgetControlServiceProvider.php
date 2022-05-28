<?php

namespace Petliakss\BudgetControl\Providers;

use Petliakss\BudgetControl\Services\CategoryService;
use Petliakss\BudgetControl\Services\CategoryServiceInterface;
use Petliakss\BudgetControl\Services\PaymentsHistoryService;
use Petliakss\BudgetControl\Services\PaymentsHistoryServiceInterface;

class BudgetControlServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/pss_budget_control_config.php', 'pss_my_budget_config');
        $this->loadRoutesFrom(__DIR__ . '/../routes/pss_budget_control_api.php');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->publishes([
            __DIR__ . '/../database/seeders/CategoriesTableSeeder.php' => database_path('seeders/CategoriesTableSeeder.php'),
        ]);

        $this->publishes([
            __DIR__ . '/../config/pss_budget_control_config.php' => config_path('pss_budget_control_config.php'),
        ]);
    }

    public function register()
    {
        $this->app->bind(PaymentsHistoryServiceInterface::class, PaymentsHistoryService::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
        $this->app->make('Petliakss\BudgetControl\Http\Controllers\PaymentsHistoryController');
        $this->app->make('Petliakss\BudgetControl\Http\Controllers\CategoryController');
    }
}

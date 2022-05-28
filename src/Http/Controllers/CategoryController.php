<?php

namespace Petliakss\BudgetControl\Http\Controllers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Petliakss\BudgetControl\Http\Requests\CreateCategoryRequest;
use Petliakss\BudgetControl\Http\Requests\CreatePaymentsHistoryItemRequest;
use Petliakss\BudgetControl\Http\Requests\GetCategoriesItemsRequest;
use Petliakss\BudgetControl\Models\Category;
use Petliakss\BudgetControl\Resources\CategoryResource;
use Petliakss\BudgetControl\Services\CategoryServiceInterface;

class CategoryController extends Controller
{
    /**
     * @var CategoryServiceInterface $categoryService
     */
    private CategoryServiceInterface $categoryService;

    /**
     * CategoryController constructor.
     * @param CategoryServiceInterface $categoryService
     */
    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * @param CreateCategoryRequest $request
     * @return Response
     */
    public function store(CreateCategoryRequest $request): Response
    {
        $this->categoryService->create($request);
        return response('Created', 201);
    }

    /**
     * @param CreateCategoryRequest $request
     * @param Category $category
     * @return Response
     */
    public function update(CreateCategoryRequest $request, Category $category): Response
    {
        $this->categoryService->update($request, $category);
        return response('Updated', 201);
    }

    /**
     * @param Category $category
     * @return Response
     */
    public function destroy(Category $category): Response
    {
        $category->delete();
        return response('Deleted', 204);
    }

    /**
     * @param Category $category
     * @return JsonResource
     */
    public function show(Category $category): JsonResource
    {
        return CategoryResource::make($category);
    }

    /**
     * @param GetCategoriesItemsRequest $request
     * @return CategoryResource
     */
    public function index(GetCategoriesItemsRequest $request): JsonResource
    {
        $items = $this->categoryService->getItemsList($request);
        return CategoryResource::collection($items);
    }
}

<?php

namespace Petliakss\BudgetControl\Http\Controllers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Petliakss\BudgetControl\Http\Requests\CreateCategoryRequest;
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
     * @OA\Post (
     *     path="/api/pss_budget_control/v1/categories/store",
     *     summary="Create category item",
     *     tags={"Categories"},
     *     description="Create category item.",
     *     operationId="createCategoryItem",
     *     @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/x-www-form-urlencoded",
     *           @OA\Schema(
     *               type="object",
     *               required={
     *                  "type_id",
     *                  "name"
     *               },
     *               @OA\Property(
     *                   property="type_id",
     *                   description="Category type ID (1 - incomes, 2 - outcomes)",
     *                   type="integer"
     *               ),
     *               @OA\Property(
     *                   property="name",
     *                   description="Category name",
     *                   type="string"
     *               )
     *           )
     *       )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Entity",
     *         @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/ValidationErrorResource"
     *          ),
     *     ),
     * )
     * @param CreateCategoryRequest $request
     * @return Response
     */
    public function store(CreateCategoryRequest $request): Response
    {
        $this->categoryService->create($request);
        return response('', 201);
    }

    /**
     * @OA\Put (
     *     path="/api/pss_budget_control/v1/categories/{category}/update",
     *     summary="Update category item",
     *     tags={"Categories"},
     *     description="Update category item.",
     *     operationId="updateCategoryItem",
     *     @OA\Parameter(
     *         name="category",
     *         in="path",
     *         description="Category ID",
     *         required=true,
     *         @OA\Schema(
     *           type="integer"
     *         ),
     *         style="form"
     *     ),
     *     @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/x-www-form-urlencoded",
     *           @OA\Schema(
     *               type="object",
     *               required={
     *                  "type_id",
     *                  "name"
     *               },
     *               @OA\Property(
     *                   property="type_id",
     *                   description="Category type ID (1 - incomes, 2 - outcomes)",
     *                   type="integer"
     *               ),
     *               @OA\Property(
     *                   property="name",
     *                   description="Category name",
     *                   type="string"
     *               )
     *           )
     *       )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Wrong category ID",
     *         @OA\JsonContent(
     *             type="object",
     *             ref="#/components/schemas/ErrorResource"
     *         ),
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Entity",
     *         @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/ValidationErrorResource"
     *          ),
     *     ),
     * )
     * @param CreateCategoryRequest $request
     * @param Category $category
     * @return Response
     */
    public function update(CreateCategoryRequest $request, Category $category): Response
    {
        $this->categoryService->update($request, $category);
        return response('', 201);
    }

    /**
     * @OA\Delete (
     *     path="/api/pss_budget_control/v1/categories/{category}/delete",
     *     summary="Delete category item",
     *     tags={"Categories"},
     *     description="Delete category item.",
     *     operationId="deleteCategoryItem",
     *     @OA\Parameter(
     *         name="category",
     *         in="path",
     *         description="Category ID",
     *         required=true,
     *         @OA\Schema(
     *           type="integer"
     *         ),
     *         style="form"
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Successful operation",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Wrong category ID",
     *         @OA\JsonContent(
     *             type="object",
     *             ref="#/components/schemas/ErrorResource"
     *         ),
     *     )
     * )
     * @param Category $category
     * @return Response
     */
    public function destroy(Category $category): Response
    {
        $category->delete();
        return response('', 204);
    }

    /**
     * @OA\Get(
     *     path="/api/pss_budget_control/v1/categories/{category}",
     *     summary="Get category item",
     *     tags={"Categories"},
     *     description="Get category item.",
     *     operationId="getCategoryItem",
     *     @OA\Parameter(
     *         name="category",
     *         in="path",
     *         description="Category ID",
     *         required=true,
     *         @OA\Schema(
     *           type="integer"
     *         ),
     *         style="form"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  ref="#/components/schemas/CategoryItem"
     *              )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Wrong category ID",
     *         @OA\JsonContent(
     *             type="object",
     *             ref="#/components/schemas/ErrorResource"
     *         ),
     *     ),
     * )
     * @param Category $category
     * @return JsonResource
     */
    public function show(Category $category): JsonResource
    {
        return CategoryResource::make($category);
    }

    /**
     * @OA\Get(
     *     path="/api/pss_budget_control/v1/categories/list",
     *     summary="Get categories list",
     *     tags={"Categories"},
     *     description="Get categories list.",
     *     operationId="getCategoriesList",
     *     @OA\Parameter(
     *         name="search_string",
     *         description="Search string for category name",
     *         in="query",
     *         description="Search string for category name",
     *         required=false,
     *         @OA\Schema(
     *           type="string"
     *         ),
     *         style="form",
     *         example="Example category"
     *     ),
     *     @OA\Parameter(
     *         name="type_id",
     *         description="Category type ID (1 - incomes, 2 - outcomes)",
     *         in="query",
     *         description="Category type ID",
     *         required=false,
     *         @OA\Schema(
     *           type="integer"
     *         ),
     *         style="form",
     *         example="1"
     *     ),
     *     @OA\Parameter(
     *         name="items_per_page",
     *         in="query",
     *         description="Amount of categories for limit",
     *         required=false,
     *         @OA\Schema(
     *           type="integer"
     *         ),
     *         style="form",
     *         example="10"
     *     ),
     *     @OA\Parameter(
     *         name="items_skip",
     *         in="query",
     *         description="Amount of categories for skip",
     *         required=false,
     *         @OA\Schema(
     *           type="integer"
     *         ),
     *         style="form",
     *         example="0"
     *     ),
     *     @OA\Parameter(
     *         name="order_by_direction",
     *         in="query",
     *         description="Categories ordering direction",
     *         required=false,
     *         @OA\Schema(
     *           type="string"
     *         ),
     *         style="form",
     *         example="DESC or ASC"
     *     ),
     *     @OA\Parameter(
     *         name="order_by_field",
     *         in="query",
     *         description="Categories ordering fied",
     *         required=false,
     *         @OA\Schema(
     *           type="string"
     *         ),
     *         style="form",
     *         example="id, name"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(ref="#/components/schemas/CategoryItem")
     *              )
     *          )
     *     ),
     * )
     */
    public function index(GetCategoriesItemsRequest $request): JsonResource
    {
        $items = $this->categoryService->getItemsList($request);
        return CategoryResource::collection($items);
    }
}

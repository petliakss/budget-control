<?php

namespace Petliakss\BudgetControl\Http\Controllers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Petliakss\BudgetControl\Http\Requests\CreatePaymentsHistoryItemRequest;
use Petliakss\BudgetControl\Http\Requests\GetPaymentsHistoryItemsRequest;
use Petliakss\BudgetControl\Models\PaymentsHistory;
use Petliakss\BudgetControl\Resources\BalanceResource;
use Petliakss\BudgetControl\Resources\PaymentHistoryItemResource;
use Petliakss\BudgetControl\Services\PaymentsHistoryServiceInterface;

class PaymentsHistoryController extends Controller
{
    private PaymentsHistoryServiceInterface $paymentsHistoryService;

    /**
     * PaymentsHistoryController constructor.
     * @param PaymentsHistoryServiceInterface $paymentsHistoryService
     */
    public function __construct(PaymentsHistoryServiceInterface $paymentsHistoryService)
    {
        $this->paymentsHistoryService = $paymentsHistoryService;
    }

    /**
     * @OA\Post (
     *     path="/api/pss_budget_control/v1/payments_history/store",
     *     summary="Create payments history item",
     *     tags={"Payments history"},
     *     description="Create payments history item.",
     *     operationId="createPaymentsHistoryItem",
     *     @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/x-www-form-urlencoded",
     *           @OA\Schema(
     *               type="object",
     *               required={
     *                  "type_id",
     *                  "sum",
     *                  "category_id"
     *               },
     *               @OA\Property(
     *                   property="type_id",
     *                   description="Category type ID (1 - incomes, 2 - outcomes)",
     *                   type="integer",
     *                   example="1 or 2"
     *               ),
     *               @OA\Property(
     *                   property="sum",
     *                   description="Payment sum (1 or 1.00)",
     *                   type="numeric",
     *                   example="1 or 1.00"
     *               ),
     *               @OA\Property(
     *                   property="category_id",
     *                   description="Category ID",
     *                   type="int",
     *                   example="1"
     *               ),
     *               @OA\Property(
     *                   property="is_required",
     *                   description="Is this payment regular",
     *                   type="bool",
     *                   example="false"
     *               ),
     *               @OA\Property(
     *                   property="comment",
     *                   description="Comment for payment",
     *                   type="string",
     *                   example="Some comment"
     *               ),
     *               @OA\Property(
     *                   property="created_date",
     *                   description="Payment date",
     *                   type="string",
     *                   example="2022-02-24 05:30:00"
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
     * @param CreatePaymentsHistoryItemRequest $request
     * @return Response
     */
    public function store(CreatePaymentsHistoryItemRequest $request): Response
    {
        $this->paymentsHistoryService->create($request);
        return response('', 201);
    }

    /**
     * @OA\Put (
     *     path="/api/pss_budget_control/v1/payments_history/{item}/update",
     *     summary="Update payments history item",
     *     tags={"Payments history"},
     *     description="Update payments history item.",
     *     operationId="updatePaymentsHistoryItem",
     *     @OA\Parameter(
     *         name="item",
     *         in="path",
     *         description="Payments history item ID",
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
     *                  "sum",
     *                  "category_id"
     *               },
     *               @OA\Property(
     *                   property="type_id",
     *                   description="Category type ID (1 - incomes, 2 - outcomes)",
     *                   type="integer",
     *                   example="1 or 2"
     *               ),
     *               @OA\Property(
     *                   property="sum",
     *                   description="Payment sum (1 or 1.00)",
     *                   type="numeric",
     *                   example="1 or 1.00"
     *               ),
     *               @OA\Property(
     *                   property="category_id",
     *                   description="Category ID",
     *                   type="int",
     *                   example="1"
     *               ),
     *               @OA\Property(
     *                   property="is_required",
     *                   description="Is this payment regular",
     *                   type="bool",
     *                   example="false"
     *               ),
     *               @OA\Property(
     *                   property="comment",
     *                   description="Comment for payment",
     *                   type="string",
     *                   example="Some comment"
     *               ),
     *               @OA\Property(
     *                   property="created_date",
     *                   description="Payment date",
     *                   type="string",
     *                   example="2022-02-24 05:30:00"
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
     *         description="Wrong item ID",
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
     * @param CreatePaymentsHistoryItemRequest $request
     * @param PaymentsHistory $item
     * @return Response
     */
    public function update(CreatePaymentsHistoryItemRequest $request, PaymentsHistory $item): Response
    {
        $this->paymentsHistoryService->update($item, $request);
        return response('', 201);
    }

    /**
     * @OA\Delete (
     *     path="/api/pss_budget_control/v1/payments_history/{item}/delete",
     *     summary="Delete payments history item",
     *     tags={"Payments history"},
     *     description="Delete payments history item.",
     *     operationId="deletePaymentsHistoryItem",
     *     @OA\Parameter(
     *         name="item",
     *         in="path",
     *         description="Payments history item ID",
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
     *         description="Wrong item ID",
     *         @OA\JsonContent(
     *             type="object",
     *             ref="#/components/schemas/ErrorResource"
     *         ),
     *     ),
     * )
     * @param PaymentsHistory $item
     * @return Response
     */
    public function destroy(PaymentsHistory $item): Response
    {
        $item->delete();
        return response('Deleted', 204);
    }

    /**
     * @OA\Get(
     *     path="/api/pss_budget_control/v1/payments_history/{item}",
     *     summary="Get payments history item",
     *     tags={"Payments history"},
     *     description="Get payments history item.",
     *     operationId="getPaymentsHistoryItem",
     *     @OA\Parameter(
     *         name="item",
     *         in="path",
     *         description="Payments history item ID",
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
     *                  ref="#/components/schemas/PaymentsHistoryItem"
     *              )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Wrong item ID",
     *         @OA\JsonContent(
     *             type="object",
     *             ref="#/components/schemas/ErrorResource"
     *         ),
     *     ),
     * )
     * @param PaymentsHistory $item
     * @return JsonResource
     */
    public function show(PaymentsHistory $item): JsonResource
    {
        return PaymentHistoryItemResource::make($item);
    }

    /**
     * @OA\Get(
     *     path="/api/pss_budget_control/v1/payments_history/balance",
     *     summary="Get payments history balance",
     *     tags={"Payments history"},
     *     description="Get payments history balance.",
     *     operationId="getPaymentsHistoryBalance",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  ref="#/components/schemas/BalanceItem"
     *              )
     *         )
     *     ),
     * )
     * @return JsonResource
     */
    public function balance(): JsonResource
    {
        $balance = $this->paymentsHistoryService->getBalance();
        return BalanceResource::make($balance);
    }

    /**
     * @OA\Get(
     *     path="/api/pss_budget_control/v1/payments_history/list",
     *     summary="Get payments history",
     *     tags={"Payments history"},
     *     description="Get payments history.",
     *     operationId="getPaymentsHistory",
     *     @OA\Parameter(
     *         name="search_string",
     *         description="Search string for item comment",
     *         in="query",
     *         description="Search string for item comment",
     *         required=false,
     *         @OA\Schema(
     *           type="string"
     *         ),
     *         style="form",
     *         example="Example"
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
     *         description="Amount of items for limit",
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
     *         description="Amount of items for skip",
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
     *         description="Items ordering direction",
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
     *         description="Items ordering fied",
     *         required=false,
     *         @OA\Schema(
     *           type="string"
     *         ),
     *         style="form",
     *         example="id, sum"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(ref="#/components/schemas/PaymentsHistoryItem")
     *              )
     *         )
     *     )
     * )
     * @param GetPaymentsHistoryItemsRequest $request
     * @return JsonResource
     */
    public function index(GetPaymentsHistoryItemsRequest $request): JsonResource
    {
        $items = $this->paymentsHistoryService->getItemsList($request);
        return PaymentHistoryItemResource::collection($items);
    }
}

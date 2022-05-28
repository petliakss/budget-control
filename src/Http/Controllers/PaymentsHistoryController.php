<?php

namespace Petliakss\BudgetControl\Http\Controllers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Petliakss\BudgetControl\Http\Requests\CreatePaymentsHistoryItemRequest;
use Petliakss\BudgetControl\Http\Requests\GetPaymentsHistoryItemsRequest;
use Petliakss\BudgetControl\Models\PaymentsHistory;
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
     * @param GetPaymentsHistoryItemsRequest $request
     * @return JsonResource
     */
    public function index(GetPaymentsHistoryItemsRequest $request): JsonResource
    {
        $items = $this->paymentsHistoryService->getItemsList($request);
        return PaymentHistoryItemResource::collection($items);
    }

    /**
     * @param CreatePaymentsHistoryItemRequest $request
     * @return Response
     */
    public function store(CreatePaymentsHistoryItemRequest $request): Response
    {
        $this->paymentsHistoryService->create($request);
        return response('Created', 201);
    }

    /**
     * @param CreatePaymentsHistoryItemRequest $request
     * @param PaymentsHistory $item
     * @return Response
     */
    public function update(CreatePaymentsHistoryItemRequest $request, PaymentsHistory $item): Response
    {
        $this->paymentsHistoryService->update($item, $request);
        return response('Updated', 201);
    }

    /**
     * @param PaymentsHistory $item
     * @return Response
     */
    public function destroy(PaymentsHistory $item): Response
    {
        $item->delete();
        return response('Deleted', 204);
    }

    /**
     * @param PaymentsHistory $item
     * @return JsonResource
     */
    public function show(PaymentsHistory $item): JsonResource
    {
        return PaymentHistoryItemResource::make($item);
    }

    /**
     * @return float
     */
    public function balance(): float
    {
        return $this->paymentsHistoryService->getBalance();
    }
}

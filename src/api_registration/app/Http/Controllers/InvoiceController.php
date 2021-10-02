<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\InvoiceCreateRequest;
use App\Http\Requests\InvoiceUpdateRequest;
use App\Repositories\InvoiceRepository;
use App\Validators\InvoiceValidator;

/**
 * Class InvoiceController.
 *
 * @package namespace App\Http\Controllers;
 */
class InvoiceController extends Controller
{
    /**
     * @var InvoiceRepository
     */
    protected $repository;

    /**
     * InvoiceController constructor.
     *
     * @param InvoiceRepository $repository
     */
    public function __construct(InvoiceRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $invoices = $this->repository->all();
        return response()->json([
            'data' => $invoices,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $transactions = $this->repository->find($id);
        $summary = $this->repository->findInvoiceSummary($id);

        return response()->json([
            'transactions' => $transactions,
            'summary' => $summary
        ]);

    }
}

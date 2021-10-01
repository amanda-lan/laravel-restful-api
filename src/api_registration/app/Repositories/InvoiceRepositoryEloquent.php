<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\InvoiceRepository;
use App\Models\Invoice;
use App\Validators\InvoiceValidator;

/**
 * Class InvoiceRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class InvoiceRepositoryEloquent extends BaseRepository implements InvoiceRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Invoice::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function all($columns = ['*'])
    {
        try {
            return DB::table('invoices')
                ->select(DB::raw('invoiced, invoice_no, sum(amount_net) total_amount_net, sum(amount_gst) total_amount_gst, client_id, count(contract_id) contract_id'))
                ->groupByRaw('invoice_no, invoiced, client_id')
                ->get();
        } catch (\Exception $e) {
            Log::debug("Group invoice query failed: " . $e->getMessage());
        }
    }

    public function find($id, $columns = ['*'])
    {
        try {
            return $this->findByField('invoice_no', $id);
        } catch (\Exception $e) {
            Log::debug("Single invoice query failed: " . $e->getMessage());
        }
    }

}

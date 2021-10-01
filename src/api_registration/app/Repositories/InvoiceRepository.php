<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface InvoiceRepository.
 *
 * @package namespace App\Repositories;
 */
interface InvoiceRepository extends RepositoryInterface
{
    public function all($columns = ['*']);

    public function find($id, $columns = ['*']);
}

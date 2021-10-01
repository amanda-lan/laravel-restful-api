<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Invoice;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $invoices = Invoice::get();
        foreach ($invoices as $invoice) {
            $desc = explode(' ', $invoice->description);
            $invoice->registration = array_pop($desc);
            $invoice->save();
        }
    }
}

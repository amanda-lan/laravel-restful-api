<?php

namespace Tests\Unit;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvoiceTest extends TestCase
{
    use HasFactory;

    public function testInvoiceIndexSuccessfully()
    {
        $this->json('GET', 'api/invoices')
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'invoiced',
                        'invoice_no',
                        'total_amount_net',
                        'total_amount_gst',
                        'client_id',
                        'contract_id'
                    ]
                ]
            ]);
    }

    public function testInvoiceShowSuccessfully()
    {
        $invoice = Invoice::first();
        $this->json('GET', 'api/invoices/' . $invoice->invoice_no)
            ->assertStatus(200)
            ->assertJsonStructure([
                'transactions' => [
                    '*' => [
                        "id",
                        "client_id",
                        "contract_id",
                        "invoice_no",
                        "description",
                        "amount_net",
                        "amount_gst",
                        "amount_gross",
                        "invoiced",
                        "created",
                        "modified",
                        "registration"
                    ]
                ],
                'summary' => [
                    '*' => [
                        'invoiced',
                        'invoice_no',
                        'total_amount_net',
                        'total_amount_gst',
                        'client_id',
                        'contract_id'
                    ]
                ]
        ]);
    }
}

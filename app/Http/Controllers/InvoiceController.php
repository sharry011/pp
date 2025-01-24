<?php 
namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'project_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'price' => 'required|numeric',
        ]);

        $invoice = Invoice::create($validated);

        return view('invoices.show', compact('invoice'));
    }

    public function downloadPDF($id)
    {
        $invoice = Invoice::find($id);

        $pdf = Pdf::loadView('invoices.pdf', compact('invoice'));
        return $pdf->download('invoice_' . $invoice->id . '.pdf');
    }
}

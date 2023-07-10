<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('invoices.index', [
            'invoices' => Invoice::with('user')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('invoices.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request); 
        $invoice = new Invoice;

        $invoice->user_id = $request->user()->id;
        $invoice->invoice_date = $request->invoice_date;
        $invoice->invoice_no = $request->invoice_number;
        $invoice->customer_name = $request->customer_name;
        $invoice->phone = $request->phone;
        $invoice->email = $request->email;
        $invoice->billing_address = $request->billing_address;
        $invoice->shipping_address = $request->shipping_address;
        $invoice->total = $request->total_amount;
        $invoice->note = $request->note;
        $invoice->merchant_name = $request->merchant_name;
        $invoice->status = 'Pending';
        $invoice->pdf_name = session('pdfFileName');

        $invoice->save();

        foreach ($request['item_details'] as $index => $item) {
            $item = new InvoiceItem;

            $item->invoice_id = $invoice->id;
            $item->item_name = $request->item_details[$index]['name'];
            $item->quantity = $request->item_details[$index]['quantity'];
            $item->unit_price = $request->item_details[$index]['unit_price'];
            $item->amount = $request->item_details[$index]['amount'];

            $item->save();
        }

        Session::forget(['pdfFileName', 'pdfData']);

        return redirect('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice): View
    {
        return view('invoices.show', compact('invoice'), [
            'invoices' => Invoice::with('items')->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'status' => 'required|in:Completed,Pending',
        ]);
    
        $invoice->status = $request->status;
        $invoice->save();
    
        return redirect()->route('invoices.index')->with('success', 'Status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
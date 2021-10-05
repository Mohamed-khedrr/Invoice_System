<?php

namespace App\Http\Controllers;

use App\invoice_attachments;
use App\Invoice_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Invoice;

class InvoiceDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $invoices = Invoice::find($id);
        $details = Invoice_details::where('id_invoice', $id)->get();
        $attachments = invoice_attachments::where('invoice_id', $id)->get();
        return view('invoices/invoice_details', compact('invoices', 'details', 'attachments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file;
        $file_name = $file->getClientOriginalName();
        invoice_attachments::create([
            'invoice_number' => $request->invoice_number,
            'invoice_id' => $request->invoice_id,
            'creared_by' => (Auth::user()->name),
            'file_name' => $file_name
        ]);
        $file->move(public_path('Attachments/' . $request->invoice_number), $file_name);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice_details  $invoice_details
     * @return \Illuminate\Http\Response
     */
    public function show($invoices, $attach)
    {
        return view("show_attach", compact('invoices', 'attach'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice_details  $invoice_details
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice_details $invoice_details)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice_details  $invoice_details
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice_details $invoice_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice_details  $invoice_details
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $invoice = invoice_attachments::findOrFail($request->id);
        $invoice->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number . '/' . $request->file_name);

        return redirect()->back();
    }



    public function open_file($invoice_number, $file_name)
    {
        $file = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number . '/' . $file_name);
        return response()->file($file);
    }


    public function download_file($invoice_number, $file_name)
    {
        $contents = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number . '/' . $file_name);
        return response()->download($contents);
    }
}

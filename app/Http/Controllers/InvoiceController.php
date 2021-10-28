<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\invoice_attachments;
use App\Invoice_details;
use App\Notifications\add_invoice;
use App\Section;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::all();
        return view('invoices/invoices', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = Section::all();
        return view('invoices/add_invoice', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validate = $request->validate([
        //     'invoice_number' => "required",
        //     'invoice_date' => "required",
        //     'due_date' => "required",
        //     'product' => "required",
        //     'section_id' => "required",
        //     'amount_collection' => "required",
        //     'amount_Commission' => "required",
        //     'discount' => "required",
        //     'value_vat' => "required",
        //     'rate_vat' => "required",
        //     'total' => "required",
        //     'note' => "required"

        // ]);


        Invoice::create([
            'invoice_number' => $request->invoice_number,
            'invoice_date' => $request->invoice_Date,
            'due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'amount_collection' => $request->Amount_collection,
            'amount_Commission' => $request->Amount_Commission,
            'discount' => $request->Discount,
            'value_vat' => $request->Value_VAT,
            'rate_vat' => $request->Rate_VAT,
            'total' => $request->Total,
            'note' => $request->note,
            'status' => 'غير مدفوعة',
            'value_status' => '3'
        ]);

        $invoice_id = Invoice::latest()->first()->id;
        Invoice_details::create([
            'id_invoice' => $invoice_id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'section' => $request->Section,
            'note' => $request->note,
            'user' => (Auth::user()->name),
            'value_status' => '3',
            'status' => 'غير مدفوعة'
        ]);

        $image = $request->file('pic');
        $file_name = $image->getClientOriginalName();

        invoice_attachments::create([
            'invoice_number' => $request->invoice_number,
            'file_name' => $file_name,
            'creared_by' => (Auth::user()->name),
            'invoice_id' => $invoice_id
        ]);


        $request->pic->move(public_path('Attachments/' . $request->invoice_number), $file_name);

        // $user = User::first();
        // Notification::send($user, new add_invoice($invoice_id));

        $user = user::get();
        // $user = Auth::user();
        $invoice = Invoice::latest()->first();
        // $user->notification(new Add_invoice($invoice));
        Notification::send($user, new Add_invoice($invoice));



        session()->flash('add_invoice', 'تم حفظ الفاتورة بنجاح');
        return redirect()->route('invoices.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice = Invoice::findOrFail($id);
        $sections = Section::all();
        return view('invoices/edit_invoice', compact('sections', 'invoice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        Invoice_details::where('invoice_number', $invoice->invoice_number)->update([
            'invoice_number' => $request->invoice_number
        ]);
        invoice_attachments::where('invoice_number', $invoice->invoice_number)->update([
            'invoice_number' => $request->invoice_number
        ]);

        $invoice->invoice_number =  $request->invoice_number;
        $invoice->invoice_date = $request->invoice_Date;
        $invoice->due_date = $request->Due_date;
        $invoice->product  = $request->product;
        $invoice->section_id  = $request->Section;
        $invoice->amount_collection  = $request->Amount_collection;
        $invoice->amount_Commission  = $request->Amount_Commission;
        $invoice->discount =  $request->Discount;
        $invoice->value_vat =  $request->Value_VAT;
        $invoice->rate_vat  = $request->Rate_VAT;
        $invoice->total =  $request->Total;
        $invoice->note =  $request->note;
        $invoice->value_status = $request->value_status;

        if ($request->value_status == 1) {
            $invoice->status = 'مدفوعة';
        } elseif ($request->value_status == 2) {
            $invoice->status = 'مدفوعة جزئيا';
        } elseif ($request->value_status == 3) {
            $invoice->status = 'غير مدفوعة';
        }

        $invoice->save();
        session()->flash('update', 'تم التعديل');
        return redirect()->route('invoices.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Invoice::findOrFail($request->id)->forceDelete();
        $attach = invoice_attachments::where('invoice_id', $request->id)->first();

        if (!empty($attach)) {
            Storage::disk('public_uploads')->deleteDirectory($attach->invoice_number);
        }

        session()->flash('delete_invoice', 'تم الحذف');
        return redirect()->route('invoices.index');
    }


    public function getproducts($id)
    {
        $products = DB::table("products")->where("section_id", $id)->pluck("product_name", "id");
        return json_encode($products);
    }



    public function status_show(Invoice $invoice)
    {
        $sections = Section::all();

        return view('invoices/status_update', compact('invoice', 'sections'));
    }

    public function update_status(Request $request, $invoice)
    {
        $invoice = Invoice::findOrFail($invoice);
        $value_status = $request->value_status;
        if ($value_status == 1) {
            $invoice->status = 'مدفوعة';
        } elseif ($value_status == 2) {
            $invoice->status = 'مدفوعة جزئيا';
        } elseif ($value_status == 3) {
            $invoice->status = 'غير مدفوعة';
        }
        $invoice->value_status = $value_status;
        $invoice->payment_date = $request->payment_date;
        $invoice->save();

        Invoice_details::create([
            'id_invoice' => $invoice->id,
            'invoice_number' => $invoice->invoice_number,
            'product' => $invoice->product,
            'section' => $invoice->section_id,
            'user' => (Auth::user()->name),
            'value_status' => $invoice->value_status,
            'status' => $invoice->status,
            'payment_date' => $request->payment_date
        ]);
        session()->flash('Status_Update', 'تم تعديل حالة الدفع ');
        return redirect()->route('invoices.index');
    }


    public function paid()
    {
        $invoices = Invoice::where('value_status', '1')->get();
        return view('invoices/paid_invoices', compact('invoices'));
    }

    public function unpaid()
    {
        $invoices = Invoice::where('value_status', '3')->get();
        return view('invoices/paid_invoices', compact('invoices'));
    }

    public function part_paid()
    {
        $invoices = Invoice::where('value_status', '2')->get();
        return view('invoices/part_paid', compact('invoices'));
    }

    public function archive(Request $request)
    {
        Invoice::findOrFail($request->id)->delete();
        return redirect()->back();
    }

    public function show_archive()
    {
        $invoices = Invoice::onlyTrashed()->get();
        return view('invoices/invoice_archive', compact('invoices'));
    }


    public function unArchive(Request $request)
    {
        Invoice::withTrashed()->findOrFail($request->id)->restore();
        return redirect()->back();
    }
}

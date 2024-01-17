<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceRequest;
use App\Models\Invoice;
use App\Models\ItemInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:invoice-list', ['only' => ['index']]);
        $this->middleware('permission:invoice-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:invoice-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:invoice-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        // dd(Invoice::with('item_invoice')->get());
        // $data = Invoice::with('item_invoice')->latest()->get();
        // dd($data->item_invoice->get());
        if ($request->ajax()) {
            if (!empty($request->from_date)) {
                $data = Invoice::with('item_invoice')->whereBetween(
                    DB::raw('DATE(created_at)'),
                    array($request->from_date, $request->to_date)
                );
            } else {
                $data = Invoice::with('item_invoice')->latest();
            }
            // $data = Invoice::latest();
            return DataTables::of($data)
                ->addIndexColumn('DT_RowIndex')
                ->addColumn('description', function ($data) {
                    return $data->item_invoice->all();
                })
                ->addColumn('item_invoice', function ($data) {
                    return $data->item_invoice->all();
                })
                ->addColumn('created_at', function ($data) {
                    return $data->created_at->format('Y-m-d');
                })
                ->addColumn('action', function ($data) {
                    $id                     = $data->id;
                    $url_edit               = route('invoice.edit', $id);
                    // $url_show               = route('invoice.show', $id);
                    $url_delete             = route('invoice.destroy', $id);
                    $url_printInvoice       = route('invoice.printInvoice', $id);

                    $edit     = '<a href="' . $url_edit . '" class="dropdown-item" data-toggle="tooltip" title="Edit" data-bs-placement="top">Edit Data</a>';
                    // $show    = '<a href="' . $url_show . '" class="dropdown-item" data-toggle="tooltip" title="Show" data-bs-placement="top">Show Data</a>';
                    $delete    = '<a href="javascript:void(0)" id="' . $id . '" data-id="' . $url_delete . '" class="dropdown-item btn-delete" data-toggle="tooltip" title="Delete" data-bs-placement="top">Delete Data</a>';
                    $printInvoice    = '<a href="' . $url_printInvoice . '" class="dropdown-item" data-toggle="tooltip" title="Print" data-bs-placement="top">Print Data</a>';
                    $button    = '<div class="dropup-center dropstart">
                <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <ul class="dropdown-menu">
                  <li>' . $edit . '</li>
                  <li>' . $delete . '</li>
                  <li>' . $printInvoice . '</li>
                </ul>
              </div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('back.invoice.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $invoice = new Invoice;
        return view('back.invoice.create', compact('invoice'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InvoiceRequest $request)
    {
        try {
            DB::beginTransaction();
            // $no_invoice = Invoice::latest()->first() !== null ? Invoice::latest()->first()->no_invoice + 1 : +1;

            $latestInvoice = Invoice::latest()->first();
            $latestYear = $latestInvoice ? $latestInvoice->created_at->year : null;
            $currentYear = now()->year;
         
            if ($latestYear !== $currentYear) {
                $no_invoice = 1; 
            } else {
                $no_invoice = $latestInvoice ? $latestInvoice->no_invoice + 1 : 1;
            }

            $invoice = Invoice::create([
                'no_invoice'    => $no_invoice,
                'name'          => $request->name,
                'address'       => $request->address,
                'attn'          => $request->attn,
                'vessel'        => $request->vessel,
                'voy'           => $request->voy,
            ]);

            foreach ($request->addmore as $key => $item) {
                ItemInvoice::create([
                    'invoice_id' => $invoice->id,
                    'description' => $item['description'],
                    'unit' => $item['unit'],
                    'qty' => $item['qty'],
                    'rate' => $item['rate'],
                    'total_value' => $item['qty'] * $item['rate'],
                ]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            // return redirect()->back()->withInput();
            return redirect()->back()->with('error', $th->getMessage());
        }

        return redirect()->route('invoice.index')->with('success', 'Create Data Success');
    }


    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        $itemInvoice = ItemInvoice::where('invoice_id', $invoice->id)->get();
        // dd($itemInvoice = ItemInvoice::where('invoice_id', $invoice->id)->get());
        return view('back.invoice.edit', compact('invoice', 'itemInvoice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InvoiceRequest $request, Invoice $invoice)
    {
        try {
            DB::beginTransaction();
            ItemInvoice::where('invoice_id', $invoice->id)->delete();
            $invoice->update([
                'name'          => $request->name,
                'address'       => $request->address,
                'attn'          => $request->attn,
                'vessel'        => $request->vessel,
                'voy'           => $request->voy,
            ]);



            foreach ($request->addmore as $key => $item) {
                ItemInvoice::create([
                    'invoice_id' => $invoice->id,
                    'description' => $item['description'],
                    'unit' => $item['unit'],
                    'qty' => $item['qty'],
                    'rate' => $item['rate'],
                    'total_value' => $item['qty'] * $item['rate'],
                ]);
            }

            // foreach ($request->addmore as $key => $item) {
            //     ItemInvoice::where([
            //         'id'    => $item['id']
            //     ])->update([
            //         'description' => $item['description'],
            //         'unit'        => $item['unit'],
            //         'qty'         => $item['qty'],
            //         'rate'        => $item['rate'],
            //         'total_value' => $item['qty'] * $item['rate'],
            //     ]);
            // }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            // return redirect()->back()->withInput();
            return redirect()->back()->with('error', $th->getMessage());
        }

        return redirect()->route('invoice.index')->with('success', 'Edit Data Success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return response()->json([
            'success' => true,
            'message' => 'Deleted Data Success!.',
        ]);
    }

    public function printInvoice(Invoice $invoice)
    {
        $itemInvoice = ItemInvoice::where('invoice_id', $invoice->id)->get();
        $totalValue = $itemInvoice->sum('total_value');
        $date = $invoice->created_at->format('d - m - y');
        $month = $invoice->created_at->format('m');
        $year = $invoice->created_at->format('Y');
        return view('back.invoice.printInvoice', compact('invoice', 'itemInvoice', 'totalValue', 'date', 'month', 'year'));
    }
}

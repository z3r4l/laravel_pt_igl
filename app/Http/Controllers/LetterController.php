<?php

namespace App\Http\Controllers;

use App\Http\Requests\LetterRequest;
use App\Models\CategoryLetter;
use App\Models\ItemLetter;
use App\Models\Letter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Romans\Support\Facades\IntToRoman as IntToRomanFacade;
use Illuminate\Support\Facades\DB;

class LetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:letter-list', ['only' => ['index']]);
        $this->middleware('permission:letter-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:letter-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:letter-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $data = DB::table('users')->select('id', 'name', 'email')->orderBy('created_at', 'DESC');
            $data = Letter::latest();
            return DataTables::of($data)
                ->addIndexColumn('DT_RowIndex')
                ->addColumn('action', function ($data) {
                    $id             = $data->id;
                    $url_edit       = route('letter.edit', $id);
                    // $url_show       = route('letter.show', $id);
                    $url_delete     = route('letter.destroy', $id);
                    $url_printLetter      = route('letter.printLetter', $id);

                    $edit     = '<a href="' . $url_edit . '" class="dropdown-item" data-toggle="tooltip" title="Edit" data-bs-placement="top">Edit Data</a>';
                    // $show    = '<a href="' . $url_show . '" class="dropdown-item" data-toggle="tooltip" title="Show" data-bs-placement="top">Show Data</a>';
                    $delete    = '<a href="javascript:void(0)" id="' . $id . '" data-id="' . $url_delete . '" class="dropdown-item btn-delete" data-toggle="tooltip" title="Delete" data-bs-placement="top">Delete Data</a>';
                    $printLetter    = '<a href="' . $url_printLetter . '" class="dropdown-item" data-toggle="tooltip" title="Print" data-bs-placement="top">Print Data</a>';
                    $button    = '<div class="dropup-center dropstart">
                <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <ul class="dropdown-menu">
                  <li>' . $edit . '</li>
                  <li>' . $delete . '</li>
                  <li>' . $printLetter . '</li>
                </ul>
              </div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('back.letter.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $letter = new Letter;
        $categoryLetter = CategoryLetter::get();
        $itemLetter = [];
        return view('back.letter.create', compact('categoryLetter', 'itemLetter', 'letter'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LetterRequest $request)
    {
        try {
            DB::beginTransaction();
            // $no_letter = Letter::latest()->first() !== null ? Letter::latest()->first()->no_letter + 1 : +1;
            // Mendapatkan surat terakhir
            $latestLetter = Letter::latest()->first();
            // Mendapatkan tahun surat terakhir
            $latestYear = $latestLetter ? $latestLetter->created_at->year : null;

            // Mendapatkan tahun saat ini
            $currentYear = now()->year;

            // Mengatur nomor surat
            if ($latestYear !== $currentYear) {
                $no_letter = 1; // Jika tahun surat terakhir tidak sama dengan tahun saat ini, atur kembali nomor surat ke 1
            } else {
                $no_letter = $latestLetter ? $latestLetter->no_letter + 1 : 1;
            }

            $letter = Letter::create([
                'no_letter'                 => $no_letter,
                'category_letter_id'        => $request->category_letter_id,
                'shipper_name'              => $request->shipper_name,
                'shipper_address'           => $request->shipper_address,
                'consignee_name'            => $request->consignee_name,
                'consignee_address'         => $request->consignee_address,
                'consignee_attn'            => $request->consignee_attn,
                'consignee_phone'           => $request->consignee_phone,
                'shipment'                  => $request->shipment,
                'total_gross_weight'        => $request->total_gross_weight,
                'total_package'             => $request->total_package,
            ]);

            foreach ($request->addmore as $key => $item) {
                ItemLetter::create([
                    'letter_id' => $letter->id,
                    'description' => $item['description'],
                    'qty' => $item['qty'],
                    'dimension' => $item['dimension'],
                ]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }

        return redirect()->route('letter.index')->with('success', 'Create Data Success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Letter $letter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Letter $letter)
    {
        $categoryLetter = CategoryLetter::get();
        $itemLetter = ItemLetter::where('letter_id', $letter->id)->get();
        return view('back.letter.edit', compact('letter', 'categoryLetter', 'itemLetter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LetterRequest $request, Letter $letter)
    {
        try {
            DB::beginTransaction();
            itemLetter::where('letter_id', $letter->id)->delete();
            $letter->update([
                'category_letter_id'        => $request->category_letter_id,
                'shipper_name'              => $request->shipper_name,
                'shipper_address'           => $request->shipper_address,
                'consignee_name'            => $request->consignee_name,
                'consignee_address'         => $request->consignee_address,
                'consignee_attn'            => $request->consignee_attn,
                'consignee_phone'           => $request->consignee_phone,
                'shipment'                  => $request->shipment,
                'total_gross_weight'        => $request->total_gross_weight,
                'total_package'             => $request->total_package,
            ]);

            foreach ($request->addmore as $key => $item) {
                ItemLetter::create([
                    'letter_id' => $letter->id,
                    'description' => $item['description'],
                    'qty' => $item['qty'],
                    'dimension' => $item['dimension'],
                ]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }

        return redirect()->route('letter.index')->with('success', 'Update Data Success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Letter $letter)
    {
        $letter->delete();
        return response()->json([
            'success' => true,
            'message' => 'Deleted Data Success!.',
        ]);
    }

    public function printLetter(Letter $letter)
    {
        $itemLetter = ItemLetter::where('letter_id', $letter->id)->get();
        $created_at = $letter->created_at;
        $carbonDate = Carbon::parse($created_at);
        $formattedDate = $carbonDate->format('F jS Y');
        $bulan = $created_at->format('n');
        $tahun = $created_at->format('Y');

        function angkaRomawi($angka)
        {
            $romawi = [
                01 => 'I',
                2 => 'II',
                3 => 'III',
                4 => 'IV',
                5 => 'V',
                6 => 'VI',
                7 => 'VII',
                8 => 'VIII',
                9 => 'IX',
                10 => 'X',
                11 => 'XI',
                12 => 'XII',
            ];

            return isset($romawi[$angka]) ? $romawi[$angka] : 'Angka di luar jangkauan';
        }
        $angkaRomawi = angkaRomawi($bulan);
        return view('back.letter.printLetter', compact('letter', 'itemLetter', 'formattedDate', 'angkaRomawi', 'tahun'));
    }
}

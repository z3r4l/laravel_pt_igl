<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
         $this->middleware('permission:company-list', ['only' => ['index']]);
         $this->middleware('permission:company-create', ['only' => ['create','store']]);
         $this->middleware('permission:company-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:company-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $data = DB::table('users')->select('id', 'name', 'email')->orderBy('created_at', 'DESC');
            $data = Company::with('customers')->latest();
            return DataTables::of($data)
                ->addIndexColumn('DT_RowIndex')
                ->addColumn('customers', function ($data){
                    return $data->customers->all();
                })
                ->addColumn('action', function ($data) {
                    $id             = $data->id;
                    $url_edit       = route('company.edit', $id);
                    // $url_show       = route('company.show', $id);
                    $url_delete     = route('company.destroy', $id);

                    $edit     = '<a href="' . $url_edit . '" class="dropdown-item" data-toggle="tooltip" title="Edit" data-bs-placement="top">Edit Data</a>';
                    // $show    = '<a href="' . $url_show . '" class="dropdown-item" data-toggle="tooltip" title="Show" data-bs-placement="top">Show Data</a>';
                    $delete    = '<a href="javascript:void(0)" id="' . $id . '" data-id="' . $url_delete . '" class="dropdown-item btn-delete" data-toggle="tooltip" title="Delete" data-bs-placement="top">Delete Data</a>';
                    $button    = '<div class="dropup-center dropstart">
                <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <ul class="dropdown-menu">
                  <li>' . $edit . '</li>
                  <li>' . $delete . '</li>
                </ul>
              </div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('back.company.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $company = new Company;
       return view('back.company.create', compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {
        try {
            DB::beginTransaction();
            $company = Company::create([
                'name'  => $request->name_company,
                'website'  => $request->website,
                'address'  => $request->address,
                'description'  => $request->description,
            ]);
    
            foreach ($request->addmore as $key => $item) {
                Customer::create([
                    'company_id' => $company->id,
                    'name' => $item['name_customer'],
                    'email' => $item['email'],
                    'phone' => $item['phone'],
                ]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
      return redirect()->route('company.index')->with('success','Create Data Success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        $customers = Customer::where('company_id', $company->id)->get();
        return view('back.company.edit', compact('company', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, Company $company)
    {
        try {
            DB::beginTransaction();
            Customer::where('company_id', $company->id)->delete();
            $company->update([
                'name'  => $request->name_company,
                'website'  => $request->website,
                'address'  => $request->address,
                'description'  => $request->description,
            ]);
    
            foreach ($request->addmore as $key => $item) {
                Customer::create([
                    'company_id' => $company->id,
                    'name' => $item['name_customer'],
                    'email' => $item['email'],
                    'phone' => $item['phone'],
                ]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
        return redirect()->route('company.index')->with('success','Update Data Success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return response()->json([
            'success' => true,
            'message' => 'Deleted Data Success!.',
        ]); 
    }
}

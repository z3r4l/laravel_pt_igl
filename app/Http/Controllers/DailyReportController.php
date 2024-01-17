<?php

namespace App\Http\Controllers;

use App\Http\Requests\DailyReportRequest;
use App\Models\DailyReport;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
class DailyReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
         $this->middleware('permission:daily-report-list', ['only' => ['index']]);
         $this->middleware('permission:daily-report-create', ['only' => ['create','store']]);
         $this->middleware('permission:daily-report-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:daily-report-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $data = DB::table('users')->select('id', 'name', 'email')->orderBy('created_at', 'DESC');
            // $data = DailyReport::latest();
            if(!empty($request->from_date)) {
                $data = DailyReport::whereBetween('date_document', array($request->from_date, $request->to_date))->get();
            } else {
                $data = DailyReport::latest();
            }
            return DataTables::of($data)
                ->addIndexColumn('DT_RowIndex')
                ->addColumn('action', function ($data) {
                    $id             = $data->id;
                    $url_edit       = route('daily-report.edit', $id);
                    // $url_show       = route('daily-report.show', $id);
                    $url_delete     = route('daily-report.destroy', $id);

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
        return view('back.daily-report.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dailyReport = new DailyReport;
        return view('back.daily-report.create', compact('dailyReport'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DailyReportRequest $request)
    {
        // dd($request->all());
        DailyReport::create($request->all());
        return  redirect()->route('daily-report.index')->with('success','Daily Report Berhasil Di Buat');
    }

    /**
     * Display the specified resource.
     */
    public function show(DailyReport $dailyReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DailyReport $dailyReport)
    {
        return view('back.daily-report.edit', compact('dailyReport'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DailyReportRequest $request, DailyReport $dailyReport)
    {
        $dailyReport->update($request->all());
        return  redirect()->route('daily-report.index')->with('success','Daily Report Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DailyReport $dailyReport)
    {
        $dailyReport->delete();
        return response()->json([
            'success' => true,
            'message' => 'Deleted Data Success!.',
        ]);
    }
}

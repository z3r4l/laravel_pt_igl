<?php

namespace App\Http\Controllers;

use App\Http\Requests\CatgoryLetterRequest;
use App\Models\CategoryLetter;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
         $this->middleware('permission:category-letter-list', ['only' => ['index']]);
         $this->middleware('permission:category-letter-create', ['only' => ['create','store']]);
         $this->middleware('permission:category-letter-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:category-letter-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $data = DB::table('users')->select('id', 'name', 'email')->orderBy('created_at', 'DESC');
            $data = CategoryLetter::latest();
            return DataTables::of($data)
                ->addIndexColumn('DT_RowIndex')
                ->addColumn('action', function ($data) {
                    $id             = $data->id;
                    $url_edit       = route('category-letter.edit', $id);
                    // $url_show       = route('category-letter.show', $id);
                    $url_delete     = route('category-letter.destroy', $id);

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
        return view('back.category-letter.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categoryLetter = new CategoryLetter;
        return view('back.category-letter.create', compact('categoryLetter'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CatgoryLetterRequest $request)
    {
        CategoryLetter::create([
            'name'  => $request->name,
            'code_letter'   => strtoupper($request->code_letter)
        ]);
        return redirect()->route('category-letter.index')->with('success', 'Create Category Letter Success');
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoryLetter $categoryLetter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoryLetter $categoryLetter)
    {
        return view('back.category-letter.edit', compact('categoryLetter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CatgoryLetterRequest $request, CategoryLetter $categoryLetter)
    {
        $categoryLetter->update($request->all());

        return redirect()->route('category-letter.index')->with('success', 'Update Category Letter Success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryLetter $categoryLetter)
    {
        $categoryLetter->delete();
        return response()->json([
            'success' => true,
            'message' => 'Deleted Data Success!.',
        ]); 
    }
}

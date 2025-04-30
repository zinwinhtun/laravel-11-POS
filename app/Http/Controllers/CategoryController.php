<?php

namespace App\Http\Controllers;

use PDO;
use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('id','desc')->paginate(5);
        return view('Admin.Template.Category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->toArray());
        $this->CheckValidate($request);
        Category::create($request->all());
        Alert::success('Category Create', 'Success Category Creation');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->CheckValidate($request,$id);
        Category::FindOrFail($id)->update($request->all());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::FindOrFail($id)->delete();
        Alert::error('Delete', 'This Item Was Deleted Successful');
        return back();
    }


    private function CheckValidate ($request){

    $request->validate([
        'name' => [
            'required',
            'string',
            'unique:categories,name,' . $request->id  // skip current ID on update
        ],
    ]);
    }
}

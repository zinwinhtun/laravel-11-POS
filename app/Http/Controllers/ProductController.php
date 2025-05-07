<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        $category = Category::all();
        $product = Product::with('category')->when(request('searchData') , function($query){
            $search = request('searchData');
            $query->where('name', 'like', '%' . $search . '%')
            ->orWhere('price','like','%'.$search.'%')
            //search in related category table
            ->orWhereHas('category',function($q) use ($search){
                $q->where('name', 'like', '%' . $search . '%');
            });
        })->paginate(6)->withQueryString();
        return view('Admin.Template.Product.index',compact('category','product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = Category::get();
        $this->validationCheck($request,"store");
        $data = $this->data($request);
        //image store
        if($request->hasFile('image')){
            $fileName = uniqid() .$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path().'/photo/' , $fileName);
            $data['image'] = $fileName;
        }
        Product::create($data);
        Alert::success('"Product" Create', 'Success Product Creation');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $products = Product::with('category')->findOrFail($id);
        return view('Admin.Template.Product.view',compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::get();
        $product = Product::with('category')->findOrFail($id);
        return view('Admin.Template.Product.edit',compact('product','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->merge(['id' => $id]); // merge id to id
        $this->validationCheck($request,'update');
        $data = $this->data($request);
        //image upload
        if ($request->hasFile('image')) {
            // Remove old image
        //image upload
        if ($request->hasFile('image')) {
            // Remove old image
            $oldImage = $request->image;
<<<<<<< HEAD
            if ($oldImage && file_exists(public_path('/photo/' . $oldImage))) {
                unlink(public_path('/photo/' . $oldImage));
=======
<<<<<<< HEAD
            if ($oldImage && file_exists(public_path('/photo/' . $oldImage))) {
                unlink(public_path('/photo/' . $oldImage));
=======
            if ($oldImage && file_exists(public_path('photo/' . $oldImage))) {
                unlink(public_path('photo/' . $oldImage));
>>>>>>> f615d9de5f7cccd66240f606f2037b0fc0f8bab1
>>>>>>> cb57f9997a6381deddcbbb91699e924badade034
            }

            // Save new image
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('photo'), $fileName);

            // Save new image
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('photo'), $fileName);
            $data['image'] = $fileName;
        } else {
            // Use old image
            $data['image'] = $request->image;
        } else {
            // Use old image
            $data['image'] = $request->image;
        }

        // dd($data);
        // dd($data);

        Product::findOrFail($id)->update($data);
        return to_route('product.index');
        return to_route('product.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id)->delete();
        Alert::error('Delete', 'This Item Was Deleted Successful');
        return back();
    }

    public function stockLimit(){
        $category = Category::get();
        $product = Product::where('stock', '<=', 5)->paginate(6)->withQueryString();
        return view('Admin.Template.Product.index',compact('category','product'));

    }

    //get request data
    private function data($request){
        return[
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'description' => $request->description
        ];
    }


    // validation
    private function validationCheck($request,$action){
        $rule= [
            'name' => 'required|min:4|max:30|unique:products,name,' . $request->id, //unique for store process but not for update process
            'price' => 'required|numeric|min:4',
            'stock' => 'required|numeric|min:1',
            'category_id' => 'required',
            'image' => 'required|file|mimes:png,jpg,jpeg,svg,gif',
            'description' => 'required',
        ];

        $rule['image'] = $action == 'store' ? 'required|file|mimes:png,jpg,jpeg,svg,gif': 'file|mimes:png,jpg,jpeg,svg,gif';
        $request->validate($rule);
    }
}

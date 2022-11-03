<?php

namespace App\Http\Controllers;


use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
// use Maatwebsite\Facades\Excel;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index']]);
    //     $this->middleware('permission:product-create', ['only' => ['create','store', 'updateStatus']]);
    //     $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
    //     $this->middleware('permission:product-delete', ['only' => ['delete']]);
    // }

    public function index()
    {
        $product = Product::with('roles')->paginate(5);
        return view('products.index', ['products' => $product]);
    }

    public function create()
    {
        $roles = Role::all();
       
        return view('products.add', ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        // Validations
        $request->validate([
            'name'    => 'required',
            'price'     => 'required',
            'type'         => 'required',
            'discount'       =>  'required',
            'food_party'       =>  'required|numeric|in:0,1',
        ]);

        DB::beginTransaction();
        try {

            // Store Data
            $product = product::create([
                'name'    => $request->name,
                'price'     => $request->price,
                'type'         => $request->type,
                'discount'       => $request->discount,
                'food_party'        => $request->food_party,
            ]);

            // Delete Any Existing Role
            DB::table('model_has_roles')->where('model_id',$product->id)->delete();
            
            // Assign Role To User
            $product->assignRole($product->discount);

            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('products.index')->with('success','product Created Successfully.');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Update Status Of User
     * @param Integer $status
     * @return List Page With Success
     * @author Shani Singh
     */
    public function updateStatus($products, $status)
    {
        // Validation
        $validate = Validator::make([
            'products'   => $products,
            'status'    => $status
        ], [
            'products'   =>  'required|exists:products,id',
            'status'    =>  'required|in:0,1',
        ]);

        // If Validations Fails
        if($validate->fails()){
            return redirect()->route('products.index')->with('error', $validate->errors()->first());
        }

        try {
            DB::beginTransaction();

            // Update Status
            product::whereId($products)->update(['status' => $status]);

            // Commit And Redirect on index with Success Message
            DB::commit();
            return redirect()->route('products.index')->with('success','product Status Updated Successfully!');
        } catch (\Throwable $th) {

            // Rollback & Return Error Message
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Edit User
     * @param Integer $user
     * @return Collection $user
     * @author Shani Singh
     */
    public function edit(product $products)
    {
        $roles = Role::all();
        return view('products.edit')->with([
            'roles' => $roles,
            'products'  => $products
        ]);
    }

    /**
     * Update User
     * @param Request $request, User $user
     * @return View Users
     * @author Shani Singh
     */
    public function update(Request $request, product $products)
    {
        // Validations
        $request->validate([
            'name'    => 'required',
            'price'     => 'required',
            'type'         => 'required',
            'discount'       =>  'required',
            'food_party'       =>  'required|numeric|in:0,1',
        ]);

        DB::beginTransaction();
        try {

            // Store Data
            $products_updated = product::whereId($products->id)->update([
                'name'    => $request->name,
                'price'     => $request->price,
                'type'         => $request->type,
                'discount'       => $request->discount,
                'food_party'        => $request->food_party,
            ]);

            // Delete Any Existing Role
            DB::table('model_has_roles')->where('model_id',$products->id)->delete();
            
            // Assign Role To User
            $products->assignRole($products->discount);

            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('products.index')->with('success','Product Updated Successfully.');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Delete User
     * @param product $product
     * @return Index products
     * @author Shani Singh
     */
    public function delete(Product $product)
    {
        DB::beginTransaction();
        try {
            // Delete User
            product::whereId($product->id)->delete();

            DB::commit();
            return redirect()->route('products.index')->with('success', 'Product Deleted Successfully!.');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Import Users 
     * @param Null
     * @return View File
     */
    // public function importUsers()
    // {
    //     return view('products.import');
    // }

    // public function uploadUsers(Request $request)
    // {
    //     Excel::import(new UsersImport, $request->file);
        
    //     return redirect()->route('products.index')->with('success', 'product Imported Successfully');
    // }

    // public function export() 
    // {
    //     return Excel::download(new UsersExport, 'products.xlsx');
    // }
}

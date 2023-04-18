<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
   
 public function index(){
    
   return view('index');

    }



    

//DataTable Data
public function getDataTableData(){
    $products = Product::latest()->get();

    return Datatables::of($products)
    ->addIndexColumn()
    ->addColumn('action',function($row){
        if (Auth::check()) {
            // The user is logged in...
              //update 
        $updateButton = "<button class='btn btn-sm btn-info updateProduct'  data-id='".$row->id."' data-bs-toggle='modal' data-bs-target='#updateModal' ><i class='fa-solid fa-pen-to-square'></i></button>";
        // Delete Button
        $deleteButton = "<button class='btn btn-sm btn-danger deleteProduct' data-id='".$row->id."'><i class='fa-solid fa-trash'></i></button>";
        return $updateButton." ".$deleteButton;
        }
        else{
                          //update 
        $updateButton = "<button class='btn btn-sm btn-info updateProduct'  disabled data-id='".$row->id."' data-bs-toggle='modal' data-bs-target='#updateModal' ><i class='fa-solid fa-pen-to-square'></i></button>";
        // Delete Button
        $deleteButton = "<button class='btn btn-sm btn-danger deleteProduct' disabled data-id='".$row->id."'><i class='fa-solid fa-trash'></i></button>";
        return $updateButton." ".$deleteButton;
        }
      
        
    })
      ->make();
    

}

 //Read product Data by ID
 public function getProductData(Request $request){
    
    $id = $request->post('id');

    $prodData = Product::find($id);

    $response = array();
    if(!empty($prodData)){
      $response['Brand'] = $prodData->Brand;
      $response['Stock'] = $prodData->Stock;
      $response['Status'] = $prodData->Status;
      $response['Price'] = $prodData->Price;
      
      $response['success']= 1;
    }else{
        $respone['success'] = 0;
    }
    
     return response()->json($response);

    }

   //update product

   public function updateProduct(Request $request){

    $id = $request->post('id');
      
    $prodData = Product::find($id);


    $response = array();
    if(!empty($prodData)){
    
        $updata['Brand'] = $request->post('Brand');
        $updata['Stock'] = $request->post('Stock');
        $updata['Status'] = $request->post('Status');
        $updata['Price'] = $request->post('Price');

        if($prodData->update($updata)){
            $response['success'] = 1;
            $response['msg'] = 'Update successfully';
        }else{
            $response['success'] = 0;
            $response['msg'] = 'Record not updated';
        }
    }else{
        $response['success'] = 0;
        $response['msg'] = 'Invalid ID.';
   }
         return response()-> json($response);

        }

        // Delete Product
   public function deleteProduct(Request $request){
    $id = $request->post('id');

    $prodData = Product::find($id);
   
    if($prodData->delete()){
        $response['success'] = 1;
        $response['msg'] = 'Delete successfully'; 
    }else{
        $response['success'] = 0;
        $response['msg'] = 'Invalid ID.';
    }

    return response()->json($response);


   }
  
   public function createProduct(){

     return view('create-product');

   }
  
   
 //store product data

 public function storeProductData(Request $request){
  
    $formFields= $request->validate([
        'Brand'=>'required',
        'Stock'=>'required',
        'Status'=>'required',
        'Price'=>'required'

    ]);


    Product::create($formFields);

    return redirect('/')->with('message','Product Created Successfully!');


      
 }


    }


      








    


<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['q'] = $request->query('q');
        $data['category_id'] = $request->query('category_id');
        $data['start'] = $request->query('start');
        $data['end'] = $request->query('end');
        $data['categories'] = Category::all();
        $data['operators'] = [
            '=' => 'equal to' ,
            '<>' => 'not equal to' ,
            '>' => 'greater than' ,
            '>=' => 'greater than or equal to' ,
            '>=' => 'less than' ,
            '>=' => 'less than or equal to' ,
            'between' => 'between' ,
        ];

        $query = OrderDetail::select('order_details.*' , 'orders.*' , 'customers.*' , 'products.*', 'categories.*' , 
        DB::raw('quantity * price AS total'))
        ->join('products', 'products.product_id', '=', 'order_details.product_id')
        ->join('orders', 'orders.order_id', '=', 'order_details.order_id')
        ->join('customers', 'customers.customer_id', '=', 'orders.customer_id')
        ->join('categories', 'categories.category_id', '=', 'products.category_id')
        ->where(function ($query) use ($data){
            //to search//
            $query->where('customer_name', 'like', '%' . $data['q'] . '%');
            $query->orwhere('product_name', 'like', '%' . $data['q'] . '%');
            $query->orwhere('category_name', 'like', '%' . $data['q'] . '%');
        });

        if ($data['category_id'])
        $query->where('categories.category_id' , $data['category_id']);
        if ($data['start'])
        $query->where('orders.order_date' , '>=', $data['start']);
        if ($data['end'])
        $query->where('orders.order_date' , '<=', $data['end']);



        $data['order_details'] = $query ->paginate(20)->withQuerystring();
        return view('order_detail.index',$data);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

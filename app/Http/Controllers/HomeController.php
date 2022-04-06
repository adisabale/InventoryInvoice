<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Product,InvoiceDetail,Invoice};


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(request()->ajax()) {
            $products = Product::All();
            return $products;
        }
        return view('home');
    }
    public function getProductAmount($id)
    {
        if(request()->ajax()) {
            $products = Product::find($id);
            return $products;
        }
    }
    public function save(Request $request)
    {
        $request->validate([
            'invoice.*.product_id'    => 'required',
            'invoice.*.qty'           => 'required',
            'invoice.*.tax'           => 'required',
            'customer_name'           => 'required',
            'totalamount'             => 'required',
        ]);
        
        $idid = Invoice::create([
            'customer_name' => $request->customer_name,
            'total_amount'  => $request->totalamount,
        ]);
        $data = $request->invoice;
        for($i=0;$i<count($request->invoice);$i++){
            $data[$i+1] += [ 'invoice_id' => $idid->id ];
        }
        InvoiceDetail::insert($data);

        return back()->with('success', 'Invoice Created Successfully.');
    }
    public function view()
    {
        $invoice = Invoice::All();
        return view('viewAllInvoice',compact('invoice'));
    }
    public function view_invoice($id)
    {
        $invoice = InvoiceDetail::join('products as p','invoice_details.product_id','=','p.id')
                    ->where('invoice_id',$id)->get();
                    // return $invoice;
        return view('viewInvoiceDetails',compact('invoice'));
    }
}

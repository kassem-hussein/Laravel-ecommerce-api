<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductStock;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe;
use Stripe\Stripe as StripeStripe;

class OrdersController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $orders =  Order::query()->paginate(5);
       return $this->sendSuccessWithResult("success",$orders,200);
    }

    public function getUserOrders(){
        $orders =  Order::where("user",request()->user()->id)->paginate(5);
        return $this->sendSuccessWithResult("success",$orders,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        DB::beginTransaction();
        $subtotal = 0;
        $productsIDs = [];
        foreach($request->items as $item){
            $productsIDs[] = $item["product"];
            $productStock = ProductStock::where("product",$item["product"])
            ->where("color",$item["color"])
            ->where("size",$item["size"])->first();
            if($productStock->quantity < $item["quantity"]){
                DB::rollBack();
                return $this->sendError("Can't make this order because product ".$item["product"]."out of stock",400);
            }
            $productStock->update([
                "quantity"=>$productStock->quantity - $item["quantity"]
            ]);
            $subtotal +=$productStock->price ? $productStock->price : 0;
        }
        $products = Product::whereIn("id",$productsIDs)->get();
        foreach($products as $product){
            $subtotal += $product->price;
        }
        $order = Order::create([
            "user"=>request()->user()->id,
            "subtotal"=>$subtotal,
            "address"=>$request->address,
            "tax"=>(0.10 * $subtotal),
            "shipping"=>$request->shipping ? $request->shipping : 0,
            "status"=>$request->status ? $request->status : "started"
        ]);

        foreach($request->items as $item){
            OrderDetail::create([
                "order"=>$order->id,
                "product"=>$item["product"],
                "color"=>$item["color"],
                "size"=>$item["size"],
                "quantity"=>$item["quantity"]
            ]);
        }
        DB::commit();
        return $this->sendSuccess("Added Order Successfully",201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::find($id);
        if(!$order){
            return $this->sendError("Not Found",404);
        }
        return $this->sendSuccessWithResult("success",$order,200);

    }



    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(Request $request, string $id)
    {
        $request->validate([
            "status"=>"required|in:in:started,ready,in way,done"
        ]);
        $order = Order::find($id);
        if(!$order){
            return $this->sendError("Not Found",404);
        }
        $order->update([
            "status"=>$request->status
        ]);
        return $this->sendSuccess("Updated Order Status Successfully",205);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::find($id);
        if(!$order){
            return $this->sendError("Not Found",404);
        }
        $order->delete();
        return $this->sendSuccess("Deleted Order Successfully");
    }
    public function checkout(Request $request,String $id){

        $order = Order::find($id);
        if(!$order){
            return $this->sendError("Not Found",404);
        }
        $total = $order->subtotal + $order->tax + $order->shipping;

        $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET_KEY"));

        $response = $stripe->charges->create([
            'amount' => $total * 100,
            'currency' => 'usd',
            'source' => 'tok_visa',
          ]);

        if($response->status == "succeeded"){
            $order->update([
                "paid"=>true
            ]);
            return $this->sendSuccess("Payment Done successfully",200);
        }
        return $this->sendError("Falid to Payment");

    }

}

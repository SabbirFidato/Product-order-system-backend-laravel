<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\Category;
use App\Orders;
use App\Users;
use App\order_status;

class OrderController extends Controller
{
    //

    function GetOrders()
	{
		// $products = Products::all('product_id');

		$orders = Orders::join('products', 'orders.product_id', '=', 'products.product_id')
				->join('categories', 'products.cat_id', '=', 'categories.id')
				->join('order_statuses', 'orders.status_id', '=', 'order_statuses.id')
				->join('users', 'orders.user_id', '=', 'users.id')
				->get(['products.*', 'categories.cat_name','users.id As user_id' , 'users.name AS user_name','orders.order_id', 'orders.quantity', 'orders.sold_unit_price AS unit_price', 'orders.bill as total', 'orders.status_id', 'order_statuses.status_name AS status']);

		return $orders;
	}

	function InsertOrder(Request $req)
	{
		$order = new Orders();

		$order->product_id=$req->productId;
		$order->quantity=$req->quantity;
		$order->sold_unit_price= $req->soldUnitPrice;
		$order->bill=$req->bill;
		$order->status_id= $req->statusId;
		$order->user_id=$req->userId;
		//$oder->is_deleted=boolval('false');
		$order->save();

		$orderId=0;
		$orderId = $order->order_id;
		
		return $orderId;
	}

	function UpdateOrderStatus(Request $req)
	{
		$order = Orders::find($req->orderId);
		$updatedId=0;

		if($order)
		{
			$order->status_id= $req->statusId;		
			$order->save();

			$updatedId = $order->order_id;
		}
		
		else
		{
			return $updatedId;
		}
		
	}
}

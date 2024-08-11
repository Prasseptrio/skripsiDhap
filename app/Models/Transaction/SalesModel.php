<?php

namespace App\Models\Transaction;

use CodeIgniter\I18n\Time;
use CodeIgniter\Model;

class SalesModel extends Model
{

	public function getSalesOrderByLastOrder($customerID)
	{
		return $this->db->table('sales_order')
			->select('sales_order.order_id, sales_order.order_uuid')
			->join('sales_order_shipping', 'sales_order.order_id = sales_order_shipping.order_id')
			->join('order_status', 'sales_order.order_status = order_status.order_status_id')
			// ->join('courier', 'sales_order_shipping.shipping_courier = courier.courier_id')
			->getwhere(['customer_id' => $customerID, 'sales_order.created_at <=' => time(), 'sales_order.order_status' => 9])
			->getRowArray();
	}
	public function getSalesOrderLastByInvoice($invoice)
	{
		return $this->db->table('sales_order')
			->select('sales_order.order_id')
			->join('order_status', 'sales_order.order_status = order_status.order_status_id')
			->getwhere(['sales_order.invoice_no' => $invoice, 'sales_order.created_at <=' => time(), 'sales_order.order_status' => 9])
			->getRowArray();
	}
	public function getSalesOrdertByInvoice($invoice)
	{
		return $this->db->table('sales_order')
			->join('order_status', 'sales_order.order_status = order_status.order_status_id')
			->getwhere(['sales_order.invoice_no' => $invoice])
			->getRowArray();
	}
	public function getOrderByCustomerId($customerID, $p = false)
	{
		$perpage = 3 * $p;
		$page = ($p) ? $p : 1;
		$start = ($page > 1) ? ((int)$page * $perpage) - $perpage : 0;
		$start = 0;
		if ($p) {
			return $this->db->table('sales_order')
				->select('*,order_status.order_status_name_sky as')
				->join('order_status', 'sales_order.order_status = order_status.order_status_id')
				->orderBy('sales_order.created_at', 'DESC')
				->where(['sales_order.customer_id' => $customerID])
				->get($perpage, $start)->getResultArray();
		} else {
			return $this->db->table('sales_order')
				->join('order_status', 'sales_order.order_status = order_status.order_status_id')
				->orderBy('sales_order.created_at', 'DESC')
				->where(['customer_id' => $customerID])
				->countAllResults();
		}
	}
	public function getCart($customerID)
	{
		return $this->db->table('customer_cart')
			->join('products', 'customer_cart.product_id = products.product_id')
			->getWhere(['customer_id' => $customerID, 'customer_cart.deleted_at' => null])->getResultArray();
	}
	public function getTotalCart($customerID)
	{
		$Cart = $this->db->table('customer_cart')
			->join('products', 'customer_cart.product_id = products.product_id')
			->getWhere(['customer_id' => $customerID, 'customer_cart.deleted_at' => null])->getResultArray();
		if ($Cart) {
			$totalCart = 0;
			foreach ($Cart as $cart) {
				$totalCart += $cart['quantity'];
			}
			return $totalCart;
		} else {
			return 0;
		}
	}
	public function getGrandTotalCart($customerID)
	{
		$Cart = $this->db->table('customer_cart')
			->join('products', 'customer_cart.product_id = products.product_id')
			->getWhere(['customer_id' => $customerID, 'customer_cart.deleted_at' => null])->getResultArray();
		if ($Cart) {
			$grandTotal = 0;
			foreach ($Cart as $cart) {
				$total = $cart['price'] * $cart['quantity'];
				$grandTotal += $total;
			}
			return $grandTotal;
		} else {
			return 0;
		}
	}
	public function addToCart($dataProduct)
	{
		$this->db->transBegin();
		$product = $this->db->table('products')->where(['products.product_id' => $dataProduct['productID']])->get()->getRowArray();
		$checkCustomer = $this->db->table('customer_cart')->getWhere(['customer_id' => $dataProduct['customerID'], 'product_id' => $product['product_id'], 'customer_cart.deleted_at' => null])->getRowArray();
		if ($checkCustomer) {
			$qty = $checkCustomer['quantity'] + $dataProduct['quantity'];
			$this->db->table('customer_cart')->update([
				'quantity' 		=> $qty,
				'updated_at'	=> time()
			], [
				'customer_id' 	=> $dataProduct['customerID'],
				'product_id' 	=> $product['product_id'],
			]);
		} else {
			$this->db->table('customer_cart')->insert([
				'customer_id' 	=> $dataProduct['customerID'],
				'product_id' 	=> $product['product_id'],
				'quantity' 		=> $dataProduct['quantity'],
			]);
		}
		if ($this->db->transStatus() === false) {
			$this->db->transRollback();
			return false;
		} else {
			$this->db->transCommit();
			return true;
		}
	}

	public function addCartFormCheckout($dataProduct, $qty, $customerID)
	{
		$this->db->transBegin();
		$product = $this->db->table('products')->where(['products.product_sku' => $dataProduct])->get()->getRowArray();
		$checkCustomer = $this->db->table('customer_cart')->getWhere(['customer_id' => $customerID, 'product_id' => $product['product_id']])->getRowArray();
		if ($checkCustomer) {
			$this->db->table('customer_cart')->update([
				'quantity' 		=> $qty,
				'updated_at'	=> time()
			], [
				'customer_id' 	=> $customerID,
				'product_id' 	=> $product['product_id'],
			]);
		} else {
			$this->db->table('customer_cart')->insert([
				'customer_id' 	=> $customerID,
				'product_id' 	=> $product['product_id'],
				'quantity' 		=> $qty,
			]);
		}

		if ($this->db->transStatus() === false) {
			$this->db->transRollback();
			return false;
		} else {
			$this->db->transCommit();
			return true;
		}
	}
	public function getCourier()
	{
		return $this->db->table('courier')->get()->getResultArray();
	}
	public function getSalesOrderByInvoice($invoice)
	{
		return $this->db->table('sales_order')->getWhere(['invoice_no' => $invoice])->getRowArray();
	}
	public function getLastSalesOrderByCustomerID($customerID)
	{
		return $this->db->table('sales_order')
			->join('customers', 'sales_order.customer_id = customers.customer_id')
			->getWhere(['customers.customer_id' => $customerID, 'transaction_date' => date('Y-m-d'), 'payment_status' => 0, 'order_status' => 9])->getRowArray();
	}

	public function getSalesOrderProductByOrderID($orderID)
	{
		return $this->db->table('sales_order_product')
			->join('products', 'sales_order_product.product_id = products.product_id')
			->getWhere(['order_id' => $orderID])->getResultArray();
	}
	public function getSalesOrderProductByInvoice($invoiceID)
	{
		$order = $this->db->table('sales_order')->select('order_id')->getWhere(['invoice_no' => $invoiceID])->getRowArray();
		return $this->db->table('sales_order_product')
			->select('
		product_name,
		product_model,
		product_image,
		order_product_name,
		order_product_model,
		sales_order_product.price,
		total,
		sales_order_product.quantity,
		')
			->join('products', 'sales_order_product.product_id = products.product_id')
			->getWhere(['order_id' => $order['order_id']])->getResultArray();
	}
	public function getMaxInvoice()
	{
		$q = $this->db->query("SELECT MAX(RIGHT(invoice_no,3)) AS kd_max FROM sales_order WHERE DATE(transaction_date)=CURDATE()");
		$kd = "";
		if ($q->getNumRows() > 0) {
			foreach ($q->getResult() as $k) {
				$tmp = ((int)$k->kd_max) + 1;
				$kd = sprintf("%03s", $tmp);
			}
		} else {
			$kd = "001";
		}

		return  'SKRPS-01-' . date('dmy') . $kd;
	}
	public function saveSalesOrder($dataCart, $dataInput, $total)
	{
		$this->db->transBegin();
		if ($dataCart == 0) {
			$this->db->transRollback();
			return false;
		}
		$invoice = $this->getMaxInvoice();
		$this->db->table('sales_order')->insert([
			'invoice_no'			=> $invoice,
			'customer_id'			=> session()->get('CID'),
			'order_status'			=> '9',
			'payment_method'		=> '',
			'payment_status'		=> '0',
			'transaction_date'		=> date('Y-m-d'),
			'total'					=> $total,
			'notes'					=> $dataInput['shipping_notes'],
			'cost_delivery'			=> ($dataInput['inputServices'] == 2) ? $dataInput['CostDelivery'] : '0',
			'type'					=> 2,
			'status'				=> 1,
			'created_at'			=> time()
		]);
		$orderId = $this->db->insertID('sales_order', 'order_id');
		$customer = $this->db->table('customers')->getWhere(['customers.customer_id' => session()->get('CID')])->getRowArray();
		foreach ($dataCart as $cart) {
			$product = $this->db->table('products')->select('product_id')->getWhere(['product_id' => $cart['id']])->getRowArray();

			$this->db->table('sales_order_product')->insert([
				'order_id'					=> $orderId,
				'product_id'				=> $product['product_id'],
				'order_product_name'		=> $cart['name'],
				'price'						=> $cart['price'],
				'quantity'					=> $cart['qty'],
				'total'						=> $cart['subtotal'],
				'packaging_status'			=> '0',

			]);
			$checkCart = $this->db->table('customer_cart')->getWhere(['customer_id' => session()->get('CID'), 'product_id' => $product['product_id']])->getRowArray();
			if ($checkCart) {
				$this->db->table('customer_cart')->update([
					'quantity' 		=> $cart['qty'],
					'updated_at'	=> time(),
					'deleted_at'	=> time()
				], [
					'customer_id' 	=> $customer['customer_id'],
					'product_id' 	=> $product['product_id'],
				]);
			}
		}
		if ($this->db->transStatus() === false) {
			$this->db->transRollback();
			return false;
		} else {
			$this->db->transCommit();
			return $invoice;
		}
	}
	public function deleteProductCart($productID)
	{
		$this->db->transBegin();
		$checkCustomer = $this->db->table('customer_cart')->getWhere(['customer_id' => session()->get('CID'), 'product_id' => $productID])->getRowArray();
		if ($checkCustomer) {
			$this->db->table('customer_cart')->update([
				'deleted_at'	=> time()
			], [
				'customer_id' 	=> session()->get('CID'),
				'product_id' 	=> $productID,
			]);
		}

		if ($this->db->transStatus() === false) {
			$this->db->transRollback();
			return false;
		} else {
			$this->db->transCommit();
			return true;
		}
	}
	public function savePaymentProof($orderID, $filename)
	{
		$this->db->transBegin();
		$SalesOrder = $this->db->table('sales_order')->getWhere(['invoice_no' => $orderID['invoice']])->getRowArray();
		$this->db->table('sales_order')->update(['payment_proof' => $filename, 'payment_status' => 2, 'order_status' => 1, 'updated_at' => time()], ['invoice_no' => $orderID['invoice']]);
		if ($this->db->transStatus() === false) {
			$this->db->transRollback();
			return false;
		} else {
			$this->db->transCommit();
			return true;
		}
	}
	public function cancelOrder($orderID)
	{
		$this->db->transBegin();
		$order = $this->db->table('sales_order')->getWhere(['invoice_no' => $orderID])->getRowArray();
		$this->db->table('sales_order')->update(['order_status' => '11', 'void_reason' => 'cancel order', 'void_at' => date('Y-m-d'), 'updated_at' => time(), 'status' => 3], ['order_id' => $order['order_id']]);
		if ($this->db->transStatus() === false) {
			$this->db->transRollback();
			return false;
		} else {
			$this->db->transCommit();
			return true;
		}
	}
	public function checkOutOftime($customerID)
	{
		$this->db->transBegin();
		$dataSalesOrder = $this->db->table('sales_order')->select('created_at, order_id, order_status, invoice_no')->getWhere(['customer_id' => $customerID, 'order_status' => '9',])->getResultArray();
		foreach ($dataSalesOrder as $salesOrder) {
			$date = strtotime("+1 hours", $salesOrder['created_at']);
			$now = time();
			if ($now >= $date) {
				$this->db->table('sales_order')->update(['order_status' => 15, 'updated_at' => time()], ['invoice_no' => $salesOrder['invoice_no']]);
			}
		}
		if ($this->db->transStatus() === false) {
			$this->db->transRollback();
			return false;
		} else {
			$this->db->transCommit();
			return true;
		}
	}
}

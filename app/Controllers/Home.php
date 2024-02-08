<?php

namespace App\Controllers;


class Home extends BaseController
{
	public function __construct()
	{
	}
	public function index()
	{
		if (session()->get('CID')) {
			$lastSales = $this->SalesModel->getLastSalesOrderByCustomerID(session()->get('CID'));
			if ($lastSales) {
				return redirect()->to(base_url('agree?inv=' . base64_encode($lastSales['order_uuid'])));
			}
		}
		$this->cart->destroy();
		$data = array_merge($this->data, [
			'title'         		=> 'Situs Karnevor.id',
			'description'   		=> '',
			'keyword'   			=> '',
			'LatestProducts' 		=> $this->productModel->getLatestProducts(12),
			'Categories'			=> $this->productModel->getCategories(),
		]);
		return view('common/home', $data);
	}
}

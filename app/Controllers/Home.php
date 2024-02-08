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
			$lastSales = $this->SalesModel->getSalesOrderByLastOrder(session()->get('CID'));
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
			'Manufacturer'			=> $this->productModel->getManufacturer(),
		]);
		return view('common/home', $data);
	}
	// public function information()
	// {
	// 	$data = array_merge($this->data, [
	// 		'title'         => 'Tentang Alenxi  Situs Pneumatic, Hydraulic, Networking, Software Terlengkap dan Terpercaya',
	// 		'description'   => '',
	// 		'keyword'   	=> '',
	// 		'information'	=> $this->informationModel->getInformation($this->request->uri->getSegment(2)),
	// 	]);
	// 	return view('common/information', $data);
	// }
	// public function blog()
	// {
	// 	$data = array_merge($this->data, [
	// 		'title'         => 'Informasi teknologi terikini di Situs Pneumatic, Hydraulic, Networking, Software Terlengkap dan Terpercaya',
	// 		'description'   => 'Informasi teknologi terikini di Situs Pneumatic, Hydraulic, Networking, Software Terlengkap dan Terpercaya',
	// 		'keyword'   	=> 'pneumatic, hydraulic',
	// 		'Blog'			=> $this->blogModel->getBlogs()
	// 	]);
	// 	return view('common/blog', $data);
	// }
	// public function blogDetail($slug)
	// {
	// 	$data = array_merge($this->data, [
	// 		'title'         => 'Blog ' . $slug,
	// 		'description'   => '',
	// 		'keyword'   	=> '',
	// 		'blog'			=> $this->blogModel->getBlogs($slug)
	// 	]);
	// 	return view('common/blogDetail', $data);
	// }
}

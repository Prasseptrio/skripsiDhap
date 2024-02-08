<?php

namespace App\Controllers\Product;

use App\Controllers\BaseController;
use App\Models\Transaction\SalesModel;

class Product extends BaseController
{
	function __construct()
	{
		$this->SalesModel = new SalesModel();
	}
	public function index()
	{
		$productID 	= $this->request->uri->getSegment(1);
		if (!$productID) {
			return redirect()->to(base_url());
		}
		$product = $this->productModel->getProductByID($productID);
		// dd($product);
		$categories = $this->productModel->getCategoryByID($product['product_category']);

		$data = array_merge($this->data, [
			'title'         	=> $product['product_name'],
			'description'   	=> $product['product_description'],
			'keyword'   		=> $product['product_name'],
			'product'			=> $product,
			'wishlist'			=> $this->customerModel->getWishlist(productID: $product['product_id'], customerID: session()->get('CID')),
			'category'			=> $categories,
			'ProductReview'		=> $this->productModel->getProductReview(productID: $productID),
			'ProductImages'		=> $this->productModel->getProductImages(productID: $productID)
		]);
		return view('product/product', $data);
	}
	public function search()
	{
		$keyword 	= $this->request->getGet('q');
		$str = strtolower(str_replace(array('<', '>', '&', '{', '}', '*', '\\', ';', ':', '^', '?', '['), '', $keyword));
		$page = ($this->request->getGet('p')) ? $this->request->getGet('p') : 1;
		if (!$keyword) return redirect()->to(base_url());
		$total = $this->productModel->totalFindProduct($str);
		$totalPage = count($total) / 12;
		if (count($total) == 0) {
			$pagination = 0;
		} else {
			$pagination = pagination($page, number_format($totalPage), $keyword, 'search');
		}
		$data = array_merge($this->data, [
			'title'         	=> "Cari Menu $keyword Termurah dan terlengkap ",
			'description'   	=> "$keyword Termurah terlengkap belanja aman di Alenxi",
			'keyword'   		=> $keyword,
			'totalProduct'		=> $total,
			'pagination'		=> $pagination,
			'Products'			=> $this->productModel->findProduct($str, $page)
		]);
		return view('product/search', $data);
	}
}

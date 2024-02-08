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
		$productSlug 	= $this->request->uri->getSegment(1);
		if (!$productSlug) {
			return redirect()->to(base_url());
		}
		$productBySlug	= $this->productModel->getProductByProductSlug($productSlug);
		if (!$productBySlug) {
			$product = $this->productModel->getProductBySlug($productSlug);
			if (!$product) {
				return redirect()->to(base_url());
			}
			$productParent = $this->productModel->getProductByproductParent($product['product_parent']);
			$productCategory = $productParent['product_category_id'];
		} else {
			$product = $productBySlug;
			$productCategory = $product['product_category_id'];
		}
		$productID	= $product['product_id'];
		$categories = $this->productModel->getCategoryByID($productCategory);

		$data = array_merge($this->data, [
			'title'         	=> $product['product_name'],
			'description'   	=> $product['product_description'],
			'keyword'   		=> $product['product_keyword'],
			'Subproduct'		=> $this->productModel->getProductByproductParentID(productID: $productID),
			'product'			=> $product,
			'wishlist'			=> $this->customerModel->getWishlist(productID: $product['product_id'], customerID: session()->get('CID')),
			'category'			=> $categories,
			'ChildCategory'		=> $this->productModel->getCategoryByParent($categories['product_category_parent']),
			'ProductRelated'	=> $this->productModel->getProductRelated(relatedID: $productID),
			'ProductAttribute'	=> $this->productModel->getProductAttribute(productID: $productID),
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
			'title'         	=> "Cari Produk $keyword Termurah dan terlengkap ",
			'description'   	=> "$keyword Termurah terlengkap belanja aman di Alenxi",
			'keyword'   		=> $keyword,
			'totalProduct'		=> $total,
			'pagination'		=> $pagination,
			'Products'			=> $this->productModel->findProduct($str, $page)
		]);
		return view('product/search', $data);
	}
}

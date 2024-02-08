<?php

namespace App\Controllers\Product;

use App\Controllers\BaseController;

class Category extends BaseController
{
	public function index()
	{
		$categorySlug = $this->request->uri->getSegment(2);
		if (!$categorySlug) {
			return redirect()->to(base_url());
		}
		$category	= $this->productModel->getCategories($categorySlug);
		if (!$category) {
			return redirect()->to(base_url());
		}
		$categoryID = $category['product_category_id'];
		$data = array_merge($this->data, [
			'title'         	=> $category['product_category_name'],
			'description'   	=> $category['product_category_description'],
			'keyword'   		=> $category['product_category_keyword'],
			'ProductCategory'	=> $this->productModel->getProductByCategory($categoryID),
			'ProductByParent'	=> $this->productModel->getProductByParentCategory($categoryID),
			'category'			=> $category,
			'categoryID'		=> $categoryID
		]);
		return view('product/category', $data);
	}
}

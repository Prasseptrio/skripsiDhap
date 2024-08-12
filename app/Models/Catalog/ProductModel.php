<?php

namespace App\Models\Catalog;

use CodeIgniter\Model;

class ProductModel extends Model
{
	public function getCategories($slug = false)
	{
		if ($slug) {
			return $this->db->table('product_category')
				->where(['product_category.product_category_slug' => $slug])
				->get()->getRowArray();
		}
		return $this->db->table('product_category')
			->where(['product_category_top' => '1'])
			->orderBy('product_category.sort_order')
			->get()->getResultArray();
	}
	public function getCategoryByID($categoryID = false)
	{
		return $this->db->table('product_category')
			->where(['product_category.product_category_id' => $categoryID])
			->get()->getRowArray();
	}
	public function getParentCategoryHeader($parent = false)
	{
		if ($parent) {
			return $this->db->table('product_category')
				->orderBy('sort_order')
				->where(['product_category_parent' => $parent, 'product_category_top' => '1'])
				->get()->getRowArray();
		}
		return $this->db->table('product_category')
			->orderBy('sort_order')
			->where(['product_category_parent' => 0,  'product_category_top' => '1'])
			->get()->getResultArray();
	}
	public function getCategoryByParent($parent)
	{
		return $this->db->table('product_category')
			->orderBy('sort_order')
			->where(['product_category_parent' => $parent])
			->get()->getResultArray();
	}
	public function getProduct($subproduct = false)
	{
		if ($subproduct) {
			return $this->db->table('products')
				->join('stock_status', 'products.stock_status_id = stock_status.stock_status_id')
				->join('product_category', 'products.product_category = product_category.product_category_id')
				->orderBy('product_category.sort_order')
				->where(['products.product_parent' => $subproduct, 'products.is_active' => '1'])
				->get()->getResultArray();
		}
	}
	public function getProductByID($productID)
	{
		return $this->db->table('products')
			->join('product_category', 'products.product_category = product_category.product_category_id')
			->orderBy('product_category.sort_order')
			->where(['products.product_id' => $productID, 'products.is_active' => '1'])
			->get()->getRowArray();
	}
	public function getProductByproductDetail($productID)
	{
		return $this->db->table('products')
			->select('*,stock_status.stock_status AS stock_name')
			->join('stock_status', 'products.stock_status_id = stock_status.stock_status_id')
			->where(['products.product_id' => $productID, 'products.is_active' => '1'])
			->get()->getRowArray();
	}
	public function getProductByproductParentID($productID)
	{
		return $this->db->table('products')
			->select('*,stock_status.stock_status AS stock_name')
			->join('stock_status', 'products.stock_status_id = stock_status.stock_status_id')
			// ->join('product_category', 'products.product_category = product_category.product_category_id')
			// ->where(['products.product_parent' => $productID, 'products.is_active' => '1'])
			// ->orderBy('product_category.sort_order')
			->get()->getResultArray();
	}
	public function getProductByproductParent($productID)
	{
		return $this->db->table('products')
			->select('*,stock_status.stock_status AS stock_name')
			->join('stock_status', 'products.stock_status_id = stock_status.stock_status_id')
			->join('product_category', 'products.product_category = product_category.product_category_id')
			->where(['products.product_id' => $productID, 'products.is_active' => '1'])
			->orderBy('product_category.sort_order')
			->get()->getRowArray();
	}
	public function findProduct($keyword, $p = false)
	{
		//ketika mencari '\' masih error
		$perpage = 12;
		$page = ($p) ? $p : 1;
		$start = ($page > 1) ? ((int)$page * $perpage) - $perpage : 0;
		return  $this->db->query("SELECT *
							  	FROM products 
							  	WHERE
							  		(
							  			products.product_name like '%$keyword%'
							  			OR products.product_description like '%$keyword%'
							  		)
								AND products.is_active = '1'
								LIMIT $perpage OFFSET $start")
			->getResultArray();
	}
	public function totalFindProduct($keyword)
	{
		return $this->db->query("SELECT  *
							  	FROM products 
							  	WHERE
							  		(
							  			products.product_name like '%$keyword%'
							  			OR products.product_description like '%$keyword%'
							  		)
							  	AND products.price > '0'
								AND products.is_active = '1' ")
			->getResultArray();
	}
	public function getProductRelated($relatedID)
	{
		$productParent = $this->db->table('products')->getWhere(['product_id' => $relatedID])->getRowArray();
		return $this->db->table('product_related')
			->join('products', 'product_related.product_id = products.product_id')
			->join('product_category', 'products.product_category = product_category.product_category_id')
			->orderBy('product_category.sort_order')
			->where(['product_related.related_product' => $productParent['product_category'], 'products.is_active' => '1'])
			->get()->getResultArray();
	}
	public function getProductByCategory($categoryID)
	{
		return $this->db->table('products')
			->join('product_category', 'products.product_category = product_category.product_category_id')
			->orderBy('product_category.sort_order')
			->where(['product_category_id' => $categoryID, 'products.is_active' => '1'])
			->get()->getResultArray();
	}
	public function getProductByParentCategory($categoryID)
	{

		return $this->db->table('products')
			->join('product_category', 'products.product_category = product_category.product_category_id')
			->orderBy('product_category.sort_order')
			->where([' product_category.product_category_parent' => $categoryID, 'products.is_active' => '1'])
			->get()->getResultArray();
	}
	public function getProductAttribute($productID)
	{
		return $this->db->table('product_specification')
			->join('specification', 'product_specification.specification_id = specification.specification_id')
			->join('specification_group', 'specification.specification_group_id = specification_group.specification_group_id')
			->where(['product_specification.product_id' => $productID,])
			->orderBy('specification.sort_order', 'ASC')
			->get()->getResultArray();
	}
	public function getProductImages($productID)
	{
		return $this->db->table('product_image')->where(['product_id' => $productID])->orderBy('sort_order', 'ASC')->get()->getResultArray();
	}
	public function getLatestProducts($limit)
	{
		return $this->db->table('products')
			->join('product_category', 'products.product_category = product_category.product_category_id')
			->limit($limit)
			->orderBy('products.created_at', 'DESC')
			->getWhere(['product_image !=' => null, 'products.is_active' => '1'])->getResultArray();
	}

	public function getBestSellerProducts($limit)
	{
		$BestSellerProducts = [];
		$data =  $this->db->table('sales_order_product')
			->select('sales_order_product.product_id, SUM(sales_order_product.quantity) AS total')
			->join('sales_order', 'sales_order_product.order_id = sales_order.order_id', 'LEFT')
			->join('products', 'sales_order_product.product_id = products.product_id')
			->groupStart()
			->where('order_status.order_status_id !=', null)
			->where('products.is_active =', '1')
			->where('products.created_at <=', time())
			->groupEnd()
			->groupBy('sales_order_product.product_id')
			->orderBy('total', 'DESC')
			->limit((int)$limit)
			->get()->getResultArray();
		// dd($data);
		// $data = $this->db->query("SELECT op.product_id, SUM(op.quantity) AS total FROM order_product op LEFT JOIN `order` o ON (op.order_id = o.order_id) LEFT JOIN `products` p ON 
		// (op.product_id = p.product_id) LEFT JOIN product_to_store p2s ON (p.product_id = p2s.product_id) WHERE o.order_status_id > '0' 
		// AND p.status = '1' AND p.date_available <= NOW() GROUP BY op.product_id ORDER BY total DESC LIMIT " . (int)$limit)->getResultArray();
		foreach ($data as $bestSeller) {
			$BestSellerProducts[$bestSeller['product_id']] = $this->getProductByproductDetail($bestSeller['product_id']);
		}
		return $BestSellerProducts;
	}


	public function getModule($moduleID)
	{
		return $this->db->table('sky_module')->getWhere(['module_id' => $moduleID])->getRowArray();
	}

	public function getFeaturedProduct()
	{
		$module 	= $this->getModule('e0c93a16-509a-46ae-85d5-fe1e3ae3d0fb');
		$moduleData = unserialize($module['setting']);
		return $moduleData['product'];
	}
}

<?php

namespace App\Models\Account;

use CodeIgniter\Model;
use App\Libraries\Rajaongkir;

class CustomerModel extends Model
{
	protected $rajaongkir;

	public function getCustomerByID($customerID)
	{
		return $this->db->table('customers')
			->select('
				customer_fullname,
				customer_email,
				customer_whatsapp,
				address,
				customer_id,
				profile_image,
				')
			->getWhere(['customer_id' => $customerID])->getRowArray();
	}
	public	function getCustomerByEmail($email)
	{
		return $this->db->table('customers')
			->select('
				customer_fullname,
				customer_email,
				customer_whatsapp,
				customers.customer_id,
				profile_image,
				password,
				salt,
				token,
				')
			->getWhere(['customer_email' => $email])->getRowArray();
	}
	// public function getAddress($customerID, $profile = false)
	// {
	// 	if ($profile) {
	// 		return $this->db->table('customer_address')
	// 			// ->select('customer_address.,customer_address.customer_id, customer_fullname,customer_address,customer_subdistrict,customer_city, customer_province, customer_postcode, customer_subdistrict_id, customer_city_id, customer_province_id')
	// 			->join('customers', 'customers.customer_id = customer_address.customer_id')
	// 			->orderBy('customers.')
	// 			->getWhere(['customer_address.customer_id' => $customerID])
	// 			->getResultArray();
	// 	}
	// 	return $this->db->table('customers')
	// 		->select('customer_address.,customer_address.customer_id, customer_fullname,customer_address,customer_subdistrict,customer_city, customer_province, customer_postcode, customer_subdistrict_id, customer_city_id, customer_province_id')
	// 		->join('customer_address', 'customers. = customer_address.')
	// 		->getWhere(['customers.customer_id' => $customerID])->getRowArray();
	// }
	function customerLogin($customerID, $customerPlatform, $CustomerUserAgent)
	{
		return $this->db->table('customer_login')->insert([
			'customer_id'			=> $customerID,
			'user_agent'			=> $CustomerUserAgent . ' (' . $customerPlatform . ")",
			'created_at'			=> time()
		]);
	}
	function saveCustomer($customer, $token)
	{
		$this->db->transBegin();
		$salt 			= substr(md5(uniqid(rand(), true)), 0, 9);
		$name			= htmlspecialchars($customer['inputName']);
		$this->db->table('customers')->insert([
			'customer_fullname'		=> $name,
			'customer_email'		=> htmlspecialchars(strtolower($customer['inputEmail'])),
			'created_at'			=> time()
		]);
		$customerID = $this->db->insertID();
		$this->db->table('customer_credential')->insert([
			'customer_id'		=> $customerID,
			'password'			=> sha1($salt . sha1($salt . sha1($customer['inputPassword']))),
			'salt'				=> $salt,
			'token'				=> $token,
		]);
		if ($this->db->transStatus() === FALSE) {
			$this->db->transRollback();
			return false;
		} else {
			$this->db->transCommit();
			return true;
		}
	}

	public function registrationFailed($email)
	{
		$this->db->transBegin();
		$customer 	= $this->getCustomerByEmail($email);
		$this->db->table('customers')->delete(['customer_email' => $email]);

		if ($this->db->transStatus() === false) {
			$this->db->transRollback();
			return false;
		} else {
			$this->db->transCommit();
			return true;
		}
	}

	function customerActivation($email)
	{
		return $this->db->table('customers')->update(['is_active' => 1], ['customer_email' => $email]);
	}

	function updateProfile($profile)
	{
		return $this->db->table('customers')->update([
			'customer_fullname' => $profile['inputName'],
			'customer_whatsapp' => $profile['inputTelephone'],
			'customer_address'	=> $profile['inputAddress'],
			'updated_at'		=> time()
		], ['customer_id' => $profile['customerID']]);
	}

	function resetToken($email, $token)
	{
		$customer = $this->db->table('customers')->getWhere(['customer_email' => $email, 'is_active' => '1'])->getRowArray();
		return $this->db->table('customer_credential')->update(['token' => $token], ['customer_id' => $customer['customer_id']]);
	}
	function resentEmail($email, $token)
	{
		$customer = $this->db->table('customers')->getWhere(['customer_email' => $email, 'is_verified' => '1'])->getRowArray();
		return $this->db->table('customer_credential')->update(['token' => $token], ['customer_id' => $customer['customer_id']]);
	}
	function getForgot($email)
	{
		return $this->db->table('customers')->select('customer_fullname, customer_email')->getWhere(['customer_email' => $email, 'is_active' => 1])->getRowArray();
	}

	function changePassword($dataInput, $token)
	{
		$this->db->transBegin();
		$salt = substr(md5(uniqid(rand(), true)), 0, 9);
		$customer = $this->getCustomerByEmail($dataInput['inputEmail']);
		$this->db->table('customers')->update([
			'password' 			=> sha1($salt . sha1($salt . sha1($dataInput['inputPassword']))),
			'salt'				=> $salt,
			'token'				=> $token,
			'updated_at' 		=> time()
		], ['customer_id' => $customer['customer_id']]);
		if ($this->db->transStatus() === FALSE) {
			$this->db->transRollback();
			return false;
		} else {
			$this->db->transCommit();
			return true;
		}
	}
	public function setSession($email, $session)
	{
		return $this->db->table('customers')->update(['session' => $session], ['customer_email' => $email]);
	}
	public function checkSession($session, $email)
	{
		return $this->db->table('customers')->select('session, customer_email')->getWhere(['session' => $session, 'customer_email' => base64_decode($email)])->getRowArray();
	}
	public function changeProfilePicture($dataProfilePicture, $customerId)
	{
		return $this->db->table('customers')->update(['profile_image' => $dataProfilePicture, 'updated_at' => time()], ['customer_id' => $customerId]);
	}
	public function checkPassword($password, $customerID)
	{
		$salt = substr(md5(uniqid(rand(), true)), 0, 9);
		$password = sha1($salt . sha1($salt . sha1($password)));
		return $this->db->table('customer_credential')->select('customer_id, password')->where(['customer_id' => $customerID, 'password' => $password])->countAllResults();
	}
	public function getWishlist($customerID, $productID = null)
	{
		if ($productID) {
			return $this->db->table('customer_wishlist')->getWhere(['customer_id' => $customerID, 'product_id' => $productID, 'customer_wishlist.deleted_at' => null])->getRowArray();
		} else {
			return $this->db->table('customer_wishlist')
				->join('products', 'products.product_id = customer_wishlist.product_id')
				->join('stock_status', 'products.stock_status_id = stock_status.stock_status_id', 'left')
				->getWhere(['customer_id' => $customerID, 'customer_wishlist.deleted_at' => null])->getResultArray();
		}
	}
	public function addToWishlist($customerID, $productID)
	{
		$checkWishlist = $this->getWishlist(customerID: $customerID, productID: $productID);
		if ($checkWishlist == null) {
			return $this->db->table('customer_wishlist')->insert(['customer_id' => $customerID, 'product_id' => $productID]);
		} else {
			return true;
		}
	}
	public function deleteWishlist($customerID, $productID)
	{
		return $this->db->table('customer_wishlist')->update(['deleted_at' => time()], ['customer_id' => $customerID, 'product_id' => $productID]);
	}
}

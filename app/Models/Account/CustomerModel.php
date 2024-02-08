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
				customer_telephone,
				address_id,
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
				customer_telephone,
				address_id,
				customers.customer_id,
				profile_image,
				password,
				salt,
				token,
				is_active
				')
			->join('customer_credential', 'customers.customer_id = customer_credential.customer_id')
			->getWhere(['customer_email' => $email])->getRowArray();
	}
	public function getAddress($customerID, $profile = false)
	{
		if ($profile) {
			return $this->db->table('customer_address')
				->select('customer_address.address_id,customer_address.customer_id, customer_fullname,customer_address,customer_subdistrict,customer_city, customer_province, customer_postcode, customer_subdistrict_id, customer_city_id, customer_province_id')
				->join('customers', 'customers.customer_id = customer_address.customer_id')
				->orderBy('customers.address_id')
				->getWhere(['customer_address.customer_id' => $customerID])
				->getResultArray();
		}
		return $this->db->table('customers')
			->select('customer_address.address_id,customer_address.customer_id, customer_fullname,customer_address,customer_subdistrict,customer_city, customer_province, customer_postcode, customer_subdistrict_id, customer_city_id, customer_province_id')
			->join('customer_address', 'customers.address_id = customer_address.address_id')
			->getWhere(['customers.customer_id' => $customerID])->getRowArray();
	}
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
			'address_id'			=> 0,
			'customer_fullname'		=> $name,
			'customer_email'		=> htmlspecialchars(strtolower($customer['inputEmail'])),
			'is_active'				=> 0,
			'is_verified'			=> 1,
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
		$this->db->table('customer_credential')->delete(['customer_id' => $customer['customer_id']]);

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
			'customer_telephone' => $profile['inputTelephone'],
			'updated_at'		=> time()
		], ['customer_id' => $profile['customerID']]);
	}

	public function addCustomerAddress($customerAddress)
	{
		$this->db->transBegin();
		$this->rajaongkir   = new Rajaongkir();
		$provinceID         = $customerAddress['inputProvince'];
		$cityID             = $customerAddress['inputCity'];
		$subdistrictID      = $customerAddress['inputSubdistrict'];
		$getProvince        = $this->rajaongkir->getProvince($provinceID, '');
		$provinceName       = $getProvince['province'];
		$getCity            = $this->rajaongkir->getCity($cityID, '');
		$cityName           = $getCity['type'] . ' ' . $getCity['city_name'];
		$postalCode         = $customerAddress['inputPostalcode'];

		if ($subdistrictID) {
			$getSubdistrict  = $this->rajaongkir->getSubdistrict($subdistrictID, '');
			$subdistrictName = $getSubdistrict['subdistrict_name'];
		} else {
			$subdistrictName = '';
		}
		$addressID = uuid();
		$this->db->table('customer_address')->insert([
			'customer_id'       		 => $customerAddress['customerID'],
			'customer_address'         	 => $customerAddress['inputAddress'],
			'customer_postcode'          => $postalCode,
			'customer_province_id'       => $provinceID,
			'customer_province'          => $provinceName,
			'customer_city_id'           => $cityID,
			'customer_city'              => $cityName,
			'customer_subdistrict_id'    => $subdistrictID,
			'customer_subdistrict'       => $subdistrictName,
		]);
		$addressID = $this->db->insertID();
		$this->db->table('customers')->update([
			'address_id' 			=> $addressID,
			'customer_fullname' 	=> $customerAddress['inputReceipent'],
			'updated_at'			=> time()
		], ['customer_id' => $customerAddress['customerID']]);

		if ($this->db->transStatus() === FALSE) {
			$this->db->transRollback();
			return false;
		} else {
			$this->db->transCommit();
			return true;
		}
	}
	public function updateAddress($customerAddress)
	{
		$this->db->transBegin();
		$this->rajaongkir   = new Rajaongkir();
		$provinceID         = $customerAddress['inputProvince'];
		$cityID             = $customerAddress['inputCity'];
		$subdistrictID      = $customerAddress['inputSubdistrict'];
		$getProvince        = $this->rajaongkir->getProvince($provinceID, '');
		$provinceName       = $getProvince['province'];
		$getCity            = $this->rajaongkir->getCity($cityID, '');
		$cityName           = $getCity['type'] . ' ' . $getCity['city_name'];
		$postalCode         = $customerAddress['inputPostalcode'];

		if ($subdistrictID) {
			$getSubdistrict  = $this->rajaongkir->getSubdistrict($subdistrictID, '');
			$subdistrictName = $getSubdistrict['subdistrict_name'];
		} else {
			$subdistrictName = '';
		}
		$this->db->table('customer_address')->update([
			'customer_id'       		 => $customerAddress['CustomerID'],
			'customer_address'         	 => $customerAddress['inputAddress'],
			'customer_postcode'          => $postalCode,
			'customer_province_id'       => $provinceID,
			'customer_province'          => $provinceName,
			'customer_city_id'           => $cityID,
			'customer_city'              => $cityName,
			'customer_subdistrict_id'    => $subdistrictID,
			'customer_subdistrict'       => $subdistrictName,
		], ['address_uuid' => $customerAddress['AddressID']]);
		if ($this->db->transStatus() === FALSE) {
			$this->db->transRollback();
			return false;
		} else {
			$this->db->transCommit();
			return true;
		}
	}
	public function changeCustomerMainAddress($dataAddress)
	{
		return $this->db->table('customers')->update([
			'address_id' 		=> $dataAddress['AddressID'],
			'updated_at'		=> time()
		], ['customer_id' => $dataAddress['customerID']]);
	}
	public function deleteAddress($dataAddress)
	{
		$this->db->transBegin();
		$this->db->table('customer_address')->update(['address_id' => $dataAddress['AddressID'], 'deleted_at' => time()], ['customer_id' => $dataAddress['CustomerID']]);
		$address = $this->db->table('customer_address')->where(['customer_id' => $dataAddress['CustomerID'], 'deleted_at' => null])->countAllResults();
		if ($address >= 0) {
			$addressID = $this->db->table('customer_address')->select('address_id, customer_id')->getwhere(['customer_id' => $dataAddress['CustomerID']])->getRowArray();
			$this->db->table('customers')->update(['address_id' => $addressID['address_id'], 'updated_at' => time()], ['customer_id' => $dataAddress['CustomerID']]);
		} else {
			$this->db->table('customers')->update(['address_id' => '', 'updated_at' => time()], ['customer_id' => $dataAddress['CustomerID']]);
		}
		if ($this->db->transStatus() === FALSE) {
			$this->db->transRollback();
			return false;
		} else {
			$this->db->transCommit();
			return true;
		}
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
	function customerActivity($customer_id, $activity, $name, $ipAddress)
	{
		$dataCustomer 		= serialize([
			'customer_id' => $customer_id,
			'name'		  => $name
		]);
		$this->db->table('customer_activity')->insert([
			'customer_id'	=> $customer_id,
			'activity'		=> $activity,
			'data'			=> $dataCustomer,
			'ip_address'	=> $ipAddress,
			'created_at'	=> time()
		]);
	}

	function changePassword($dataInput, $token, $ipAddress)
	{
		$this->db->transBegin();
		$salt = substr(md5(uniqid(rand(), true)), 0, 9);
		$customer = $this->getCustomerByEmail($dataInput['inputEmail']);
		$this->db->table('customers')->update(['ip_address' => $ipAddress, 'updated_at' => time()], ['customer_id' => $customer['customer_id']]);
		$this->db->table('customer_credential')->update([
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

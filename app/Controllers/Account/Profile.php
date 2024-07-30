<?php

namespace App\Controllers\Account;

use App\Controllers\BaseController;
use App\Models\Transaction\SalesModel;

class Profile extends BaseController
{
	public function __construct()
	{
		$this->SalesModel 			= new SalesModel();
	}
	public function index()
	{
		$resource = $this->request->uri->getSegment(1);
		if (!$resource) {
			$resource = 0;
		}
		if (session()->get('isLoggedIn') != TRUE) {
			return redirect()->to(base_url('login'));
		}
		$phone = $this->data['customer']['customer_whatsapp'];
		if ($phone == '') {
			session()->setFlashdata('warningSwall', 'Silahkan lengkapi nomor telepon anda.');
		}
		$data = array_merge($this->data, [
			'title'         => 'Akun Saya Website Karnivor',
			'description'   => '',
			'keyword'   	=> '',
			'Rescource'		=> $resource
		]);
		return view('account/profile/profile', $data);
	}

	public function updateProfile()
	{
		$customer 		= $this->customerModel->getCustomerByEmail($this->request->getPost('inputEmail', FILTER_SANITIZE_EMAIL));
		if ($customer) {
			$updateProfile = $this->customerModel->updateProfile($this->request->getPost());
			if ($updateProfile) {
				session()->remove('CustName');
				session()->set('CustName', $customer['customer_fullname']);
				session()->setFlashdata('success', '<b><i class="fas fa-check-circle"></i> Sukses!</b> Data diri berhasil diperbarui ');
				return redirect()->to(base_url('profile'));
			} else {
				session()->setFlashdata('error', '<b><i class="fas fa-exclamation-triangle"></i> Ooops..</b>  Data diri gagal diperbarui! ');
				return redirect()->to(base_url('profile'));
			}
		} else {
			session()->setFlashdata('error', '<b><i class="fas fa-exclamation-triangle"></i> Ooops..</b>  Data diri gagal diperbarui! ');
			return redirect()->to(base_url('profile'));
		}
	}
	// public function addCustomerAddress()
	// {
	// 	$addCustomerAddress = $this->customerModel->addCustomerAddress($this->request->getPost());
	// 	if ($addCustomerAddress) {
	// 		$ipAddress        = $this->request->getIPAddress();
	// 		$this->customerModel->customerActivity(session()->get('CID'), 'Customer Address Add', session()->get('CustName'), $ipAddress);
	// 		session()->setFlashdata('success', '<b><i class="fas fa-check-circle"></i> Sukses!</b> Alamat berhasil ditambahkan ');
	// 		return redirect()->to(base_url('profile'));
	// 	} else {
	// 		session()->setFlashdata('error', '<b><i class="fas fa-exclamation-triangle"></i> Ooops..</b>  Alamat gagal ditambahkan! ');
	// 		return redirect()->to(base_url('profile'));
	// 	}
	// }
	// public function updateAddress()
	// {
	// 	$updateAddress = $this->customerModel->updateAddress($this->request->getPost());
	// 	if ($updateAddress) {
	// 		$ipAddress        = $this->request->getIPAddress();
	// 		$this->customerModel->customerActivity(session()->get('CID'), 'Customer Address Update', session()->get('CustName'), $ipAddress);
	// 		session()->setFlashdata('success', '<b><i class="fas fa-check-circle"></i> Sukses!</b> Alamat berhasil diubah ');
	// 		return redirect()->to(base_url('profile'));
	// 	} else {
	// 		session()->setFlashdata('error', '<b><i class="fas fa-exclamation-triangle"></i> Ooops..</b>  Alamat gagal diubah! ');
	// 		return redirect()->to(base_url('profile'));
	// 	}
	// }
	// public function changeCustomerMainAddress()
	// {
	// 	$changeCustomerMainAddress = $this->customerModel->changeCustomerMainAddress($this->request->getPost());
	// 	if ($this->request->getPost('param') == 1) {
	// 		if ($changeCustomerMainAddress) {
	// 			$ipAddress        = $this->request->getIPAddress();
	// 			$this->customerModel->customerActivity(session()->get('CID'), 'Change Main Address', session()->get('CustName'), $ipAddress);
	// 			session()->setFlashdata('success', '<b><i class="fas fa-check-circle"></i> Sukses!</b> Alamat berhasil pilih ');
	// 			return redirect()->to(base_url('checkout'));
	// 		} else {
	// 			session()->setFlashdata('error', '<b><i class="fas fa-exclamation-triangle"></i> Ooops..</b>  Alamat gagal pilih! ');
	// 			return redirect()->to(base_url('checkout'));
	// 		}
	// 	}
	// 	if ($changeCustomerMainAddress) {
	// 		session()->setFlashdata('success', '<b><i class="fas fa-check-circle"></i> Sukses!</b> Alamat berhasil dipilih sebagai alamat utama');
	// 		return redirect()->to(base_url('profile'));
	// 	} else {
	// 		session()->setFlashdata('error', '<b><i class="fas fa-exclamation-triangle"></i> Ooops..</b>  Alamat gagal dipilih! ');
	// 		return redirect()->to(base_url('profile'));
	// 	}
	// }
	// public function deleteAddress()
	// {
	// 	$deleteAddress = $this->customerModel->deleteAddress($this->request->getPost());
	// 	if ($deleteAddress) {
	// 		$ipAddress        = $this->request->getIPAddress();
	// 		$this->customerModel->customerActivity(session()->get('CID'), 'Deleted Address', session()->get('CustName'), $ipAddress);
	// 		session()->setFlashdata('success', '<b><i class="fas fa-check-circle"></i> Sukses!</b> Alamat berhasil dihapus ');
	// 		return redirect()->to(base_url('profile'));
	// 	} else {
	// 		session()->setFlashdata('error', '<b><i class="fas fa-exclamation-triangle"></i> Ooops..</b>  Alamat gagal dihapus! ');
	// 		return redirect()->to(base_url('profile'));
	// 	}
	// }
	public function changeProfilePicture()
	{
		if (!$this->validate([
			'profilePicture'  => [
				'rules'     => 'uploaded[profilePicture]|max_size[profilePicture,5120]|is_image[profilePicture]|mime_in[profilePicture,image/jpg,image/png,image/jpeg]',
				'errors'    => [
					'uploaded'  => 'Pilih gambar terlebih dahulu',
					'max_size'  => 'Ukuran gambar terlalu besar',
					'is_image'  => 'Yang anda pilih bukan gambar',
					'mime_in'  => 'Yang anda pilih bukan gambar'
				]
			],
		])) {
			session()->setFlashdata('error', '<b><i class="fas fa-exclamation-triangle"></i> Gagal</b> Ubah Foto Profile');
			return redirect()->back()->withInput();
		}

		$fileProfilePicture = $this->request->getFile('profilePicture');									//Ambil Gambar
		$oldFileProfilePicture = $this->request->getPost('OldProfilePicture');
		$customer = $this->customerModel->getCustomerByID(session()->get('CID'));							// data Lama
		if ($oldFileProfilePicture && $oldFileProfilePicture != '') {
			unlink('assets/images/' . $oldFileProfilePicture); 			// hapus data lama
		}
		$path = "customers/" . $customer['customer_id'] . '/profile/';
		$fileName = $fileProfilePicture->getRandomName(); // Ganti Nama
		$changeProfilePicture = $this->customerModel->changeProfilePicture($path . $fileName, session()->get('CID'));
		if ($changeProfilePicture) {
			$dir =   'assets/images/' . $path;
			if (!file_exists($dir)) {
				mkdir($dir, 0777, true);
			}
			$fileProfilePicture->move($dir, $fileName);
			session()->setFlashdata('success', '<b><i class="fas fa-exclamation-triangle"></i> Berhasil</b> Ubah Foto Profile ');
			return redirect()->to(base_url('profile'));
		} else {
			session()->setFlashdata('error', '<b><i class="fas fa-exclamation-triangle"></i> Gagal</b> Ubah Foto Profile ');
			return redirect()->to(base_url('profile'));
		}
	}
	public function changePassword()
	{
		if (session()->get('isLoggedIn') != TRUE) {
			return redirect()->to(base_url('login'));
		}
		$data = array_merge($this->data, [
			'title'         => 'Ubah Kata Sandi di Situs Pneumatic, Hydraulic, Networking, Software Terlengkap dan Terpercaya',
			'description'   => '',
			'keyword'   	=> '',
		]);
		return view('account/profile/changePassword', $data);
	}
	public function checkPassword()
	{
		$email = $this->request->getPost('email');
		$customer 	= $this->customerModel->getCustomerByEmail($email);
		$salt		= $customer['salt'];
		$password 	= sha1($salt . sha1($salt . sha1($this->request->getPost('password'))));
		if ($password == $customer['password']) {
			return '1';
		} else {
			return '0';
		}
	}
	public function savechangePassword()
	{
		if (!$this->validate([
			'inputPasswordNow'  => [
				'rules'     => 'required',
				'errors'    => [
					'required'  => 'Isikan password dengan benar',
				]
			],
			'inputPassword'     => [
				'rules'     => 'required|min_length[6]',
				'errors'    => [
					'required'  	=> 'Isikan password dengan benar',
					'min_length'	=> 'Minimum password 6 karakter'
				]
			],
			'inputRetypePassword' 	=> [
				'rules'     => 'required|matches[inputPassword]',
				'errors'    => [
					'matches'  		=> 'Password tidak sama',
					'min_length'	=> 'Minimum password 6 karakter'
				]
			],
		])) {
			session()->setFlashdata('error', '<b><i class="fas fa-exclamation-triangle"></i> Gagal</b> Ubah Password');
			return redirect()->to(base_url('profile/changePassword'))->withInput();
		}
		$email			= strtolower(session()->get('email'));
		$customer 		= $this->customerModel->getCustomerByEmail($email);
		$token 			= base64_encode(random_bytes(32));
		if ($customer) {
			$savePassword = $this->customerModel->changePassword(['inputEmail' => $email, 'inputPassword' => $this->request->getPost('inputPassword')], $token);
			if ($savePassword) {
				session()->setFlashdata('success', '<b><i class="fas fa-check-circle"></i> Kode Otp benar!</b> <br> Silahkan isikan password baru anda! ');
				return redirect()->to(base_url('logout'));
			} else {
				session()->setFlashdata('error', '<b><i class="fas fa-exclamation-triangle"></i> Ubah kata sandi gagal</b> Silahkan masukan password dengan benar!');
				return redirect()->to(base_url('profile/changePassword'));
			}
		}
	}
}

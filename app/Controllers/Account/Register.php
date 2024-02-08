<?php

namespace App\Controllers\Account;

use App\Controllers\BaseController;

class Register extends BaseController
{
	public function index()
	{
		$data = array_merge($this->data, [
			'title'         => 'Daftar Website Karnivor.id',
			'description'   => '',
			'keyword'   	=> '',
		]);
		return view('account/login/register', $data);
	}

	public function registration()
	{
		if (!$this->validate([
			'inputName'  => [
				'rules'     => 'required|trim|min_length[3]',
				'errors'    => [
					'min_length' => 'Nama harus minimal 3 karakter.'
				]
			],
			'inputEmail' => [
				'rules'     => 'required|valid_email|is_unique[customers.customer_email]',
				'errors'    => [
					'valid_email' 	=> 'Format email salah!',
					'is_unique' 	=> 'Email ({value}) sudah terdaftar! silahkan login atau menggunakan email lainnya.'
				]
			],
			'inputPassword'     	=> [
				'rules'     => 'required|min_length[6]',
				'errors'    => [
					'min_length' => 'Password minimal 6 karakter.'
				]
			],

			'inputRetypePassword' 	=> 'required|matches[inputPassword]',
		])) {
			session()->setFlashdata('error', '<b><i class="fas fa-exclamation-triangle"></i> Ooops..</b> Registrasi Gagal!' . validation_list_errors());
			return redirect()->to(base_url('/register'))->withInput();
		}
		$email 			= strtolower($this->request->getPost('inputEmail', FILTER_SANITIZE_EMAIL));
		$token 			= base64_encode(random_bytes(32));
		$saveCustomer 	= $this->customerModel->saveCustomer($this->request->getPost(), $token);
		if ($saveCustomer) {
			$this->email->setTo($email);
			$this->email->setFrom(getenv('configEmail.setting'), getenv('configName.setting'));
			$this->email->setSubject('Verifikasi Akun');
			$this->email->setMessage(view('email/verification', ['email' => $email, 'token' => $token, 'fullname' => $this->request->getPost('inputName')]));
			$dataCookie = base64_encode(serialize(['fullname' => $this->request->getPost('inputName'), 'email' => $email, 'time' => time()]));
			if ($this->email->send()) {
				setcookie("_karnivor", $dataCookie);
				session()->setFlashdata('success', '<b><i class="fas fa-check-circle"></i> Link Aktivasi Berhasil Dikirim!</b> <br>  Silahkan Cek Email Untuk Verifikasi Akun Anda.  ');
				return redirect()->to(base_url('registration'));
			} else {
				$this->customerModel->registrationFailed($email);
				session()->setFlashdata('error', '<b><i class="fas fa-exclamation-triangle"></i> Ooops..</b> Registrasi Gagal!  Pastikan alamat email valid. ');
				return redirect()->to(base_url('/register'));
			}
		}
	}
	public function afterRegist()
	{
		if ($_COOKIE['_karnivor'] && $_COOKIE['_karnivor'] != 'null') {
			$dataCookie 	= base64_decode($_COOKIE['_karnivor']);
			$cookie 		= unserialize($dataCookie);
		} else {
			return redirect()->to(base_url());
		}
		$data = array_merge($this->data, [
			'title'         => 'Daftar Website Karnivor.id',
			'description'   => '',
			'keyword'   	=> '',
			'time'			=> $cookie['time']
		]);
		return view('account/login/registration', $data);
	}
	public function resentEmail()
	{
		$dataCookie 	= base64_decode($_COOKIE['_karnivor']);
		$data 			= unserialize($dataCookie);
		$email 			= strtolower($data['email']);
		$token 			= base64_encode(random_bytes(32));
		$resentEmail 	= $this->customerModel->resentEmail($email, $token);
		if ($resentEmail) {
			$this->email->setTo($email);
			$this->email->setFrom(getenv('configEmail.setting'), getenv('configName.setting'));
			$this->email->setSubject('Verifikasi Akun');
			$this->email->setMessage(view('email/verification', ['email' => $email, 'token' => $token, 'fullname' => $data['fullname']]));
			$dataCookie = base64_encode(serialize(['fullname' => $this->request->getPost('inputName'), 'email' => $email, 'time' => time()]));
			if ($this->email->send()) {
				setcookie("_karnivor", $dataCookie);
				session()->setFlashdata('success', '<b><i class="fas fa-check-circle"></i> Link Aktivasi Berhasil Dikirim!</b> <br>  Silahkan Cek Email Untuk Verifikasi Akun Anda.  ');
				return redirect()->to(base_url('registration'));
			} else {
				$this->customerModel->registrationFailed($email);
				session()->setFlashdata('error', '<b><i class="fas fa-exclamation-triangle"></i> Ooops..</b> Registrasi Gagal!  Pastikan alamat email valid. ');
				return redirect()->to(base_url('/register'));
			}
		}
	}
	public function verify()
	{
		$email 			= base64_decode($this->request->getGet('em'));
		$token 			= $this->request->getGet('token');
		$customer 		= $this->customerModel->getCustomerByEmail($email);
		if ($customer) {
			if ($token == $customer['token']) {
				$dir =  APPPATH . '../' . '../' . 'assets/images/customers/' . $customer['customer_id'] . '/profile';
				if (!file_exists($dir)) {
					mkdir($dir, 0777, true);
				}
				$ipAddress		= $this->request->getIPAddress();
				$this->customerModel->customerActivity($customer['customer_id'], 'login',  $customer['customer_fullname'], $ipAddress);
				$this->customerModel->customerActivation($email);
				session()->setFlashdata('success', '<b><i class="fas fa-check-circle"></i> Sukses!</b> Akun Berhasil diverifikasi ');
				return redirect()->to(base_url('login'));
			} else {
				session()->setFlashdata('error', '<b><i class="fas fa-exclamation-triangle"></i> Ooops..</b> Aktivasi Gagal Token Tidak Berlaku!  ');
				return redirect()->to(base_url('register'));
			}
		} else {
			session()->setFlashdata('error', '<b><i class="fas fa-exclamation-triangle"></i> Ooops..</b> A\ktivasi Gagal Email Belum Terdaftar!  ');
			return redirect()->to(base_url('register'));
		}
	}
}

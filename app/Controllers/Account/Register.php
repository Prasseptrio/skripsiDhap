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
				'rules'     => 'required|is_unique[customers.customer_email]',
				'errors'    => [
					// 'valid_email' 	=> 'Format email salah!',
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
			return redirect()->to(base_url('register'))->withInput();
		}
		$token 			= base64_encode(random_bytes(32));
		$saveCustomer 	= $this->customerModel->saveCustomer($this->request->getPost(), $token);
		dd($saveCustomer);
		if ($saveCustomer) {
			session()->setFlashdata('success', '<b><i class="fas fa-check-circle"></i> Link Aktivasi Berhasil Dikirim!</b> <br>  Silahkan Cek Email Untuk Verifikasi Akun Anda.  ');
			return redirect()->to(base_url('login'));
		} else {
			session()->setFlashdata('error', '<b><i class="fas fa-exclamation-triangle"></i> Ooops..</b> Registrasi Gagal!  Pastikan alamat email valid. ');
			return redirect()->to(base_url('register'));
		}
	}
}

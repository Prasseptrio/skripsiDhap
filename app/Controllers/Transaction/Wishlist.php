<?php

namespace App\Controllers\Transaction;

use App\Controllers\BaseController;
use App\Models\Account\CustomerModel;
use App\Models\Transaction\SalesModel;

class Wishlist extends BaseController
{
    function __construct()
    {
        $this->SalesModel = new SalesModel();
        $this->customerModel = new CustomerModel();
    }
    public function index()
    {
        if (session()->get('isLoggedIn') != TRUE) {
            return redirect()->to(base_url('login'));
        }
        $Cart = $this->SalesModel->getCart(session()->get('CID'));
        if (!$Cart) {
            $Cart = 0;
        }
        $data = array_merge($this->data, [
            'title'                  => "Keranjang Belanja",
            'description'            => "Website Karnevor",
            'titlesub'               => "Keranjang Belanja",
            'keyword'                => "",
            'Cart'                   => $Cart,
        ]);
        $this->cart->destroy();
        $lastSales = $this->SalesModel->getLastSalesOrderByCustomerID(session()->get('CID'));
        if ($lastSales) {
            return redirect()->to(base_url('agree?inv=' . base64_encode($lastSales['invoice_no'])));
        } else {
            return view('checkout/cart', $data);
        }
    }
    public function checkout()
    {
        if (session()->get('isLoggedIn') != TRUE) {
            return redirect()->to(base_url('login'));
        }
        if ($this->cart->contents() == null || $this->cart->contents() == 0) {
            session()->setFlashdata('error', '<b><i class="fas fa-exclamation-triangle"></i></b> keranjang masih kosong ');
            return redirect()->to(base_url('cart'));
        }
        $phone = $this->data['customer']['customer_whatsapp'];
        $address = $this->data['customer']['address'];
        if ($phone == '') {
            session()->setFlashdata('warningSwall', 'Silahkan lengkapi nomor telepon anda.');
            return redirect()->to(base_url('profile'));
        }
        if ($address == '') {
            session()->setFlashdata('warningSwall', 'Silahkan lengkapi Alamat Rumah anda.');
            return redirect()->to(base_url('profile'));
        }
        $data = array_merge($this->data, [
            'title'             => "Checkout",
            'description'       => "Website Karnevor",
            'titlesub'          => "Checkout",
            'keyword'           => "",
            'Total'             => $this->cart->total(),
        ]);
        return view('checkout/checkout', $data);
    }
    public function addToCart()
    {
        if (session()->get('isLoggedIn') != TRUE) {
            return redirect()->to(base_url('logout'));
        }
        if ($this->request->getPost('resource')) {
            $this->customerModel->deleteWishlist(customerID: session()->get('CID'), productID: $this->request->getPost('productID'));
            $addToCart    = $this->SalesModel->addToCart($this->request->getPost(null));
        } else {
            $addToCart    = $this->SalesModel->addToCart($this->request->getPost(null));
        }
        if ($addToCart) {
            session()->setFlashdata('success', '<b><i class="fas fa-check-circle"></i> Sukses!</b> barang dimasukan Keranjang ');
            return redirect()->to(base_url('cart'));
        } else {
            session()->setFlashdata('error', '<b><i class="fas fa-exclamation-triangle"></i> Gagal</b> memasukan barang kedalam Keranjang  ');
            return redirect()->to(base_url('cart'));
        }
    }
    public function deleteProductCart()
    {
        $deleteProductCart    = $this->SalesModel->deleteProductCart($this->request->getPost('productID'));
        if ($deleteProductCart) {
            session()->setFlashdata('successSwal', '<b>Sukses!</b> menghapus barang dari Keranjang ');
            return redirect()->to(base_url('cart'));
        } else {
            session()->setFlashdata('errorSwal', '<b>Gagal</b> menghapus barang dari Keranjang  ');
            return redirect()->to(base_url('cart'));
        }
    }
    public function saveSalesOrder()
    {
        $saveSalesOrder = $this->SalesModel->saveSalesOrder($this->cart->contents(), $this->request->getPost(null), $this->cart->total());
        if ($saveSalesOrder) {
            return redirect()->to(base_url('agree?inv=' . base64_encode($saveSalesOrder)));
        } else {
            session()->setFlashdata('error', '<b><i class="fas fa-exclamation-triangle"></i> Gagal</b> melanjutkan transaksi  ');
            return redirect()->to(base_url('checkout'));
        }
    }
    public function agreement()
    {
        if (session()->get('isLoggedIn') != TRUE) {
            return redirect()->to(base_url('login'));
        }
        $invoice = $this->request->getGet('inv');
        $lastSales = $this->SalesModel->getLastSalesOrderByCustomerID(session()->get('CID'));
        if (!$lastSales) {
            session()->setFlashdata('error', '<b><i class="fas fa-exclamation-triangle"></i> Gagal</b> melanjutkan transaksi ');
            return redirect()->to(base_url('transaction'));
        }
        $salesOrder = $this->SalesModel->getSalesOrderByInvoice(base64_decode($invoice));
        $data = array_merge($this->data, [
            'title'             => "Pembayaran",
            'description'       => "Website Karnevor",
            'titlesub'          => "Pembayaran",
            'keyword'           => "",
            'SalesOrder'        => $salesOrder,
            'SalesOrderProduct' => $this->SalesModel->getSalesOrderProductByOrderID($salesOrder['order_id']),
            'invoice'           => base64_decode($invoice)
        ]);
        return view('checkout/agreement', $data);
    }
    public function cancelOrder()
    {
        $cancelOrder = $this->SalesModel->cancelOrder(base64_decode($this->request->getGet('inv')));
        if ($cancelOrder) {
            session()->setFlashdata('success', '<b><i class="fas fa-exclamation-triangle"></i> Berhasil</b> membatalkan transaksi');
            return redirect()->to(base_url(''));
        } else {
            session()->setFlashdata('error', '<b><i class="fas fa-exclamation-triangle"></i> Gagal</b> membatalkan transaksi transaksi  ');
            return redirect()->to(base_url('cart'));
        }
    }
    public function savePaymentProof()
    {
        if (session()->get('isLoggedIn') != TRUE) {
            return redirect()->to(base_url('logout'));
        }
        $invoice = $this->request->getPost('invoice');
        if (!$this->validate([
            'PaymentFile'  => [
                'rules'     => 'uploaded[PaymentFile]|max_size[PaymentFile,512]|is_image[PaymentFile]|mime_in[PaymentFile,image/jpg,image/jpeg,image/png]',
                'errors'    => [
                    'uploaded'  => 'Pilih gambar terlebih dahulu',
                    'max_size'  => 'Ukuran gambar terlalu besar',
                    'is_image'  => 'Yang anda pilih bukan gambar',
                    'mime_in'  => 'Yang anda pilih bukan gambar'
                ]
            ],
        ])) {
            session()->setFlashdata('error', '<b><i class="fas fa-exclamation-triangle"></i> Gagal</b> melanjutkan transaksi, Foto tidak sesuai ');
            return redirect()->to(base_url('agree?inv=' . base64_encode($invoice)))->withInput();
        }
        $filePayment = $this->request->getFile('PaymentFile');
        $ext = $filePayment->guessExtension();
        $fileName = $invoice . '.' . $ext;
        $savePaymentProof = $this->SalesModel->savePaymentProof($this->request->getPost(null),  $fileName);
        if ($savePaymentProof) {
            $customer = $this->customerModel->getCustomerByID(session()->get('CID'));
            $dir = 'assets/images/customers/' . $customer['customer_id'] . '/paymentProof/';
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }
            $filePayment->move($dir, $fileName);
            session()->setFlashdata('success', '<b><i class="fas fa-exclamation-triangle"></i> Berhasil</b> upload Bukti Pembayaran, mohon tunggu konfirmasi dari kami');
            return redirect()->to(base_url('transaction'));
        } else {
            session()->setFlashdata('error', '<b><i class="fas fa-exclamation-triangle"></i> Gagal</b> melanjutkan transaksi  ');
            return redirect()->to(base_url('agree?inv=' . base64_encode($invoice)));
        }
    }
    public function wishlist()
    {
        if (session()->get('isLoggedIn') != TRUE) {
            return redirect()->to(base_url('login'));
        }
        $data = array_merge($this->data, [
            'title'               => "Wishlist | Alenxi Technology",
            'description'         => "Termurah terlengkap belanja aman di Alenxi",
            'titlesub'            => "Wishlist",
            'keyword'             => "",
            'Wishlist'            => $this->customerModel->getWishlist(customerID: session()->get('CID'))
        ]);
        $this->cart->destroy();
        $lastSales = $this->SalesModel->getSalesOrderByLastOrder(session()->get('CID'));
        if ($lastSales) {
            return redirect()->to(base_url('agree?inv=' . base64_encode($lastSales['order_uuid'])));
        } else {
            return view('account/profile/wishlist', $data);
        }
    }
    public function addToWishlist()
    {
        if (session()->get('isLoggedIn') != TRUE) {
            return redirect()->to(base_url('login'));
        }
        $addToWishlist = $this->customerModel->addToWishlist(customerID: session()->get('CID'), productID: $this->request->getPost('productID'),);
        if ($addToWishlist) {
            session()->setFlashdata('success', '<b><i class="fas fa-exclamation-triangle"></i> Berhasil</b> Memasukan Menu ke wishlist');
            return redirect()->to(base_url('') . $this->request->getPost('slug'));
        } else {
            session()->setFlashdata('error', '<b><i class="fas fa-exclamation-triangle"></i> Gagal</b> Memasukan Menu ke wishlist');
            return redirect()->to(base_url('') . $this->request->getPost('slug'));
        }
    }
    public function deleteWishlist()
    {
        $deleteWishlist = $this->customerModel->deleteWishlist(customerID: session()->get('CID'), productID: $this->request->getPost('productID'),);
        if ($deleteWishlist) {
            session()->setFlashdata('success', '<b><i class="fas fa-exclamation-triangle"></i> Berhasil</b> menghapus Menu dari wishlist');
            return redirect()->to(base_url('wishlist'));
        } else {
            session()->setFlashdata('error', '<b><i class="fas fa-exclamation-triangle"></i> Gagal</b> menghapus Menu dari wishlist');
            return redirect()->to(base_url('wishlist'));
        }
    }
}

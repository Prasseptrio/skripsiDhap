<?php

namespace App\Controllers\Transaction;

use App\Controllers\BaseController;
use App\Models\Account\CustomerModel;
use App\Models\Transaction\SalesModel;

class SalesOrder extends BaseController
{
    function __construct()
    {
        $this->SalesModel = new SalesModel();
        $this->customerModel = new CustomerModel();
    }
    public function transaction()
    {
        $resource = $this->request->uri->getSegment(1);
        if (!$resource) {
            $resource = 0;
        }
        if (session()->get('isLoggedIn') != TRUE) {
            return redirect()->to(base_url('login'));
        }
        $page = $this->request->getGet('page');
        if (!$page) {
            $page = 1;
        }
        $data = array_merge($this->data, [
            'title'             => 'Daftar Transaksi',
            'description'       => '',
            'keyword'           => '',
            'Rescource'         => $resource,
            'Orders'            => $this->SalesModel->getOrderByCustomerId(session()->get('CID'), $page),
            'totalTransaction'  => $this->SalesModel->getOrderByCustomerId(session()->get('CID')),
        ]);
        // dd($data);
        $lastSales = $this->SalesModel->getLastSalesOrderByCustomerID(session()->get('CID'));
        if ($lastSales) {
            return redirect()->to(base_url('agree?inv=' . base64_encode($lastSales['invoice_no'])));
        } else {
            return view('account/profile/transaction', $data);
        }
    }
    public function dataTransaction()
    {
        $page = $this->request->getGet('page');
        $data = ['Orders' => $this->SalesModel->getOrderByCustomerId(session()->get('CID'), $page)];
        return view('account/profile/widget/getMoreTransaction', $data);
    }
    public function detailTransaction()
    {
        $resource = $this->request->uri->getSegment(1);
        if (!$resource) {
            $resource = 0;
        }
        $invoice = $this->request->getGet('inv');
        $salesOrder = $this->SalesModel->getSalesOrdertByInvoice(base64_decode($invoice));
        $data = array_merge($this->data, [
            'title'             => 'Detail Transaksi | Alenxi Technology',
            'description'       => '',
            'keyword'           => '',
            'Order'             => $salesOrder,
            'OrderProduct'      => $this->SalesModel->getSalesOrderProductByOrderID($salesOrder['order_id']),
            'Rescource'         => $resource
        ]);
        return view('account/profile/transactionDetail', $data);
    }
}

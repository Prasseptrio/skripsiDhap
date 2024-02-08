<?php

namespace App\Controllers\Common;

use App\Controllers\BaseController;
use App\Models\Transaction\SalesModel;
use Faker\Core\Number;

class Cart extends BaseController
{
    function __construct()
    {
        $this->SalesModel = new SalesModel();
    }
    public function insertCart()
    {
        if (session()->get('isLoggedIn') != TRUE) {
            return redirect()->to(base_url('login'));
        }
        $this->cart->destroy();
        $this->SalesModel->addCartFormCheckout($this->request->getPost('id'), $this->request->getPost('qty'),  $this->request->getPost('customer'));
        $this->cart->insert([
            'id'            => $this->request->getPost('id'),
            'qty'           => $this->request->getPost('qty'),
            'price'         => $this->request->getPost('price'),
            'name'          => $this->request->getPost('name'),
            'image'         => $this->request->getPost('image'),
            'customer'      => $this->request->getPost('customer'),
            'model'         => $this->request->getPost('model'),
            'weight'        => $this->request->getPost('weight')
        ]);
        echo $this->showCart();
    }

    public function showCart()
    {
        return view('widgets/cart', [
            'Cart'          => $this->cart->contents(),
            'total'         => $this->cart->total(),
        ]);
    }
    public function destroyCart()
    {
        $this->cart->destroy();
        echo $this->showCart();
    }
    public function removeCart()
    {
        $this->cart->remove($this->request->getPost('rowid'));
        echo $this->showCart();
    }
    public function loadCart()
    {
        echo $this->showCart();
    }
    public function updateCart()
    {
        $this->cart->update([
            'rowid'     => $this->request->getPost('rowid'),
            'qty'       => $this->request->getPost('qty'),
        ]);
        echo $this->loadCart();
    }
    public function loadForDetail()
    {
        echo $this->showCartDetail();
    }
    public function showCartDetail()
    {
        return view('widgets/cartDetail', [
            'Cart'          => $this->cart->contents(),
            'total'         => $this->cart->total(),
        ]);
    }
    public function insertFormWishlist()
    {
        if (session()->get('isLoggedIn') != TRUE) {
            return redirect()->to(base_url('login'));
        }

        $this->cart->insert([
            'id'            => $this->request->getPost('id'),
            'qty'           => $this->request->getPost('qty'),
            'price'         => $this->request->getPost('price'),
            'name'          => $this->request->getPost('name'),
            'image'         => $this->request->getPost('image'),
            'customer'      => $this->request->getPost('customer'),
            'model'         => $this->request->getPost('model'),
            'weight'        => $this->request->getPost('weight')
        ]);
        echo $this->showFormWishlist();
    }

    public function showFormWishlist()
    {
        $subtotal = 0;
        foreach ($this->cart->contents() as $items) {
            $subtotal += ($items['price'] * $items['qty']);
        }
        return view('widgets/cartFromWishlist', [
            'cart'          => $this->cart->contents(),
            'total_items'   => $this->cart->totalItems(),
            'subtotal'      => $subtotal,
        ]);
    }
    public function destroyFormWishlist()
    {
        $this->cart->destroy();
        echo $this->showFormWishlist();
    }
    public function removeFormWishlist()
    {
        $this->cart->remove($this->request->getPost('rowid'));
        echo $this->loadFormWishlist();
    }
    public function loadFormWishlist()
    {
        echo $this->showFormWishlist();
    }
    public function updateFormWishlist()
    {
        foreach ($this->cart->contents() as $items) {
            if ($this->request->getPost('id') == $items['id'])
                $this->cart->update([
                    'rowid'     => $items['rowid'],
                    'qty'       => $this->request->getPost('qty'),
                    'price'     => $this->request->getPost('price'),
                ]);
        }

        echo $this->loadFormWishlist();
    }
}

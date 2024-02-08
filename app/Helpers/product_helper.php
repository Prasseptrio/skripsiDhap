<?php

use App\Models\Account\CustomerModel;
use App\Models\Catalog\ProductModel;
use App\Models\Transaction\SalesModel;

function getChildCategory($parent)
{
    $productModel  = new ProductModel();
    return  $productModel->getCategoryByParent($parent);
}
function getCategories($categoryID)
{
    $productModel  = new ProductModel();
    return  $productModel->getCategoryByID($categoryID);
}
function getSalesOrderByOrderID($orderID)
{
    $salesOrderModel  = new SalesModel();
    return  $salesOrderModel->getSalesOrderByOrderID($orderID);
}
function getSalesOrderProductByOrderID($orderID)
{
    $salesOrderModel  = new SalesModel();
    return  $salesOrderModel->getSalesOrderProductByOrderID($orderID);
}
function getProductByInvoice($orderID)
{
    $salesOrderModel  = new SalesModel();
    return  $salesOrderModel->getSalesOrderProductByInvoice($orderID);
}
function getCustomerByCustomerID($customerID)
{
    $customerModel = new CustomerModel();
    return $customerModel->getCustomerByID($customerID);
}
function getReview($orderID, $productID)
{
    $salesOrderModel = new SalesModel();
    return $salesOrderModel->getReview($orderID, $productID);
}
function uuid($data = null)
{
    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);
    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
    // Output the 36 character UUID.
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

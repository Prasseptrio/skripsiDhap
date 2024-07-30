<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(true);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//Cart Routes
$routes->get('cart/insertCart', 'Common\Cart::insertCart');
$routes->post('cart/insertCart', 'Common\Cart::insertCart');
$routes->get('cart/loadCart', 'Common\Cart::loadCart');
$routes->get('cart/showCart', 'Common\Cart::showCart');
$routes->post('cart/removeCart', 'Common\Cart::removeCart');
$routes->post('cart/destroyCart', 'Common\Cart::destroyCart');
$routes->post('cart/updateCart', 'Common\Cart::updateCart');
$routes->get('cart/insertFormWishlist', 'Common\Cart::insertFormWishlist');
$routes->post('cart/insertFormWishlist', 'Common\Cart::insertFormWishlist');
$routes->get('cart/loadFormWishlist', 'Common\Cart::loadFormWishlist');
$routes->get('cart/showFormWishlist', 'Common\Cart::showFormWishlist');
$routes->post('cart/removeFormWishlist', 'Common\Cart::removeFormWishlist');
$routes->post('cart/destroyFormWishlist', 'Common\Cart::destroyFormWishlist');
$routes->post('cart/updateFormWishlist', 'Common\Cart::updateFormWishlist');
$routes->get('cart/loadForDetail', 'Common\Cart::loadForDetail');

//Common Routes
$routes->get('/', 'Home::index');
$routes->get('p/(:any)', 'Home::information');
$routes->get('blog', 'Home::blog');
$routes->get('blog/(:any)', 'Home::blogDetail/$1');
$routes->get('dev', 'Home::tester');
$routes->get('getCity', 'Common\Rajaongkir::getCity');
$routes->get('getSubdistrict', 'Common\Rajaongkir::getSubdistrict');

//Account Routes
$routes->get('login', 'Account\Auth::index');
$routes->post('auth', 'Account\Auth::login');
$routes->get('logout', 'Account\Auth::logout');
$routes->get('forgotPassword', 'Account\Auth::forgotPassword');
$routes->get('otp', 'Account\Auth::inputOTP');
$routes->post('resetPassword', 'Account\Auth::resetPassword');
$routes->post('changePasswordForgot', 'Account\Auth::changePasswordForgot');
$routes->get('loadingPreview', 'Account\Auth::loadingPreview');
$routes->get('register', 'Account\Register::index');
$routes->post('register', 'Account\Register::registration');
$routes->get('registration', 'Account\Register::afterRegist');
$routes->post('resentEmail', 'Account\Register::resentEmail');
$routes->get('verify', 'Account\Register::verify');
$routes->post('checkOtp', 'Account\Auth::checkOtp');
$routes->get('recover', 'Account\Auth::recover');

// Profile Routes
$routes->get('profile', 'Account\Profile::index');
$routes->post('profile/updateProfile', 'Account\Profile::updateProfile');
$routes->post('profile/addCustomerAddress', 'Account\Profile::addCustomerAddress');
$routes->post('profile/changeProfilePicture', 'Account\Profile::changeProfilePicture');
$routes->post('profile/changeCustomerMainAddress', 'Account\Profile::changeCustomerMainAddress');
$routes->post('profile/updateAddress', 'Account\Profile::updateAddress');
$routes->delete('profile/deleteAddress', 'Account\Profile::deleteAddress');
$routes->get('profile/changePassword', 'Account\Profile::changePassword');
$routes->post('profile/checkPassword', 'Account\Profile::checkPassword');
$routes->post('profile/saveChangePassword', 'Account\Profile::savechangePassword');

/* =================== Wishlist ROUTES ================================== */
$routes->post('addToCart', 'Transaction\Wishlist::addToCart');
$routes->get('cart', 'Transaction\Wishlist::index');
$routes->delete('cart/deleteProductCart', 'Transaction\Wishlist::deleteProductCart');
$routes->get('service', 'Common\Rajaongkir::getCost');
$routes->get('checkout', 'Transaction\Wishlist::checkout');
$routes->post('saveSales', 'Transaction\Wishlist::saveSalesOrder');
$routes->get('agree', 'Transaction\Wishlist::agreement');
$routes->post('savePaymentProof', 'Transaction\Wishlist::savePaymentProof');
$routes->get('cancelOrder', 'Transaction\Wishlist::cancelOrder');
$routes->get('wishlist', 'Transaction\Wishlist::wishlist');
$routes->post('wishlist/addToWishlist', 'Transaction\Wishlist::addToWishlist');
$routes->post('wishlist/deleteWishlist', 'Transaction\Wishlist::deleteWishlist');
$routes->post('wishlist/addToCart', 'Transaction\Wishlist::addToCart');

/* =================== Transaction ROUTES ================================== */
$routes->get('transaction', 'Transaction\SalesOrder::transaction');
$routes->get('transaction/detailTransaction', 'Transaction\SalesOrder::detailTransaction');
$routes->get('getDataTransaction', 'Transaction\SalesOrder::dataTransaction');
$routes->get('transaction/review', 'Transaction\SalesOrder::productReview');
$routes->post('transaction/review', 'Transaction\SalesOrder::saveReview');
$routes->post('transaction/received', 'Transaction\SalesOrder::productReceived');

//Product Routes
$routes->get('search', 'Product\Product::search');
$routes->get('c/(:any)', 'Product\Category::index');
$routes->get('/(:any)', 'Product\Product::index');



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Libraries\Rajaongkir;
use App\Models\Catalog\ProductModel;
use App\Models\Common\InformationModel;
use App\Models\Common\BlogModel;
use App\Models\Account\CustomerModel;
use App\Models\Common\BannerModel;
use App\Models\Transaction\SalesModel;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

class BaseController extends Controller
{
	/**
	 * Instance of the main Request object.
	 *
	 * @var IncomingRequest|CLIRequest
	 */
	protected $request;

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['cookie', 'date', 'product', 'config', 'form', 'pagination', 'dateindo', 'text', 'banner'];

	/**
	 * Constructor.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param LoggerInterface   $logger
	 */
	protected $productModel;
	protected $informationModel;
	protected $blogModel;
	protected $customerModel;
	protected $session;
	protected $validation;
	protected $email;
	protected $curl;
	protected $cart;
	protected $rajaongkir;
	protected $SalesModel;
	protected $data;
	protected $BannerModel;
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		$this->session 				= \Config\Services::session();
		$this->validation 			= \Config\Services::validation();
		$this->email 				= \Config\Services::email();
		$this->curl					= \Config\Services::curlrequest();
		$this->cart 				= \Config\Services::cart();

		$this->productModel  		= new ProductModel();
		$this->informationModel  	= new InformationModel();
		$this->blogModel  			= new BlogModel();
		$this->customerModel  		= new CustomerModel();
		$this->rajaongkir 			= new Rajaongkir();
		$this->SalesModel			= new SalesModel();
		$this->BannerModel			= new BannerModel();


		$emailConfig = [
			'SMTPHost' 		=> getenv('SMTPHost.config'),
			'SMTPUser' 		=> getenv('SMTPUser.config'),
			'SMTPPass' 		=> getenv('SMTPPass.config')
		];
		$this->email->initialize($emailConfig);

		$segment 			 = $this->request->uri->getSegment(1);
		if ($segment) {
			$subsegment 	 = $this->request->uri->getSegment(2);
		} else {
			$subsegment 	 = '';
		}
		if (session()->get('isLoggedIn')) {
			$customer 			= $this->customerModel->getCustomerByID(session()->get('CID'));
			if ($customer['address_id'] == 0) {
				$customerAddress = [];
			} else {
				$customerAddress 	= $this->customerModel->getAddress(session()->get('CID'));
			}
		} else {
			$customer = [];
			$customerAddress = [];
		}
		$wishlist = $this->SalesModel->getCart(session()->get('CID'));
		if ($wishlist) {
			$cart = $wishlist;
		} else {
			$cart = null;
		}
		$this->data			 = [
			'segment' 					=> $segment,
			'subsegment' 				=> $subsegment,
			'ParentCategory'			=> $this->productModel->getParentCategoryHeader(),
			'InformationBottom'			=> $this->informationModel->getInformationBottom(),
			'BlogFooter'				=> $this->blogModel->getBlogLimit(4),
			'Cart'						=> $cart,
			'TotalCart'					=> $this->SalesModel->getTotalCart(session()->get('CID')),
			'GrandTotal'				=> $this->SalesModel->getGrandTotalCart(session()->get('CID')),
			'config_google_analytics'	=> getenv('configGoogleAnalytics.config'),
			'validation'				=> $this->validation,
			'customer'					=> $customer,
			'customerAddress'			=> $customerAddress
		];
		date_default_timezone_set('Asia/Jakarta');
	}
}

<?php

namespace App\Controllers\Common;

use App\Controllers\BaseController;
use App\Models\Common\SettingModel;

class Rajaongkir extends BaseController
{
	public function __construct()
	{
		$this->SettingModel = new SettingModel();
	}

	public function getCity()
	{
		if ($this->request->isAJAX()) {
			$provinceID     = $this->request->getVar('provinceID');
			$getCity        = $this->rajaongkir->getCityJSON('', $provinceID);
			return $getCity;
		}
	}
	public function getSubdistrict()
	{
		if ($this->request->isAJAX()) {
			$cityID         = $this->request->getVar('cityID');
			$getSubdistrict = $this->rajaongkir->getSubdistrictJSON('', $cityID);
			return $getSubdistrict;
		}
	}
	public function getCost()
	{
		if ($this->request->isAJAX()) {
			$origin 		= $this->request->getVar('origin');
			$destination 	= $this->request->getVar('destination');
			$weight 		= $this->request->getVar('weight');
			$courier 		= $this->request->getVar('courier');
			$getCost 		= $this->rajaongkir->getCost($origin, $destination, $weight, $courier);
			return $getCost;
		}
	}
}

<?php

namespace App\Libraries;

class Rajaongkir
{
    protected $apikey;
    protected $curl;
    protected $baseurl;

    public function __construct()
    {
        $this->curl       = \Config\Services::curlrequest();
        $this->baseurl    = getenv('rajaongkir.baseurl');
        $this->apikey     = getenv('rajaongkir.apikey');
    }
    public function getProvince($provinceId = false)
    {
        $getProvince        = $this->curl->request('GET', $this->baseurl . 'province?id=' . $provinceId, ['headers' => ['User-Agent' => 'landmaster/1.0', 'Accept' => 'application/json', 'key' => $this->apikey]]);
        $getProvince        = $getProvince->getBody();
        return json_decode($getProvince, true)['rajaongkir']['results'];
    }

    public function getCity($cityId = false, $provinceId = false)
    {
        $getCity        = $this->curl->request('get', $this->baseurl . 'city?id=' . $cityId . '&province=' . $provinceId, ['headers' => ['User-Agent' => 'landmaster/1.0', 'Accept' => 'application/json', 'key' => $this->apikey]]);
        $getCity        = $getCity->getBody();
        return json_decode($getCity, true)['rajaongkir']['results'];
    }
    public function getSubdistrict($subdistrictId = false, $cityId = false)
    {
        $getSubdistrict         = $this->curl->request('get',  $this->baseurl . 'subdistrict?id=' . $subdistrictId . '&city=' . $cityId, ['headers' => ['User-Agent' => 'landmaster/1.0', 'Accept' => 'application/json', 'key' => $this->apikey]]);
        $getSubdistrict         = $getSubdistrict->getBody();
        return json_decode($getSubdistrict, true)['rajaongkir']['results'];
    }
    public function getCityJSON($cityId = false, $provinceId = false)
    {
        $getCity        = $this->curl->request('get',  $this->baseurl . 'city?id=' . $cityId . '&province=' . $provinceId, ['headers' => ['User-Agent' => 'landmaster/1.0', 'Accept' => 'application/json', 'key' => $this->apikey]]);
        $getCity        = $getCity->getBody();
        return $getCity;
    }
    public function getSubdistrictJSON($subdistrictId = false, $cityId = false)
    {
        $getSubdistrict         = $this->curl->request('get', $this->baseurl . "subdistrict?id=$subdistrictId&city=$cityId", ['headers' => ['User-Agent' => 'landmaster/1.0', 'Accept' => 'application/json', 'key' => $this->apikey]]);
        $getSubdistrict         = $getSubdistrict->getBody();
        return $getSubdistrict;
    }
    public function getCost($origin = false, $destination = false, $weight = false, $courier = false)
    {
        $getCost        = $this->curl->request('POST', $this->baseurl . 'cost', ['form_params' => ['origin' => $origin, 'originType' => 'subdistrict', 'destination' => $destination, 'destinationType' => 'subdistrict', 'weight' => $weight, 'courier' => $courier, 'key' => $this->apikey]]);
        return $getCost;
    }
    public function getWaybill()
    {
        $getWaybill         = $this->curl->request('POST', $this->baseurl . 'waybill', ['form_params' => ['waybill' => 'SOCAG00183235715', 'courier' => 'jne', 'key' => $this->apikey]]);
        return $getWaybill;
    }
}

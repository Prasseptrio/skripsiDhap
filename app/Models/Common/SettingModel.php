<?php

namespace App\Models\Common;

use CodeIgniter\Model;

class SettingModel extends Model
{
	// public function getConfig($key)
	// {
	// 	return $this->db->table('setting')->getWhere(['code' => 'config', 'key' => $key])->getRowArray();
	// }
	// public function getEndPoint($code)
	// {
	// 	return $this->db->table('api_endpoint')->join('api_key', 'api_endpoint.apikey_id = api_key.apikey_id')->getWhere(['code' => $code])->getRowArray();
	// }
}

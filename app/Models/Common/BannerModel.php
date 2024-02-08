<?php

namespace App\Models\Common;

use CodeIgniter\Model;

class BannerModel extends Model
{
	public function getBanner($position)
	{
		return $this->db->table('banner')->getWhere(['position' => $position])->getRowArray();
	}
}

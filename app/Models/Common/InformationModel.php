<?php

namespace App\Models\Common;

use CodeIgniter\Model;

class InformationModel extends Model
{
	public function getInformation($informationSlug)
	{
		if ($informationSlug) {
			return $this->db->table('sky_information')
				->getWhere(['information_slug' => $informationSlug])->getRowArray();
		}
		return $this->db->table('sky_information')
			->select('information_slug,information_name, information_title ')
			->get()->getResultArray();
	}

	public function getInformationBottom()
	{
		return $this->db->table('sky_information')
			->select('information_slug,information_name, information_title ')
			->orderBy('sort_order')
			->getWhere(['bottom' => 1])->getResultArray();
	}
}

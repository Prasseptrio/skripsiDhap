<?php

namespace App\Models\Common;

use CodeIgniter\Model;

class BlogModel extends Model
{
	public function getBlogs($blogSlug = false)
	{
		if ($blogSlug) {
			return $this->db->table('blog_posts')
				->select('post_header_image, post_title,post_date,post_author, post_slug, post_content')
				->getWhere(['post_slug' => $blogSlug])->getRowArray();
		}
		return $this->db->table('blog_posts')
			->select('post_header_image, post_title,post_date,post_author, post_slug, post_content')
			->get()->getResultArray();
	}

	public function getBlogLimit($limit)
	{
		return $this->db->table('blog_posts')
			->select('post_header_image, post_title,post_date,post_author, post_slug, post_content')
			->limit($limit)
			->get()->getResultArray();
	}
}

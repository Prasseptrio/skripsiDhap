<?php

use App\Models\Common\BannerModel;

function banner($position)
{
    $bannerModel  = new BannerModel();
    return  $bannerModel->getBanner($position);
}

<?php

function pagination($page, $totalPage, $keyword, $source)
{
    if ($keyword == 0) $keyword = null; //Kirimkan keyword 0 dari controller
    $linkPerPage = 2;
    if ($page > $linkPerPage) {
        if ($page == 2 || $page == 3) {
            $startNumber =  $page - 2;
        } elseif ($page == $totalPage) {
            $startNumber =  $page - 2;
        } else {
            $startNumber = $page - 1;
        }
    } else {
        $startNumber = 1;
    }
    if ($page <  ($totalPage - $linkPerPage)) {
        if ($page == 1 || $page == 2) {
            $endNumber =  $page + 2;
        } else {
            $endNumber =  $page + 1;
        }
    } else {
        $endNumber = $totalPage;
    }
    $data = [
        'startNumber'   => $startNumber,
        'endNumber'     => $endNumber,
        'page'          => $page,
        'totalPage'     => $totalPage,
        'source'        => $source,
        'keyword'       => $keyword
    ];
    return view('widgets/pagination', $data);
}

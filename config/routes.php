<?php

return array(
        'admin/logout' => 'admin/logout',
        //'admin/logout' => 'index/index',
        'admin/edit/([0-9]+)/([0-9]+)' => 'admin/edit/$1/$2',
        'admin/delete/([0-9]+)' => 'admin/delete/$1',
        'admin/page-([0-9]+)' => 'admin/index/$1',
        'admin' => 'admin/index',
        
        'index/ajax' => 'index/ajax',
        'index/page-([0-9]+)' => 'index/index/$1',
        'page-([0-9]+)' => 'index/index/$1',
        'index' => 'index/index',
        '' => 'index/index',
);

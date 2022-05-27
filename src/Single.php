<?php

namespace Syscape\Single;

use Syscape\Single\Traits\DataTable;
use Syscape\Single\Traits\FormFields;
use Syscape\Single\Traits\HasSingleRoutes;

class Single extends SingleModel
{
    use HasSingleRoutes;
    use FormFields,DataTable;
    protected $guarded = [];
    protected $files = [];
    protected $view = 'single::master';
//    TODO : pagination
}

<?php

namespace Ahmedjoda\Single;

use Ahmedjoda\Single\Traits\DataTable;
use Ahmedjoda\Single\Traits\FormFields;
use Ahmedjoda\Single\Traits\HasSingleRoutes;

class Single extends JodaSingle
{
    use HasSingleRoutes;
    use FormFields,DataTable;
    protected $guarded = [];
    protected $files = [];
    protected $view = 'single::master';
}

<?php

use App\Admin\MenuUtil;
use Dcat\Admin\Admin;
use Dcat\Admin\Grid;
use Dcat\Admin\Form;
use Dcat\Admin\Grid\Filter;
use Dcat\Admin\Layout\Navbar;
use Dcat\Admin\Show;
MenuUtil::init();

Admin::navbar(static function (Navbar $navbar) {
    $navbar->right(view('admin.nav.setting'));
});

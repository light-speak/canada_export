<?php

namespace App\Admin\Controllers;

use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Show;
use Illuminate\Database\Eloquent\Model;
use App\Admin\Field;

abstract class BaseAdminController extends AdminController
{
    // 属于什么菜单下
    public string $parent = '0';

    public $translation;

    /**
     * @param Grid $grid
     * @param $name
     * @return void
     */
    public function modalForm(Grid &$grid, $name): void
    {
        $grid->showColumnSelector();

        Form::dialog("新增")
            ->click('.create-form')
            ->url("$name/create")
            ->width('90%')
            ->height('90%')
            ->success('Dcat.reload()');

        Form::dialog('编辑')
            ->click('.edit-form')
            ->url('')
            ->width('90%')
            ->height('90%')
            ->success('Dcat.reload()');

        $grid->actions(function (Grid\Displayers\Actions $action) use ($name) {
            $action->append("<span class='edit-form' data-url='$name/{$action->getKey()}/edit'>窗口编辑</span>");
        });

        $grid->tools('<a href="#" class="btn btn-primary btn-outline create-form"><i class="feather icon-plus"></i><span class="d-none d-sm-inline">窗口创建</span></a>');

    }
}

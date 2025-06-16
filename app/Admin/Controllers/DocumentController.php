<?php

namespace App\Admin\Controllers;

use App\Admin\MenuUtil;
use App\Models\Document;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Storage;

class DocumentController extends BaseAdminController
{
    public string $parent = MenuUtil::documents;
    public $title = 'Documents';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Document(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name', 'Name');
            $grid->column('type', 'Type');
            $grid->column('created_at', 'Created At');
            $grid->column('updated_at', 'Updated At')->sortable();

            // $grid->column('download', 'Download')->display(function () {
            //     /** @var Document $this */
            //     return '<a href="' . Storage::url($this->file_path) . '" target="_blank" class="btn btn-sm btn-primary">Download</a>';
            // });

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('type', 'Type');
            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Document(), function (Show $show) {
            $show->field('id');
            $show->field('name', 'Name');
            $show->field('type', 'Type');
            $show->field('size', 'Size')->as(function ($size) {
                return number_format($size / 1024, 2) . ' KB';
            });
            $show->field('created_at', 'Created At');
            $show->field('updated_at', 'Updated At');

            // $show->field('file_path', 'File')->as(function ($path) {
            //     return '<a href="' . Storage::url($path) . '" target="_blank" class="btn btn-primary">Download File</a>';
            // })->unescape();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Document(), function (Form $form) {
            $form->display('id');
            $form->text('name', 'Name');
            $form->select('type', 'Type')->options(Document::ENABLE_TYPES);
            $form->file('file_path', '上传文件')
                ->autoUpload()
                ->uniqueName()
                ->disk('');
        });
    }
}

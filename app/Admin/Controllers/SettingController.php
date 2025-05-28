<?php

namespace App\Admin\Controllers;

use App\Admin\Forms\PhotographerAgreementForm;
use App\Admin\Forms\PhotographingAgreementForm;
use App\Admin\Forms\PrivacyPolicyForm;
use App\Admin\Forms\RecordingAgreementForm;
use App\Admin\Forms\UserAgreementForm;
use App\Http\Controllers\Controller;
use Dcat\Admin\Admin;
use Dcat\Admin\Layout\Column;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Widgets\Card;
use Dcat\Admin\Widgets\Modal;

class SettingController extends Controller
{
  public function index(Content $content): Content
  {
    
    if (Admin::user()->isAdministrator()) {
      return $content->title('')
        ->body(function (Row $row)  {
          $row->column(4, function (Column $column)  {
          });
        });
    }
    return $content->title('权限不足');
  }
}

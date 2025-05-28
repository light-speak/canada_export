<?php

namespace App\Admin;

use App\Admin\Controllers\BaseAdminController;
use Dcat\Admin\Admin;
use Dcat\Admin\Layout\Menu;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RegexIterator;
use SplFileInfo;
use Illuminate\Support\Str;

class MenuUtil
{

    public const documents = 'documents';


    /**
     * @return void
     */
    public static function init(): void
    {
        $menuItems = [

            [
                'id'        => self::documents,
                'title'     => 'Documents',
                'icon'      => 'fa-file',
                'uri'       => '',
                'parent_id' => '0',
            ],
            ...self::getAllController()
        ];


        Admin::menu(static function (Menu $menu) use ($menuItems) {
            $menu->add($menuItems);
        });
    }

    public static function getAllController(): array
    {
        $path     = __DIR__ . '/Controllers';
        $allFiles = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
        $phpFiles = new RegexIterator($allFiles, '/\.php$/');

        $menuControllers = [];
        /** @var SplFileInfo $file */
        foreach ($phpFiles as $file) {
            $name      = $file->getBasename('.php');
            $className = __NAMESPACE__ . '\\Controllers\\' . $name;

            if ($name !== 'BaseAdminController' && (new $className) instanceof BaseAdminController) {
                $instance          = (new $className);
                $menuControllers[] = [
                    'name'   => $name,
                    'parent' => $instance->parent,
                    'title'  => $instance->title,
                ];
            }
        }
        $menus = [];
        foreach ($menuControllers as $controller) {
            $name      = lcfirst($controller['name']);
            $routeName = str_replace('Controller', '', $name);
            $title     = $controller['title'];
            $parent    = $controller['parent'];


            $menus[] = [
                'id'        => Str::uuid(),
                'title'     => $title,
                'icon'      => 'fa-circle-o',
                'uri'       => $routeName,
                'parent_id' => $parent,
            ];
        }
        return $menus;
    }


    public static function humpToLine($str): array|string|null
    {
        return preg_replace_callback('/([A-Z])/', static function ($matches) {
            return '-' . strtolower($matches[0]);
        }, $str);
    }
}

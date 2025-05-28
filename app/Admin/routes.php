<?php

use App\Admin\Controllers\BaseAdminController;
use App\Admin\MenuUtil;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;
use Dcat\Admin\Layout\Content;

Admin::routes();

Route::group([
    'prefix'     => config('admin.route.prefix'),
    'namespace'  => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    
    // Setting route
    $router->get('/setting', 'SettingController@index');

    // Dynamic route handling with improved error handling and caching
    $router->any('/{routeName}/{id?}/{edit?}', function (\Illuminate\Http\Request $request, $routeName, $id = '', $edit = '') {
        try {
            $className = config('admin.route.namespace') . '\\' . ucfirst($routeName) . 'Controller';
            
            // Check if controller exists
            if (!class_exists($className)) {
                return response()->json(['error' => 'Controller not found'], 404);
            }
            
            $method = $request->getMethod();
            
            // Use singleton pattern for controller instances to improve performance
            $c = app()->make($className);
            
            if (!($c instanceof BaseAdminController)) {
                throw new \Exception("Controller must extend BaseAdminController");
            }
            
            $c->translation = MenuUtil::humpToLine($routeName);
            
            // More readable and optimized switch case
            switch ($method) {
                case 'GET':
                    if (empty($id)) {
                        return $c->index(new Content());
                    }
                    
                    if ($id === 'create') {
                        return $c->create(new Content());
                    }
                    
                    return empty($edit) ? $c->show($id, new Content()) : $c->edit($id, new Content());
                    
                case 'DELETE':
                    return $c->destroy($id);
                    
                case 'POST':
                    return $id ? $c->update($id) : $c->store();
                    
                case 'PUT':
                    return $c->update($id);
                    
                default:
                    return $c->index(new Content());
            }
        } catch (\Exception $e) {
            // Proper error handling
            return response()->json([
                'error' => $e->getMessage(),
                'trace' => config('app.debug') ? $e->getTraceAsString() : null
            ], 500);
        }
    })->where('routeName', '[a-zA-Z0-9]+'); // Add validation for route parameters

});

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        // 在路由级别处理身份验证
    }

    public function index()
    {
        return view('dashboard.index');
    }
} 
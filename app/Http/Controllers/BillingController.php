<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillingController extends Controller
{
    /**
     * 显示账单列表页面
     */
    public function index()
    {
        $user = Auth::user();
        // TODO: 获取用户的账单信息
        $bills = [];
        
        return view('dashboard.billing.index', [
            'bills' => $bills
        ]);
    }

    /**
     * 显示创建新账单页面
     */
    public function create()
    {
        return view('dashboard.billing.create');
    }

    /**
     * 保存新账单
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string|max:255',
            'due_date' => 'required|date',
        ]);

        // TODO: 创建账单逻辑

        return redirect()->route('billing.index')
            ->with('success', 'Bill created successfully.');
    }

    /**
     * 显示账单详情
     */
    public function show($id)
    {
        // TODO: 获取账单详情
        $bill = null;

        return view('dashboard.billing.show', [
            'bill' => $bill
        ]);
    }
} 
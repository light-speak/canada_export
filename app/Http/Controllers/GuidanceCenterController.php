<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuidanceCenterController extends Controller
{
    public function index()
    {
        return redirect()->route('guidance-center.export-documentation');
    }

    public function exportDocumentation()
    {
        return view('guidance-center.export-documentation');
    }

    public function legality()
    {
        return view('guidance-center.legality');
    }

    public function tradeCenter()
    {
        return view('guidance-center.trade-center');
    }

    public function search(Request $request)
    {
        $query = $request->input('certificate_number');
        
        // 这里是示例数据，实际应用中应当从数据库查询
        $results = [];
        
        if ($query) {
            // 模拟搜索结果
            if (preg_match('/^\d{4,}$/', $query)) {
                $results = [
                    [
                        'certificate_number' => $query,
                        'type' => 'Export Documentation',
                        'issue_date' => now()->subDays(rand(1, 30))->format('Y-m-d'),
                        'status' => 'Active',
                        'pdf_url' => '/storage/certificates/' . $query . '.pdf'
                    ]
                ];
            }
        }
        
        return view('guidance-center.search', [
            'query' => $query,
            'results' => $results
        ]);
    }
} 
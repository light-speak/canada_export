<?php

namespace App\Http\Controllers;

use App\Models\Document;
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
            $results = Document::query()
                ->where('name', 'like', '%' . $query . '%')->get();
        }

        return view('guidance-center.search', [
            'query' => $query,
            'results' => $results
        ]);
    }
}

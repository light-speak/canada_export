<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

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

    public function download($id)
    {
        $document = Document::findOrFail($id);
        
        if (!$document->file_path || !Storage::exists($document->file_path)) {
            abort(404, 'File not found');
        }

        $fileName = $document->name . '.' . pathinfo($document->file_path, PATHINFO_EXTENSION);
        
        return Storage::download($document->file_path, $fileName);
    }

    public function preview($id)
    {
        $document = Document::findOrFail($id);
        
        if (!$document->file_path || !Storage::exists($document->file_path)) {
            abort(404, 'File not found');
        }

        $file = Storage::get($document->file_path);
        $mimeType = Storage::mimeType($document->file_path);
        
        return response($file, 200)
            ->header('Content-Type', $mimeType)
            ->header('Content-Disposition', 'inline; filename="' . $document->name . '"');
    }
}

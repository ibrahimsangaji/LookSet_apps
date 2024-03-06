<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;


class DocumentController extends Controller
{
    public function showDocuments()
    {
        auth()->user()->unreadNotifications->where('id', request('id'))->first()?->update(['title' => 'font-weight-normal']);

        // Ambil data dokumen dari database
        $documents = Document::all();

        return view('layouts.documents', compact('documents'));
    }

    public function detailDocuments(Document $document)
    {
        return view('layouts.detailDocuments', ['document' => $document]);
    }

    public function downloadPDF($id)
    {
        // $document = Document::where('id', request('id'))->first();
        $document = Document::find($id);

        $data = [
            'date' => date('m/d/Y'),
            'conditions_id' =>  $document->conditions_id,
            'condition' =>  $document->condition->type,
            'asset_number' => $document->asset_number,
            'name' => $document->name,
            'device' => $document->device->name,
            'explanation' => $document->explanation,
            'division' => ($document->conditions_id == 6) ? $document->division->name : null,
            'pic' => $document->pic,
            'createdBy' => $document->createdUser->name,
            'approvalBy' => $document->approvalUser->name,
        ];

        $pdf = PDF::loadView('layouts.myPDF', $data);

        return $pdf->download('download.pdf');
        // return $pdf->stream('view.pdf');
    }

    public function printPDF()
    {
        $document = Document::where('id', request('id'))->first();
        return view('layouts.pdfView', ['document' => $document]);
    }
}

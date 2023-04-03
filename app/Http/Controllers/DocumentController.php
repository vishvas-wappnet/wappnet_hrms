<?php

namespace App\Http\Controllers;

use Response;
use App\Models\Document;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DocumentController extends Controller
{
    /**
     * Display a listing of the Documents.
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): JsonResponse|View
    {

        if ($request->ajax()) {
            $documents = Document::select('id', 'name', 'path', 'type', 'created_at')->get();
            return Datatables::of($documents)->addIndexColumn()

            ->addColumn('created_at', function ($documents) {
                return date('d-m-yy', strtotime($documents->created_at));
            })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . url('storage/' . $row->path) . '" target="_blank" class="btn btn-primary btn-sm">View</a>';
                    $btn .= '&nbsp;';
                     $btn .= '<a href="' . route('documents.download', $row->id) . '" class="btn btn-primary btn-sm">Download</a>';
                    return $btn;
                })
                ->addIndexColumn()
                ->escapeColumns([])
                ->make(true);
        }

        return view('documents.index_document');
    }

    /**
     * Show the form for creating a new Document.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('documents.upload_document');
    }
    /**
     * Store a newly created Document in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // method for add new documents
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'type' => 'required',
            'file' => 'required',
        ]);
        $path = $request->file('file')->store('public/');
        $name = pathinfo($path, PATHINFO_FILENAME) . '.' . $request->file('file')->extension();
        $document = new Document;
        $document->name = $validatedData['name'];
        $document->type = $validatedData['type'];
        $document->path = $name;
        $document->save();
        return redirect()->route('documents.index')->with('success', 'Document uploaded successfully.');
    }

     /**
     *  Download  the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     * download method 
     */
    public function download($id) : BinaryFileResponse | RedirectResponse 
    {
        $document = Document::findOrFail($id);
        if ($document) {
            $pathToFile = public_path('storage/' . $document->path);
            
            return response()->download($pathToFile);
            
        } else {
            return redirect()->back()->with('error', 'File not found!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $document = Document::findOrFail($id);
        //  dd($document->path);
        return view('documents.show_document', compact('document'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
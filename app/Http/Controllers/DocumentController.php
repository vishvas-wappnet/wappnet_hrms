<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\RedirectResponse;

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
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . url('storage/' . $row->path) . '" target="_blank" class="btn btn-primary btn-sm">View</a>';
                    $btn .= '&nbsp;';
                    // $btn .= '<a href="'.route('documents.destroy', $row->id).'" class="btn btn-danger btn-sm delete-document">Delete</a>';
                    return $btn;
                })
                ->addIndexColumn()
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
        $path = $request->file('file')->store('public');
        $name = pathinfo($path, PATHINFO_FILENAME) . '.' . $request->file('file')->extension();
        $document = new Document;
        $document->name = $validatedData['name'];
        $document->type = $validatedData['type'];
        $document->path = $name;
        $document->save();
        return redirect()->route('documents.index')->with('success', 'Document uploaded successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
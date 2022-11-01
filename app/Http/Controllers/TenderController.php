<?php

namespace App\Http\Controllers;

use App\Http\Requests\TenderRequest;
use App\Models\Tender;
use Illuminate\Http\Request;

class TenderController extends Controller
{
    public function index()
    {
        $tender = Tender::orderBy('updated_at', 'desc')->get();

        if (request()->query('name')) {
            $tender->where('name', request('name'));
        }

        if (request()->query('date')) {
            $tender->where('updated_at', request('updated_at'));
        }

        return $tender;
    }

    public function store(TenderRequest $request)
    {
        $tender = Tender::create($request->validated());
        return $tender;
    }

    public function show($id)
    {
        $tender = Tender::findOrFail($id);
        return $tender;
    }

    public function update(TenderRequest $request, $id)
    {
        $tender = Tender::findOrFail($id);
        $tender->fill($request->except(['code']));
        $tender->save();
        return response()->json($tender);
    }

    public function destroy(TenderRequest $request, $id)
    {
        $tender = Tender::findOrFail($id);
        if ($tender->delete()) return response(null, 204);
    }
}

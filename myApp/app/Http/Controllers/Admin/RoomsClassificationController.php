<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoomsClassification;

class RoomsClassificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $getRoomsClassification = RoomsClassification::all();
        return view('admin.content.rooms_classification.index',compact('getRoomsClassification'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.content.rooms_classification.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data              = $request->validate([
            'title'       => 'required|max:255|unique:rooms_classification',
        ],
            [
                'title.unique'         => 'Tên danh mục đã có',
                'title.required'       => 'Tên danh mục phải có',
            ]);
        $data              = $request->all();
        $roomClass              = new RoomsClassification();
        $roomClass->title       = $data['title'];
        $roomClass->slug        = $data['slug'];
        $roomClass->description = $data['description'];
        $roomClass->save();

        return redirect()->route('admin.rooms_classification.index')
                         ->with('status', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $roomClass = RoomsClassification::find($id);
        return view('admin.content.rooms_classification.edit',compact('roomClass'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data              = $request->validate([
            'title'       => 'required|max:255|unique:rooms_classification',
        ],
            [
                'title.unique'         => 'Tên danh mục đã có',
                'title.required'       => 'Tên danh mục phải có',
            ]);
        $data              = $request->all();
        $roomClass = RoomsClassification::find($id);
        $roomClass->title       = $data['title'];
        $roomClass->slug        = $data['slug'];
        $roomClass->description = $data['description'];
        $roomClass->save();
        return redirect()->back()->with('status', 'Cập nhật thành công');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $roomClass = RoomsClassification::find($id);
        $roomClass->delete();
        return redirect()->back();
    }
}

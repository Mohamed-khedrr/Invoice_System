<?php

namespace App\Http\Controllers;

use App\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::all();
        return view('sections/sections', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validate = $request->validate([
            'section_name' => 'required | unique:sections',
            'description' => 'required'
        ], [
            'section_name.required' => 'يرجي ادخال اسم القسم ',
            'section_name.unique' => 'هذا القسم موجود مسبقا',
            'description.required' => 'يرجي ادخال وصف للقسم '
        ]);


        Section::create([
            'section_name' => $request->section_name,
            'description' => $request->description,
            'created_by' => (Auth::user()->name)
        ]);
        session()->flash('insert', 'تم اضافة القسم نجاح');
        return redirect()->route('sections.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $validate = $request->validate([
            "section_name' => 'required | unique:sections,section_name,$id"
        ], [
            'section_name.required' => 'يرجي ادخال اسم القسم ',
            'section_name.unique' => 'هذا القسم موجود مسبقا',
            'description.required' => 'يرجي ادخال وصف للقسم '
        ]);

        $data = Section::findOrFail($id);

        $data->section_name = $request->section_name;
        $data->description = $request->description;
        $data->save();

        // $data->update([
        //     'section_name' => $request->section_name,
        //     'description' => $request->description
        // ]);

        session()->flash('edit', 'تم تعديل القسم بنجاج');
        return redirect()->route('sections.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $section = Section::findOrFail($request->id);
        $section->delete();
        session()->flash('delete', 'تم حذف القسم بنجاح ');
        return redirect()->route('sections.index');
    }
}

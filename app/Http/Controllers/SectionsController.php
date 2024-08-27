<?php

namespace App\Http\Controllers;

use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = sections::all();
        return view('sections.section' , compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //اتاكد من عملية السيجيل يعني لو حد سجل قبل كدا متسجلهوش تاني
        //validation
        $request->validate([
            'section_name' => 'required|unique:sections|max:255',
            'description' => 'required',


        ],[
            'section_name.required' =>'يرجى اداحل اسم القسم',
               'section_name.unique' =>'اسم القسم مسجل مسبقا',
                'section_name.required' =>'يرجى ادخال بيانات القسم '
        ]);
            sections::create([
                'section_name'=>$request->section_name,
                'description'=>$request-> description,
                'created_by'=>(Auth::user()->name),
            ]);

            session()->flash('Add','تم اضافة القسم بنجاح');

            return redirect('/sections');

        }


    /**
     * Display the specified resource.
     */
    public function show(sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(sections $sections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request ->id;
        $this ->validate($request , [

            'section_name' => 'required|unique:sections,section_name|max:255'.$id,
            'description' => 'required',


        ],[
            'section_name.required' =>'يرجى اداحل اسم القسم',
               'section_name.unique' =>'اسم القسم مسجل مسبقا',
                'section_name.required' =>'يرجى ادخال بيانات القسم '

        ]);

        $sections = sections::find($id);
        $sections ->update([

            'section_name'=> $request ->section_name ,
            'description'=>$request->description,

        ]);

        session()->flash('edit','تم تعديل القسم بنجاح');

        return redirect('/sections');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request ->id;
         sections::find($id)->delete($id);
        session()->flash('delete','تم حذف القسم بنجاح');
        return redirect('/sections');
    }
}

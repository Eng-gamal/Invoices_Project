<?php

namespace App\Http\Controllers;

use App\Models\invoice_attachments;
use App\Models\invoices;
use App\Models\invoices_details;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Http\Request;

class InvoicesDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(invoices_details $invoices_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

            $invoices = invoices::where('id',$id)->first();
            $details  = invoices_Details::where('id_Invoice',$id)->get();
            $attachments  = invoice_attachments::where('invoice_id',$id)->get();

            return view('invoices.invoices_details',compact('invoices','details','attachments'));
        }


        /**
         * Remove the specified resource from storage.
         *
         * @param  \App\invoices_details  $invoices_details
         * @return \Illuminate\Http\Response
         */
        public function destroy(Request $request)
        {
            $invoices = invoice_attachments::findOrFail($request->id_file);
            $invoices->delete();
            Storage::disk('public_uploads')->delete($request->invoice_number.'/'.$request->file_name);
            session()->flash('delete', 'تم حذف المرفق بنجاح');
            return back();
        }

        public function get_file($invoice_number, $file_name)
        {
            $path = Storage::disk('public_uploads')->path($invoice_number.'/'.$file_name);
            return response()->download($path);
        }



        public function open_file($invoice_number, $file_name)
        {
            $path = Storage::disk('public_uploads')->path($invoice_number.'/'.$file_name);
            return response()->file($path);
        }


        }








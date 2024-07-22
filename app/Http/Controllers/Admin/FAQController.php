<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;

class FAQController extends Controller
{
    //
    public function index()
    {
        $faqs = FAQ::get();

        return view('admin.faqs.index', compact('faqs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        $faq = new FAQ();
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();

        return redirect()->route('admin.faqs.index')->with([
            'message' => 'Data FAQ berhasil di tambah!',
            'alert-type' => 'success'
        ]);
    }

    public function create()
    {
        return view('admin.faqs.create');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);
        $faq = FAQ::find($id);
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();
        return redirect()->route('admin.faqs.index')->with([
            'message' => 'Data FAQ berhasil di update!',
            'alert-type' => 'success'
        ]);
    }
    public function edit($id)
    {
        $faq = FAQ::find($id);
        return view('admin.faqs.edit', compact('faq'));
    }

    public function destroy($id)
    {
        $faq = FAQ::find($id);
        $faq->delete(); 
        return redirect()->route('admin.faqs.index')->with([
            'message' => 'Data FAQ berhasil di hapus!',
            'alert-type' => 'success'
        ]);
    }

}

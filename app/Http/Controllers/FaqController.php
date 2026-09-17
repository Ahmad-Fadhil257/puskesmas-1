<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Halaman Publik Tanya Jawab Pasien (FAQ)
     */
    public function index(Request $request)
    {
        $faqs = Faq::active()->ordered()->get();

        return view('faq', compact('faqs'));
    }
}

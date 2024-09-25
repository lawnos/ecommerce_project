<?php

namespace App\Http\Controllers;

use App\Mail\ContactUsMail;
use App\Models\ContactUsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Mail;

class HomeController extends Controller
{
    public function home()
    {
        $data['meta_title']         = 'Trendy Threads';
        $data['meta_desription']    = '';
        $data['meta_keywords']      = '';

        return view('home', $data);
    }

    public function contact()
    {
        $first_number  =  mt_rand(0, 100);
        $second_number =  mt_rand(0, 100);

        $data['first_number']       = $first_number;
        $data['second_number']      = $second_number;

        Session::put('total_sum', $first_number + $second_number);

        $data['meta_title']         = 'Liên Hệ Chúng Tôi';
        $data['meta_desription']    = '';
        $data['meta_keywords']      = '';

        return view('page.contact', $data);
    }

    public function about()
    {
        $data['meta_title']         = 'Về Chúng Tôi';
        $data['meta_desription']    = '';
        $data['meta_keywords']      = '';

        return view('page.about', $data);
    }

    public function faq()
    {
        $data['meta_title']         = 'FAQ';
        $data['meta_desription']    = '';
        $data['meta_keywords']      = '';

        return view('page.faq', $data);
    }

    public function submit_contact(Request $request)
    {
        if (!empty(($request->verification)) && !empty(Session::get('total_sum'))) {

            if (Session::get('total_sum') == trim($request->verification)) {

                $save  = new ContactUsModel;

                if (!empty(Auth::check())) {
                    $save->user_id = Auth::user()->id;
                }

                $save->name     = trim($request->name);
                $save->email    = trim($request->email);
                $save->phone    = trim($request->phone);
                $save->subject  = trim($request->subject);
                $save->message  = trim($request->message);
                $save->save();

                Mail::to($save->email)->send(new ContactUsMail($save));

                return redirect()->back()->with('success', 'Cảm ơn bạn đã liên hệ với chúng tôi');
            } else {
                return redirect()->back()->with('error', 'Vui lòng xác minh lại');
            }
        } else {
            return redirect()->back()->with('error', 'Vui lòng xác minh lại');
        }
    }
}

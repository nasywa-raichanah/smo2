<?php

namespace App\Http\Controllers;

use App\Models\Countries;
use App\Models\Invoices;
use App\Models\Managers;
use App\Models\News;
use App\Models\Payments;
use App\Models\User;
use App\Models\Systems;
use App\Models\Schedules;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index()
    {
        $event_name = Systems::where('title', '=', 'event_name')->value('description');
        $event_short_name = Systems::where('title', '=', 'event_short_name')->value('description');
        $event_big_logo = Systems::where('title', '=', 'event_big_logo')->value('description');
        $event_sm_logo = Systems::where('title', '=', 'event_sm_logo')->value('description');
        $home_desc = Systems::where('title', '=', 'home_desc')->value('description');
        $home_yt_teaser = Systems::where('title', '=', 'home_yt_teaser')->value('description');
        $proposal_link = Systems::where('title', '=', 'proposal_link')->value('description');
        $about_desc = Systems::where('title', '=', 'about_desc')->value('description');
        $date_day = Systems::where('title', '=', 'date_day')->value('description');
        $date_date = Systems::where('title', '=', 'date_date')->value('description');
        $date_year = Systems::where('title', '=', 'date_year')->value('description');
        $contact_name = Systems::where('title', '=', 'contact_name')->value('description');
        $contact_desc = Systems::where('title', '=', 'contact_desc')->value('description');
        $contact_address = Systems::where('title', '=', 'contact_address')->value('description');
        $contact_phone = Systems::where('title', '=', 'contact_phone')->value('description');
        $contact_email = Systems::where('title', '=', 'contact_email')->value('description');
        $contact_fb = Systems::where('title', '=', 'contact_fb')->value('description');
        $contact_ig = Systems::where('title', '=', 'contact_ig')->value('description');
        $contact_tw = Systems::where('title', '=', 'contact_tw')->value('description');
        $contact_wa = Systems::where('title', '=', 'contact_wa')->value('description');
        $contact_yt = Systems::where('title', '=', 'contact_yt')->value('description');
        $news = News::orderBy('updated_at', 'desc')->get();
        $schedules = Schedules::orderBy('start', 'asc')->get();
        $venue_name = Systems::where('title', '=', 'venue_name')->value('description');
        $venue_address = Systems::where('title', '=', 'venue_address')->value('description');
        $venue_embed = Systems::where('title', '=', 'venue_embed')->value('description');
        $venue_img1 = Systems::where('title', '=', 'venue_img1')->value('description');
        $venue_img2 = Systems::where('title', '=', 'venue_img2')->value('description');
        $venue_img3 = Systems::where('title', '=', 'venue_img3')->value('description');
        $venue_img4 = Systems::where('title', '=', 'venue_img4')->value('description');
        $galleries_img1 = Systems::where('title', '=', 'galleries_img1')->value('description');
        $galleries_img2 = Systems::where('title', '=', 'galleries_img2')->value('description');
        $galleries_img3 = Systems::where('title', '=', 'galleries_img3')->value('description');
        $galleries_img4 = Systems::where('title', '=', 'galleries_img4')->value('description');
        $galleries_img5 = Systems::where('title', '=', 'galleries_img5')->value('description');
        $galleries_img6 = Systems::where('title', '=', 'galleries_img6')->value('description');
        $galleries_img7 = Systems::where('title', '=', 'galleries_img7')->value('description');
        $galleries_img8 = Systems::where('title', '=', 'galleries_img8')->value('description');
        $sponsors = Sponsor::all();
        return view('home/index', [
            "event_name" => $event_name,
            "event_short_name" => $event_short_name,
            "event_big_logo" => $event_big_logo,
            "event_sm_logo" => $event_sm_logo,
            "home_desc" => $home_desc,
            "home_yt_teaser" => $home_yt_teaser,
            "proposal_link" => $proposal_link,
            "about_desc" => $about_desc,
            "date_day" => $date_day,
            "date_date" => $date_date,
            "date_year" => $date_year,
            "contact_name" => $contact_name,
            "contact_desc" => $contact_desc,
            "contact_address" => $contact_address,
            "contact_phone" => $contact_phone,
            "contact_email" => $contact_email,
            "contact_fb" => $contact_fb,
            "contact_ig" => $contact_ig,
            "contact_tw" => $contact_tw,
            "contact_wa" => $contact_wa,
            "contact_yt" => $contact_yt,
            "news" => $news,
            "schedules" => $schedules,
            "venue_name" => $venue_name,
            "venue_address" => $venue_address,
            "venue_embed" => $venue_embed,
            "venue_img1" => $venue_img1,
            "venue_img2" => $venue_img2,
            "venue_img3" => $venue_img3,
            "venue_img4" => $venue_img4,
            "galleries_img1" => $galleries_img1,
            "galleries_img2" => $galleries_img2,
            "galleries_img3" => $galleries_img3,
            "galleries_img4" => $galleries_img4,
            "galleries_img5" => $galleries_img5,
            "galleries_img6" => $galleries_img6,
            "galleries_img7" => $galleries_img7,
            "galleries_img8" => $galleries_img8,
            "sponsors" => $sponsors
        ]);
    }

    // public function news()
    // {
    //     $news = News::orderBy('updated_at', 'desc')->get();
    //     $event_short_name = Systems::where('title', '=', 'event_short_name')->value('description');
    //     $event_sm_logo = Systems::where('title', '=', 'event_sm_logo')->value('description');
    //     $event_name = Systems::where('title', '=', 'event_name')->value('description');
    //     $contact_name = Systems::where('title', '=', 'contact_name')->value('description');
    //     $contact_desc = Systems::where('title', '=', 'contact_desc')->value('description');
    //     $contact_address = Systems::where('title', '=', 'contact_address')->value('description');
    //     $contact_phone = Systems::where('title', '=', 'contact_phone')->value('description');
    //     $contact_email = Systems::where('title', '=', 'contact_email')->value('description');
    //     $contact_fb = Systems::where('title', '=', 'contact_fb')->value('description');
    //     $contact_ig = Systems::where('title', '=', 'contact_ig')->value('description');
    //     $contact_tw = Systems::where('title', '=', 'contact_tw')->value('description');
    //     $contact_wa = Systems::where('title', '=', 'contact_wa')->value('description');
    //     $contact_yt = Systems::where('title', '=', 'contact_yt')->value('description');

    //     return view('home/news', [
    //         "news" => $news,
    //         "event_short_name" => $event_short_name,
    //         "event_sm_logo" => $event_sm_logo,
    //         "event_name" => $event_name,
    //         "contact_name" => $contact_name,
    //         "contact_desc" => $contact_desc,
    //         "contact_address" => $contact_address,
    //         "contact_phone" => $contact_phone,
    //         "contact_email" => $contact_email,
    //         "contact_fb" => $contact_fb,
    //         "contact_ig" => $contact_ig,
    //         "contact_tw" => $contact_tw,
    //         "contact_wa" => $contact_wa,
    //         "contact_yt" => $contact_yt,
    //     ]);
    // }

    public function post($slug)
    {
        $post = News::where('slug', '=', $slug)->first();
        $news = News::orderBy('updated_at', 'desc')->get();
        $event_short_name = Systems::where('title', '=', 'event_short_name')->value('description');
        $event_sm_logo = Systems::where('title', '=', 'event_sm_logo')->value('description');
        $event_name = Systems::where('title', '=', 'event_name')->value('description');
        $contact_name = Systems::where('title', '=', 'contact_name')->value('description');
        $contact_desc = Systems::where('title', '=', 'contact_desc')->value('description');
        $contact_address = Systems::where('title', '=', 'contact_address')->value('description');
        $contact_phone = Systems::where('title', '=', 'contact_phone')->value('description');
        $contact_email = Systems::where('title', '=', 'contact_email')->value('description');
        $contact_fb = Systems::where('title', '=', 'contact_fb')->value('description');
        $contact_ig = Systems::where('title', '=', 'contact_ig')->value('description');
        $contact_tw = Systems::where('title', '=', 'contact_tw')->value('description');
        $contact_wa = Systems::where('title', '=', 'contact_wa')->value('description');
        $contact_yt = Systems::where('title', '=', 'contact_yt')->value('description');

        return view('home/news', [
            "post" => $post,
            "news" => $news,
            "event_short_name" => $event_short_name,
            "event_sm_logo" => $event_sm_logo,
            "event_name" => $event_name,
            "contact_name" => $contact_name,
            "contact_desc" => $contact_desc,
            "contact_address" => $contact_address,
            "contact_phone" => $contact_phone,
            "contact_email" => $contact_email,
            "contact_fb" => $contact_fb,
            "contact_ig" => $contact_ig,
            "contact_tw" => $contact_tw,
            "contact_wa" => $contact_wa,
            "contact_yt" => $contact_yt,
        ]);
    }

    public function all_news()
    {
        $news = News::orderBy('updated_at', 'desc')->get();
        $event_short_name = Systems::where('title', '=', 'event_short_name')->value('description');
        $event_sm_logo = Systems::where('title', '=', 'event_sm_logo')->value('description');
        $event_name = Systems::where('title', '=', 'event_name')->value('description');
        $contact_name = Systems::where('title', '=', 'contact_name')->value('description');
        $contact_desc = Systems::where('title', '=', 'contact_desc')->value('description');
        $contact_address = Systems::where('title', '=', 'contact_address')->value('description');
        $contact_phone = Systems::where('title', '=', 'contact_phone')->value('description');
        $contact_email = Systems::where('title', '=', 'contact_email')->value('description');
        $contact_fb = Systems::where('title', '=', 'contact_fb')->value('description');
        $contact_ig = Systems::where('title', '=', 'contact_ig')->value('description');
        $contact_tw = Systems::where('title', '=', 'contact_tw')->value('description');
        $contact_wa = Systems::where('title', '=', 'contact_wa')->value('description');
        $contact_yt = Systems::where('title', '=', 'contact_yt')->value('description');

        return view('home/all_news', [
            "news" => $news,
            "event_short_name" => $event_short_name,
            "event_sm_logo" => $event_sm_logo,
            "event_name" => $event_name,
            "contact_name" => $contact_name,
            "contact_desc" => $contact_desc,
            "contact_address" => $contact_address,
            "contact_phone" => $contact_phone,
            "contact_email" => $contact_email,
            "contact_fb" => $contact_fb,
            "contact_ig" => $contact_ig,
            "contact_tw" => $contact_tw,
            "contact_wa" => $contact_wa,
            "contact_yt" => $contact_yt,
        ]);
    }

    public function login()
    {
        return view('home/login');
    }

    public function admin()
    {
        return view('home/admin');
    }

    public function register()
    {
        $countries = Countries::get();
        return view('home/register', [
            "countries" => $countries
        ]);
    }

    public function login_store(Request $request)
    {
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'Participant'])) {
            $request->session()->regenerate();
            return redirect()->intended(route('my-dashboard'));
        }
        return back()->with('loginError', 'Login failed!');
    }

    public function admin_store(Request $request)
    {
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'Admin'])) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }
        return back()->with('loginError', 'Login failed!');
    }

    public function register_store(Request $request)
    {
        $request->validate([
            'email' => 'required|email:dns|unique:users',
            'username' => 'required|unique:users|min:3|max:40',
            'university' => 'required|unique:users|min:3|max:40',
            'nationality' => 'required',
            'password' => 'required|min:8|max:12',
            're_type_password' => 'required|same:password'
        ]);
        $manager = new Managers([
            'manager_name' => '-',
            'coach_photo' => 'not-available.png',
            // 'coach_num' => '-'
        ]);
        $manager->save();
        $user = new User([
            'role' => 'Participant',
            'username' => $request->username,
            'university' => $request->university,
            'nationality' => $request->nationality,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_active' => 1,
            'status' => 0,
            'logo' => 'not-available.png'
        ]);
        $user->save();
        User::where('id', '=', $user->id)->update(['manager_id' => $manager->id]);
        Managers::where('id', '=', $manager->id)->update(['user_id' => $user->id]);
        $regist_cost = Systems::where('title', '=', 'regist_cost')->value('description');
        $invoice = new Invoices([
            'user_id' => $user->id,
            'invoice_code' => 'SMC' . str_pad($user->id, 4, "0", STR_PAD_LEFT),
            'proof_of_payment' => 'not-available.png',
            'total' => $regist_cost,
            'status' => 0
        ]);
        $invoice->save();
        $payment = new Payments([
            'invoices_id' => $invoice->id,
            'user_id' => $user->id,
            'item' => 0,
            'qty' => 1,
            'cost' => $regist_cost,
            'total_cost' => $regist_cost
        ]);
        $payment->save();
        return redirect()->route('login')->with('success', 'Registration Success. Please Login');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }
}

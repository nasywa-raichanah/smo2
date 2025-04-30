<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Faq;
use App\Models\News;
use App\Models\User;
use App\Models\Classes;
use App\Models\Sponsor;
use App\Models\Systems;
use Carbon\Cli\Invoker;
use App\Models\Athletes;
use App\Models\Invoices;
use App\Models\Managers;
use App\Models\Messages;
use App\Models\Payments;
use App\Models\Countries;
use App\Models\Schedules;
use Illuminate\Support\Str;
use App\Models\AthleteClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Excel;
use App\Exports\AthleteClassExport;

class AdminController extends Controller
{
    protected $event_sm_logo;
    protected $event_date;
    public function __construct()
    {
        // Fetch the Site Settings object
        $this->event_sm_logo = Systems::where('title', '=', 'event_sm_logo')->value('description');
        View::share('event_sm_logo', $this->event_sm_logo);
        // $event_date = Schedules::where('title', '=', 'Championship')->first();
        // View::share('event_date', $event_date->start);
        $countdown = Systems::where('title', '=', 'countdown')->first();
        View::share('event_date', $countdown->description);
    }

    public function index()
    {
        $teams = User::where('role', '=', 'Participant')->get();
        $invalid_teams = User::where('status', '=', '0')
            ->orWhere('status', '=', '1')
            ->orWhere('status', '=', '3')
            ->latest();

        $athletes = Athletes::all();
        $invalid_athletes = Athletes::where('status', '=', '0')
            ->orWhere('status', '=', '1')
            ->orWhere('status', '=', '3')
            ->latest();

        $invoices_all = Invoices::get();

        $managers = Managers::all();

        $classes = Classes::orderBy('updated_at', 'desc')->take(5)->get();
        $athleteClass = AthleteClass::get();

        $invoices = Invoices::orderBy('updated_at', 'desc')->take(5)->get();
        $payments = Payments::all();

        return view('admin/index', [
            "title" => 'dashboard',
            "teams" => $teams,
            "total_invalid_teams" => $invalid_teams->count(),
            "invalid_teams" => $invalid_teams->paginate(5),
            "invoices_all" => $invoices_all,
            "managers" => $managers,
            "athletes" => $athletes,
            "athleteClass" => $athleteClass,
            "invalid_athletes" => $invalid_athletes,
            "classes" => $classes,
            "invoices" => $invoices,
            "payments" => $payments,
        ]);
    }
    public function classes()
    {
        $classes = Classes::orderBy('type', 'asc')->orderBy('sex', 'asc')->get();
        $athleteClass = AthleteClass::get();
        return view('admin/classes', ["title" => 'classes'], compact('classes', 'athleteClass'));
    }
    public function classes_print()
    {
        $classes = Classes::orderBy('type', 'asc')->orderBy('sex', 'asc')->get();
        $athleteClass = AthleteClass::get();
        return view('admin/classes_print', ["title" => 'classes'], compact('classes', 'athleteClass'));
    }
    public function detail_class($id)
    {
        $classes = Classes::get();
        $class = Classes::where('id', $id)->first();
        $athletes = Athletes::latest()->get();
        $athleteClass = AthleteClass::where('classes_id', $id)->orderBy('group', 'asc')->get();
        $group = $athleteClass->max('group');
        $type = $class->type;
        if ($type == 0) {
            $type = "Individual Kata";
        } elseif ($type == 1) {
            $type = "Team Kata";
        } elseif ($type == 2) {
            $type = "Individual Kumite";
        } elseif ($type == 3) {
            $type = "Team Kumite";
        }
        $sex = $class->sex;
        if ($sex == 0) {
            $sex = "Male";
        } elseif ($sex == 1) {
            $sex = "Female";
        }
        // dd($group);
        return view('admin/detail_class', [
            'title' => $class->class_name,
            'classes' => $classes,
            'athletes' => $athletes,
            'athleteClass' => $athleteClass,
            'group' => $group,
            'type' => $type,
            'sex' => $sex,
            'class' => $class
        ]);
    }
    public function detail_class_export(Request $request) 
    {
        return Excel::download(new AthleteClassExport($request->id), 'class.xlsx');
    }
    public function class_print($id)
    {
        $classes = Classes::get();
        $class = Classes::where('id', $id)->first();
        $athletes = Athletes::latest()->get();
        $athleteClass = AthleteClass::where('classes_id', $id)->orderBy('group', 'asc')->get();
        $group = $athleteClass->max('group');
        $type = $class->type;
        if ($type == 0) {
            $type = "Individual Kata";
        } elseif ($type == 1) {
            $type = "Team Kata";
        } elseif ($type == 2) {
            $type = "Individual Kumite";
        } elseif ($type == 3) {
            $type = "Team Kumite";
        }
        $sex = $class->sex;
        if ($sex == 0) {
            $sex = "Male";
        } elseif ($sex == 1) {
            $sex = "Female";
        }
        // dd($group);
        return view('admin/class_print', [
            'title' => $class->class_name,
            'classes' => $classes,
            'athletes' => $athletes,
            'athleteClass' => $athleteClass,
            'group' => $group,
            'type' => $type,
            'sex' => $sex,
            'class' => $class
        ]);
    }
    public function classes_store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required',
            'class_name' => 'required',
            'sex' => 'required',
            'min_weight' => 'required',
            'max_weight' => 'required',
            'min_athlete' => 'required',
            'max_athlete' => 'required',
        ]);
        $validatedData['created_at'] = Carbon::now();
        Classes::insert($validatedData);
        return redirect()->route('classes')->with('success', 'Create class Success!');
    }
    public function class_edit(Request $request, $id)
    {
        $validatedData = $request->validate([
            'type' => 'required',
            'class_name' => 'required',
            'sex' => 'required',
            'min_weight' => 'required',
            'max_weight' => 'required',
            'min_athlete' => 'required',
            'max_athlete' => 'required',
        ]);
        Classes::where('id', '=', $id)->update($validatedData);
        return redirect()->back()->with('success', 'Update Class Success!');
    }
    public function class_delete($id)
    {
        $athleteClass = AthleteClass::where('classes_id', '=', $id)->first();
        if ($athleteClass == true) {
            return redirect()->back()->with('fail', 'Clear this Class from Athletes first!');
        }
        $classname = Classes::where('id', '=', $id)->value('class_name');
        Classes::where('id', '=', $id)->delete();
        return redirect()->route('classes')->with('success', 'Delete ' . $classname . ' Class Success!');
    }
    public function athlete_class_delete($class, $id)
    {
        $athlete = AthleteClass::where('id', '=', $id)->first();
        $payment = Payments::where([
            ['user_id', $athlete->user_id],
            ['item', $athlete->classes->type + 1],
        ])->first();
        if ($payment->qty == 1) {
            $payment->delete();
        } else {
            $payment_update['qty'] = $payment->qty - 1;
            $type = Classes::where('id', '=', $class)->value('type');
            switch ($type) {
                case '0':
                    $type_cost = Systems::where('title', '=', 'ind_kata_cost')->value('description');
                    break;
                case '1':
                    $type_cost = Systems::where('title', '=', 'team_kata_cost')->value('description');
                    break;
                case '2':
                    $type_cost = Systems::where('title', '=', 'ind_kumite_cost')->value('description');
                    break;
                case '3':
                    $type_cost = Systems::where('title', '=', 'team_kumite_cost')->value('description');
                    break;
                default:
                    return redirect()->back()->with('fail', 'Delete Athlete Failed!');
                    break;
            }
            $payment_update['total_cost'] = $payment->total_cost - $type_cost;
            $payment->update($payment_update);
        }
        AthleteClass::where('id', '=', $id)->delete();
        return redirect()->back()->with('success', 'Delete Athlete Success!');
    }
    public function team_class_delete($class, $team, $id)
    {
        $class = Classes::where('id', '=', $class)->first();
        $team = User::where('id', '=', $team)->first();
        $athlete = AthleteClass::where([
            ['user_id', $team->id],
            ['classes_id', $class->id],
            ['group', $id]
        ])->first();
        $payment = Payments::where([
            ['user_id', $team->id],
            ['item', $athlete->classes->type + 1],
        ])->first();
        if ($payment->qty == 1) {
            $payment->delete();
        } else {
            $payment_update['qty'] = $payment->qty - 1;
            switch ($class->type) {
                case '0':
                    $type_cost = Systems::where('title', '=', 'ind_kata_cost')->value('description');
                    break;
                case '1':
                    $type_cost = Systems::where('title', '=', 'team_kata_cost')->value('description');
                    break;
                case '2':
                    $type_cost = Systems::where('title', '=', 'ind_kumite_cost')->value('description');
                    break;
                case '3':
                    $type_cost = Systems::where('title', '=', 'team_kumite_cost')->value('description');
                    break;
                default:
                    return redirect()->back()->with('fail', 'Delete Athlete Failed!');
                    break;
            }
            $payment_update['total_cost'] = $payment->total_cost - $type_cost;
            $payment->update($payment_update);
        }
        AthleteClass::where([
            ['user_id', $team->id],
            ['classes_id', $class->id],
            ['group', $id]
        ])->delete();
        return redirect()->back()->with('success', 'Delete Team Success!');
    }


    public function teams()
    {
        $teams = User::where('role', '=', 'Participant')->latest();
        $total = $teams->count();
        $payments = Payments::get();

        if (request('search')) {
            $teams->where('username', 'like', '%' . request('search') . '%');
        }

        $managers = Managers::all();
        $athletes = Athletes::all();
        return view('admin/teams', [
            "title" => 'teams',
            "teams" => $teams->paginate(10),
            "total" => $total,
            "managers" => $managers,
            "athletes" => $athletes,
            "payments" => $payments,
        ]);
    }
    public function teams_print()
    {
        $teams = User::where('role', '=', 'Participant')->latest()->get();
        $total = $teams->count();
        $payments = Payments::get();

        $managers = Managers::all();
        $athletes = Athletes::all();
        return view('admin/teams_print', [
            "title" => 'teams',
            "teams" => $teams,
            "total" => $total,
            "managers" => $managers,
            "athletes" => $athletes,
            "payments" => $payments,
        ]);
    }
    public function team($id)
    {
        $team = User::where('id', '=', $id)->first();
        $country = Countries::where('code', '=', $team->nationality)->first();
        $manager = Managers::where('id', '=', $team->manager_id)->first();
        $alt_managers = Managers::where('id', '!=', $team->manager_id)
            ->where('user_id', '=', $team->id)->latest()->get();
        $athletes = Athletes::where('user_id', '=', $id)->latest();
        $athleteClass = AthleteClass::where('user_id', $id)->get();
        $total = $athletes->count();
        $invoices = Invoices::where('user_id', '=', $id)->first();

        return view('admin/team', [
            'title' => $team->username,
            'team' => $team,
            'country' => $country,
            'manager' => $manager,
            'alt_managers' => $alt_managers,
            "athleteClass" => $athleteClass,
            "total" => $total,
            "athletes" => $athletes->paginate(50),
            "invoices" => $invoices,
        ]);
    }
    public function team_print($id)
    {
        $team = User::where('id', '=', $id)->first();
        $country = Countries::where('code', '=', $team->nationality)->first();
        $manager = Managers::where('id', '=', $team->manager_id)->first();
        $alt_managers = Managers::where('id', '!=', $team->manager_id)
            ->where('user_id', '=', $team->id)->latest()->get();
        $athletes = Athletes::where('user_id', '=', $id)->latest()->get();
        $athleteClass = AthleteClass::where('user_id', $id)->get();
        $total = $athletes->count();
        $invoices = Invoices::where('user_id', '=', $id)->first();

        return view('admin/team_print', [
            'title' => $team->username,
            'team' => $team,
            'country' => $country,
            'manager' => $manager,
            'alt_managers' => $alt_managers,
            "athleteClass" => $athleteClass,
            "total" => $total,
            "athletes" => $athletes,
            "invoices" => $invoices,
        ]);
    }
    public function card_official($id)
    {
        $manager = Managers::where('id', '=', $id)->first();
        return view('admin/card_official', [
            'title' => $manager->manager_name,
            'manager' => $manager,
        ]);
    }
    public function card_team($id)
    {
        $team = User::where('id', '=', $id)->first();
        $manager = Managers::where('id', '=', $team->manager_id)->first();
        $alt_managers = Managers::where('id', '!=', $team->manager_id)
            ->where('user_id', '=', $team->id)->latest()->get();
        $athletes = Athletes::where('user_id', '=', $id)->latest()->get();
        $athleteClass = AthleteClass::where('user_id', $id)->get();
        return view('admin/card_team', [
            'title' => $team->username,
            'team' => $team,
            'manager' => $manager,
            'alt_managers' => $alt_managers,
            'athletes' => $athletes,
            'athleteClass' => $athleteClass,
        ]);
    }
    public function verificate_team($id)
    {
        $team = User::where('id', '=', $id)->first();
        $country = Countries::where('code', '=', $team->nationality)->first();
        $manager = Managers::where('id', '=', $team->manager_id)->first();
        $alt_managers = Managers::where('id', '!=', $team->manager_id)
            ->where('user_id', '=', $team->id)->latest()->get();
        $athletes = Athletes::where('user_id', '=', $id)->latest()->get();
        $athleteClass = AthleteClass::where('user_id', $id)->get();
        $total = $athletes->count();
        $invoices = Invoices::where('user_id', '=', $id)->first();
        $payments = Payments::where('user_id', '=', $id)->orderBy('item', 'asc')->get();
        $registration_payment = $payments->where('item', '=', '0')->first();
        $contact_name = Systems::where('title', '=', 'contact_name')->value('description');
        $contact_phone = Systems::where('title', '=', 'contact_phone')->value('description');
        $contact_address = Systems::where('title', '=', 'contact_address')->value('description');
        $new_athletes = Athletes::where([
            ['user_id', $team->id],
            ['status', '0']
        ])->get();
        $waiting_athletes = Athletes::where([
            ['user_id', $team->id],
            ['status', '1']
        ])->get();
        $valid_athletes = Athletes::where([
            ['user_id', $team->id],
            ['status', '2']
        ])->get();
        $invalid_athletes = Athletes::where([
            ['user_id', $team->id],
            ['status', '3']
        ])->get();

        return view('admin/verificate_team', [
            'title' => $team->username,
            'team' => $team,
            'country' => $country,
            'manager' => $manager,
            'alt_managers' => $alt_managers,
            "athleteClass" => $athleteClass,
            "total_athletes" => $total,
            "athletes" => $athletes,
            "invoices" => $invoices,
            "payments" => $payments,
            "registration_payment" => $registration_payment,
            "contact_name" => $contact_name,
            "contact_phone" => $contact_phone,
            "contact_address" => $contact_address,
            'new_athletes' => $new_athletes,
            'waiting_athletes' => $waiting_athletes,
            'valid_athletes' => $valid_athletes,
            'invalid_athletes' => $invalid_athletes,
        ]);
    }
    public function teams_validation(Request $request, $id)
    {
        $team = User::where('id', '=', $id)->first();
        $invoice = Invoices::where('user_id', '=', $id)->first();
        $payments_cost = Payments::where('invoices_id', '=', $invoice->id)->get()->sum('total_cost');
        $invoice->update(['total' => $payments_cost]);
        User::where('id', '=', $id)->update(['status' => $request->status, 'is_confirm' => $request->is_confirm]);
        if ($request->redirect == 1){
            return redirect()->route('verificate-team', $team->id)->with('success', 'Update ' . $team->username . ' Status Success!');
        } else {
            return redirect()->route('teams')->with('success', 'Update ' . $team->username . ' Status Success!');
        }
    }
    public function teams_delete($id)
    {
        $user = User::where('id', '=', $id)->first();
        $managers = Managers::where('user_id', '=', $id)->get();
        $athletes = Athletes::where('user_id', '=', $id)->get();

        $logo_old = $user->logo;
        $logo_address = 'images/teams/';
        if ($logo_old != 'not-available.png') {
            File::delete($logo_address . $logo_old);
        }
        $mandate_letter_old = $user->mandate_letter;
        $mandate_letter_address = 'images/teams/documents/';
        if ($mandate_letter_old != 'not-available.png') {
            File::delete($mandate_letter_address . $mandate_letter_old);
        }
        foreach ($managers as $manager) {
            $coach_photo_old = $manager->coach_photo;
            $coach_photo_address = 'images/teams/managers/';
            if ($coach_photo_old != 'not-available.png') {
                File::delete($coach_photo_address . $coach_photo_old);
            }
        }
        foreach ($athletes as $athlete) {
            $photo_old = $athlete->photo;
            $photo_address = 'images/teams/athletes/';
            if ($photo_old != 'not-available.png') {
                File::delete($photo_address . $photo_old);
            }
            $documents = array("nic", "campus_card", "belt_certificate", "college_payment");
            $documents_address = 'images/teams/athletes/documents/';
            $documents_old = array("", "", "", "");
            for ($i = 0; $i < 4; $i++) {
                $documents_old[$i] = $athlete->{$documents[$i]};
                File::delete($documents_address . $documents_old[$i]);
            }
        }
        User::where('id', '=', $id)->delete();
        Managers::where('user_id', '=', $id)->delete();
        Athletes::where('user_id', '=', $id)->delete();
        AthleteClass::where('user_id', '=', $id)->delete();
        Invoices::where('user_id', '=', $id)->delete();
        Payments::where('user_id', '=', $id)->delete();
        return redirect()->route('teams')->with('success', 'Delete Team Success!');
    }

    public function athletes()
    {
        $athletes = Athletes::latest();
        $athleteClass = AthleteClass::get();
        $total = $athletes->count();

        if (request('search')) {
            $athletes->where('athlete_name', 'like', '%' . request('search') . '%');
        }

        return view('admin/athletes', [
            "title" => 'athletes',
            "athleteClass" => $athleteClass,
            "total" => $total,
            "athletes" => $athletes->paginate(10)
        ]);
    }
    public function athletes_print()
    {
        $athletes = Athletes::latest()->get();
        $athleteClass = AthleteClass::get();
        $total = $athletes->count();

        return view('admin/athletes_print', [
            "title" => 'athletes',
            "athleteClass" => $athleteClass,
            "total" => $total,
            "athletes" => $athletes
        ]);
    }
    public function detail_athlete($id)
    {
        $athlete = Athletes::where('id', '=', $id)->first();
        $athleteClass = AthleteClass::where('athletes_id', '=', $id)->get();
        return view('admin/athlete', [
            'title' => $athlete->athlete_name,
            'athlete' => $athlete,
            'athleteClass' => $athleteClass,
        ]);
    }
    public function card_athlete($id)
    {
        $athlete = Athletes::where('id', '=', $id)->first();
        $athleteClass = AthleteClass::where('athletes_id', '=', $id)->get();
        return view('admin/card_athlete', [
            'title' => $athlete->athlete_name,
            'athlete' => $athlete,
            'athleteClass' => $athleteClass,
        ]);
    }
    public function athlete_validation(Request $request, $id)
    {
        $athlete = Athletes::where('id', '=', $id)->first();
        $team = $athlete->user->id;
        Athletes::where('id', '=', $id)->update(['status' => $request->status]);
        if ($request->redirect == 1) {
            return redirect()->route('verificate-team', $team)->with('success', 'Update ' . $athlete->athlete_name . ' Status Success!');
        }else {
            return redirect()->route('athletes')->with('success', 'Update ' . $athlete->athlete_name . ' Status Success!');
        }
    }

    public function payments()
    {
        $invoices = Invoices::latest();
        $invoices_all = Invoices::get();
        $payments = Payments::all();

        if (request('search')) {
            $invoices->where('invoice_code', 'like', '%' . request('search') . '%');
        }

        return view('admin/payments', [
            "title" => 'payments',
            "invoices" => $invoices->paginate(10),
            "invoices_all" => $invoices_all,
            "payments" => $payments,
        ]);
    }
    public function payments_print()
    {
        $invoices = Invoices::latest()->get();
        $payments = Payments::all();

        return view('admin/payments_print', [
            "title" => 'payments',
            "invoices" => $invoices,
            "payments" => $payments,
        ]);
    }
    public function payment($id)
    {
        $team = User::where('id', '=', $id)->first();
        $manager = Managers::where('id', '=', $team->manager_id)->first();
        $invoices = Invoices::where('user_id', '=', $id)->first();
        $payments = Payments::where('user_id', '=', $id)->orderBy('item', 'asc')->get();
        $registration_payment = $payments->where('item', '=', '0')->first();
        $contact_name = Systems::where('title', '=', 'contact_name')->value('description');
        $contact_phone = Systems::where('title', '=', 'contact_phone')->value('description');
        $contact_address = Systems::where('title', '=', 'contact_address')->value('description');
        $bank_name = Systems::where('title', '=', 'bank_name')->value('description');
        $bank_name_of = Systems::where('title', '=', 'bank_name_of')->value('description');
        $bank_logo = Systems::where('title', '=', 'bank_logo')->value('description');
        $bank_number = Systems::where('title', '=', 'bank_number')->value('description');
        $trans_confirm_contact = Systems::where('title', '=', 'trans_confirm_contact')->value('description');

        return view('admin/payment', [
            'title' => '#' . $invoices->invoice_code,
            'team' => $team,
            'manager' => $manager,
            "invoices" => $invoices,
            "payments" => $payments,
            "registration_payment" => $registration_payment,
            "contact_name" => $contact_name,
            "contact_phone" => $contact_phone,
            "contact_address" => $contact_address,
            "bank_name" => $bank_name,
            "bank_name_of" => $bank_name_of,
            "bank_logo" => $bank_logo,
            "trans_confirm_contact" => $trans_confirm_contact,
            "bank_number" => $bank_number,
        ]);
    }
    public function payment_print($id)
    {
        $team = User::where('id', '=', $id)->first();
        $manager = Managers::where('id', '=', $team->manager_id)->first();
        $invoices = Invoices::where('user_id', '=', $id)->first();
        $payments = Payments::where('user_id', '=', $id)->orderBy('item', 'asc')->get();
        $registration_payment = $payments->where('item', '=', '0')->first();
        $contact_name = Systems::where('title', '=', 'contact_name')->value('description');
        $contact_phone = Systems::where('title', '=', 'contact_phone')->value('description');
        $contact_address = Systems::where('title', '=', 'contact_address')->value('description');

        return view('admin/payment_print', [
            'title' => '#' . $invoices->invoice_code,
            'team' => $team,
            'manager' => $manager,
            "invoices" => $invoices,
            "payments" => $payments,
            "registration_payment" => $registration_payment,
            "contact_name" => $contact_name,
            "contact_phone" => $contact_phone,
            "contact_address" => $contact_address,
        ]);
    }
    public function invoice_validation(Request $request, $id)
    {
        Invoices::where('id', '=', $id)->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Update Status Success!');
    }

    //admin
    public function messages()
    {
        $messages = Messages::latest()->get();
        $users = User::where('role', '=', 'Participant')->orderBy('username', 'asc')->get();
        return view('admin/messages', [
            "title" => 'Messages',
            "messages" => $messages,
            "users" => $users,
        ]);
    }
    public function messages_store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'title' => 'required',
            'message' => 'required',
        ]);
        $validatedData['created_at'] = Carbon::now();
        Messages::insert($validatedData);
        return redirect(route('admin.messages'))->with('success', 'A Message has been created');
    }
    public function messages_delete($id)
    {
        Messages::where('id', '=', $id)->delete();
        return redirect()->route('admin.messages')->with('success', 'Delete Message Success!');
    }

    public function news()
    {
        $news = News::orderBy('updated_at', 'desc')->get();
        return view('admin/news', [
            "title" => 'News',
            "news" => $news,
        ]);
    }
    public function news_create()
    {
        return view('admin/create_news', [
            "title" => 'News',
        ]);
    }
    public function news_store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required',
            'content' => 'required',
            'image' => 'mimes:png,jpg,jpeg'
        ]);
        $validatedData['slug'] = Str::random(7);
        $image = $request->file('image');
        $image_name = time() . "_" . $image->getClientOriginalName();
        $image_address = 'images/news';
        $image->move($image_address, time() . "_" . $image->getClientOriginalName());
        $validatedData['excerpt'] = Str::limit(strip_tags($request->content), 70);

        News::insert([
            'title' => $validatedData['title'],
            'author' => $validatedData['author'],
            'content' => $validatedData['content'],
            'slug' => $validatedData['slug'],
            'image' => $image_name,
            'excerpt' => $validatedData['excerpt'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        return redirect(route('admin.news'))->with('success', 'A News has been created');
    }
    public function news_edit($slug)
    {
        $post = News::where('slug', '=', $slug)->first();
        return view('admin/edit_news', compact('post'), [
            "title" => 'News',
        ]);
    }
    public function news_edit_process(Request $request, $slug)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required',
            'content' => 'required'
        ]);
        $validatedData['excerpt'] = Str::limit(strip_tags($request->content), 70);

        $post = News::where('slug', '=', $slug)->first();
        if ($request->file('image') == "") {
            News::where('slug', '=', $slug)->update([
                'title' => $validatedData['title'],
                'author' => $validatedData['author'],
                'content' => $validatedData['content'],
                'excerpt' => $validatedData['excerpt'],
                'updated_at' => Carbon::now(),
            ]);
        } else {
            $image_old = $post->image;
            $image_address = 'images/news/';
            File::delete($image_address . $image_old);
            $image = $request->file('image');
            $image_name = time() . "_" . $image->getClientOriginalName();
            $image->move($image_address, time() . "_" . $image->getClientOriginalName());
            News::where('slug', '=', $slug)->update([
                'title' => $validatedData['title'],
                'author' => $validatedData['author'],
                'content' => $validatedData['content'],
                'image' => $image_name,
                'excerpt' => $validatedData['excerpt'],
                'updated_at' => Carbon::now(),
            ]);
        }
        return redirect()->route('admin.news')->with('success', 'Update News Success!');
    }
    public function news_delete($slug)
    {
        $post = News::where('slug', '=', $slug)->first();
        $image_old = $post->image;
        $image_address = 'images/news/';
        File::delete($image_address . $image_old);
        News::where('slug', '=', $slug)->delete();
        return redirect()->route('admin.news')->with('success', 'Delete News Success!');
    }

    public function schedules()
    {
        $schedules = Schedules::orderBy('start', 'asc')->get();
        return view('admin/schedules', [
            "title" => 'Schedules',
            "schedules" => $schedules,
        ]);
    }
    public function schedules_store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'detail' => 'required',
            'start' => 'required',
            'finish' => 'required',
        ]);
        Schedules::insert($validatedData);
        return redirect(route('admin.schedules'))->with('success', 'A Schedule has been created');
    }
    public function schedules_edit(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'detail' => 'required',
            'start' => 'required',
            'finish' => 'required',
        ]);
        Schedules::where('id', '=', $id)->update($validatedData);
        return redirect()->route('admin.schedules')->with('success', 'Update Schedule Success!');
    }
    public function schedules_delete($id)
    {
        Schedules::where('id', '=', $id)->delete();
        return redirect()->route('admin.schedules')->with('success', 'Delete Schedule Success!');
    }

    public function venue()
    {
        $venue_name = Systems::where('title', '=', 'venue_name')->value('description');
        $venue_embed = Systems::where('title', '=', 'venue_embed')->value('description');
        $venue_address = Systems::where('title', '=', 'venue_address')->value('description');
        $venue_img1 = Systems::where('title', '=', 'venue_img1')->value('description');
        $venue_img2 = Systems::where('title', '=', 'venue_img2')->value('description');
        $venue_img3 = Systems::where('title', '=', 'venue_img3')->value('description');
        $venue_img4 = Systems::where('title', '=', 'venue_img4')->value('description');

        return view('admin/venue', [
            "title" => 'Venue',
            "venue_name" => $venue_name,
            "venue_embed" => $venue_embed,
            "venue_address" => $venue_address,
            "venue_img1" => $venue_img1,
            "venue_img2" => $venue_img2,
            "venue_img3" => $venue_img3,
            "venue_img4" => $venue_img4,
        ]);
    }
    public function venue_edit(Request $request)
    {
        $validatedData = $request->validate([
            'venue_name' => 'required',
            'venue_embed' => 'required',
            'venue_address' => 'required',
        ]);
        for ($i = 1; $i <= 4; $i++) {
            if ($request->file('venue_img' . $i) == true) {
                $request->validate([
                    'venue_img' . $i => 'mimes:jpg',
                ]);
                File::delete(('images/systems/venue_img' . $i . '.jpg'));
                $venue_img = $request->file('venue_img' . $i);
                $venue_img->move('images/systems/', 'venue_img' . $i . '.jpg');
            };
        }
        Systems::where('title', '=', 'venue_name')->update([
            'description' => $validatedData['venue_name']
        ]);
        Systems::where('title', '=', 'venue_embed')->update([
            'description' => $validatedData['venue_embed']
        ]);
        Systems::where('title', '=', 'venue_address')->update([
            'description' => $validatedData['venue_address']
        ]);
        return redirect()->route('admin.venue')->with('success', 'Update Venue Success!');
    }

    public function galleries()
    {
        $galleries_img1 = Systems::where('title', '=', 'galleries_img1')->value('description');
        $galleries_img2 = Systems::where('title', '=', 'galleries_img2')->value('description');
        $galleries_img3 = Systems::where('title', '=', 'galleries_img3')->value('description');
        $galleries_img4 = Systems::where('title', '=', 'galleries_img4')->value('description');
        $galleries_img5 = Systems::where('title', '=', 'galleries_img5')->value('description');
        $galleries_img6 = Systems::where('title', '=', 'galleries_img6')->value('description');
        $galleries_img7 = Systems::where('title', '=', 'galleries_img7')->value('description');
        $galleries_img8 = Systems::where('title', '=', 'galleries_img8')->value('description');

        return view('admin/galleries', [
            "title" => 'Galleries',
            "galleries_img1" => $galleries_img1,
            "galleries_img2" => $galleries_img2,
            "galleries_img3" => $galleries_img3,
            "galleries_img4" => $galleries_img4,
            "galleries_img5" => $galleries_img5,
            "galleries_img6" => $galleries_img6,
            "galleries_img7" => $galleries_img7,
            "galleries_img8" => $galleries_img8,
        ]);
    }
    public function galleries_edit(Request $request)
    {
        for ($i = 1; $i <= 8; $i++) {
            if ($request->file('galleries_img' . $i) == true) {
                $request->validate([
                    'galleries_img' . $i => 'mimes:jpg',
                ]);
                File::delete(('images/systems/galleries_img' . $i . '.jpg'));
                $galleries_img = $request->file('galleries_img' . $i);
                $galleries_img->move('images/systems/', 'galleries_img' . $i . '.jpg');
            };
        }
        return redirect()->route('admin.galleries')->with('success', 'Update Gallery Success!');
    }

    public function sponsors()
    {
        $sponsors = Sponsor::all();
        return view('admin/sponsors', [
            "title" => 'Sponsors',
            "sponsors" => $sponsors,
        ]);
    }
    public function sponsors_store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'web' => 'required',
            'image' => 'mimes:png,jpg,jpeg'
        ]);
        $image = $request->file('image');
        $image_name = time() . "_" . $image->getClientOriginalName();
        $image_address = 'images/sponsors';
        $image->move($image_address, time() . "_" . $image->getClientOriginalName());

        sponsor::insert([
            'name' => $validatedData['name'],
            'web' => $validatedData['web'],
            'image' => $image_name,
        ]);
        return redirect(route('admin.sponsors'))->with('success', $validatedData['name'] . ' has been added');
    }
    public function sponsors_edit(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'web' => 'required',
        ]);

        $sponsor = Sponsor::where('id', '=', $id)->first();
        if ($request->file('image') == "") {
            Sponsor::where('id', '=', $id)->update($validatedData);
        } else {
            $image_old = $sponsor->image;
            $image_address = 'images/sponsors/';
            File::delete($image_address . $image_old);
            $image = $request->file('image');
            $image_name = time() . "_" . $image->getClientOriginalName();
            $image->move($image_address, time() . "_" . $image->getClientOriginalName());
            Sponsor::where('id', '=', $id)->update([
                'name' => $validatedData['name'],
                'web' => $validatedData['web'],
                'image' => $image_name,
            ]);
        }
        return redirect()->route('admin.sponsors')->with('success', 'Update ' . $validatedData['name'] . ' Success!');
    }
    public function sponsors_delete($id)
    {
        $sponsor = Sponsor::where('id', '=', $id)->first();
        $name = $sponsor->name;
        $image_old = $sponsor->image;
        $image_address = 'images/sponsors/';
        File::delete($image_address . $image_old);
        Sponsor::where('id', '=', $id)->delete();
        return redirect()->route('admin.sponsors')->with('success', 'Delete "' . $name . '" Success!');
    }

    public function faqs()
    {
        $faqs = Faq::all();
        return view('admin/faqs', [
            "title" => 'FAQ',
            "faqs" => $faqs,
        ]);
    }
    public function faqs_store(Request $request)
    {
        $validatedData = $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);
        Faq::insert($validatedData);
        return redirect(route('admin.faqs'))->with('success', 'A FAQ has been created');
    }
    public function faqs_edit(Request $request, $id)
    {
        $validatedData = $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);
        Faq::where('id', '=', $id)->update($validatedData);
        return redirect()->route('admin.faqs')->with('success', 'Update FAQ Success!');
    }
    public function faqs_delete($id)
    {
        Faq::where('id', '=', $id)->delete();
        return redirect()->route('admin.faqs')->with('success', 'Delete FAQ Success!');
    }

    public function transactions()
    {
        $regist_cost = Systems::where('title', '=', 'regist_cost')->value('description');
        $ind_kata_cost = Systems::where('title', '=', 'ind_kata_cost')->value('description');
        $ind_kumite_cost = Systems::where('title', '=', 'ind_kumite_cost')->value('description');
        $team_kata_cost = Systems::where('title', '=', 'team_kata_cost')->value('description');
        $team_kumite_cost = Systems::where('title', '=', 'team_kumite_cost')->value('description');
        $bank_logo = Systems::where('title', '=', 'bank_logo')->value('description');
        $bank_name = Systems::where('title', '=', 'bank_name')->value('description');
        $bank_number = Systems::where('title', '=', 'bank_number')->value('description');
        $bank_name_of = Systems::where('title', '=', 'bank_name_of')->value('description');
        $trans_confirm_contact = Systems::where('title', '=', 'trans_confirm_contact')->value('description');

        return view('admin/transactions', [
            "title" => 'Transactions',
            "regist_cost" => $regist_cost,
            "ind_kata_cost" => $ind_kata_cost,
            "ind_kumite_cost" => $ind_kumite_cost,
            "team_kata_cost" => $team_kata_cost,
            "team_kumite_cost" => $team_kumite_cost,
            "bank_logo" => $bank_logo,
            "bank_name" => $bank_name,
            "bank_number" => $bank_number,
            "bank_name_of" => $bank_name_of,
            "trans_confirm_contact" => $trans_confirm_contact,
        ]);
    }
    public function transactions_edit(Request $request)
    {
        $validatedData = $request->validate([
            "regist_cost" => 'required',
            "ind_kata_cost" => 'required',
            "ind_kumite_cost" => 'required',
            "team_kata_cost" => 'required',
            "team_kumite_cost" => 'required',
            "bank_name" => 'required',
            "bank_number" => 'required',
            "bank_name_of" => 'required',
            "trans_confirm_contact" => 'required',
        ]);
        if ($request->file('bank_logo') == true) {
            $request->validate([
                'bank_logo' => 'mimes:png',
            ]);
            File::delete(('images/systems/bank.png'));
            $bank_logo = $request->file('bank_logo');
            $bank_logo->move('images/systems/', 'bank.png');
        };
        Systems::where('title', '=', 'regist_cost')->update(['description' => $validatedData['regist_cost']]);
        Systems::where('title', '=', 'ind_kata_cost')->update(['description' => $validatedData['ind_kata_cost']]);
        Systems::where('title', '=', 'ind_kumite_cost')->update(['description' => $validatedData['ind_kumite_cost']]);
        Systems::where('title', '=', 'team_kata_cost')->update(['description' => $validatedData['team_kata_cost']]);
        Systems::where('title', '=', 'team_kumite_cost')->update(['description' => $validatedData['team_kumite_cost']]);
        Systems::where('title', '=', 'bank_name')->update(['description' => $validatedData['bank_name']]);
        Systems::where('title', '=', 'bank_number')->update(['description' => $validatedData['bank_number']]);
        Systems::where('title', '=', 'bank_name_of')->update(['description' => $validatedData['bank_name_of']]);
        Systems::where('title', '=', 'trans_confirm_contact')->update(['description' => $validatedData['trans_confirm_contact']]);
        return redirect()->route('admin.transactions')->with('success', 'Update Transactions Setting Success!');
    }

    public function systems()
    {
        $event_name = Systems::where('title', '=', 'event_name')->value('description');
        $event_short_name = Systems::where('title', '=', 'event_short_name')->value('description');
        $event_big_logo = Systems::where('title', '=', 'event_big_logo')->value('description');
        $event_sm_logo = Systems::where('title', '=', 'event_sm_logo')->value('description');
        $home_bg = Systems::where('title', '=', 'home_bg')->value('description');
        $home_desc = Systems::where('title', '=', 'home_desc')->value('description');
        $home_yt_teaser = Systems::where('title', '=', 'home_yt_teaser')->value('description');
        $proposal_link = Systems::where('title', '=', 'proposal_link')->value('description');
        $about_desc = Systems::where('title', '=', 'about_desc')->value('description');
        $countdown = Systems::where('title', '=', 'countdown')->value('description');
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

        return view('admin/systems', [
            "title" => 'Systems',
            "event_name" => $event_name,
            "event_short_name" => $event_short_name,
            "event_big_logo" => $event_big_logo,
            "event_sm_logo" => $event_sm_logo,
            "home_bg" => $home_bg,
            "home_desc" => $home_desc,
            "home_yt_teaser" => $home_yt_teaser,
            "proposal_link" => $proposal_link,
            "about_desc" => $about_desc,
            "countdown" => $countdown,
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
        ]);
    }
    public function systems_edit(Request $request)
    {
        $validatedData = $request->validate([
            "event_name" => 'required',
            "event_short_name" => 'required',
            "home_desc" => 'required',
            "home_yt_teaser" => 'required',
            "proposal_link" => 'required',
            "about_desc" => 'required',
            "countdown" => 'required',
            "date_day" => 'required',
            "date_date" => 'required',
            "date_year" => 'required',
            "contact_name" => 'required',
            "contact_desc" => 'required',
            "contact_address" => 'required',
            "contact_phone" => 'required',
            "contact_email" => 'required',
            "contact_fb" => 'required',
            "contact_ig" => 'required',
            "contact_tw" => 'required',
            "contact_wa" => 'required',
            "contact_yt" => 'required',
        ]);
        if ($request->file('event_big_logo') == true) {
            $request->validate([
                'event_big_logo' => 'mimes:png',
            ]);
            File::delete(('images/systems/big-logo.png'));
            $event_big_logo = $request->file('event_big_logo');
            $event_big_logo->move('images/systems/', 'big-logo.png');
        };
        if ($request->file('event_sm_logo') == true) {
            $request->validate([
                'event_sm_logo' => 'mimes:png',
            ]);
            File::delete(('images/systems/sm-logo.png'));
            $event_sm_logo = $request->file('event_sm_logo');
            $event_sm_logo->move('images/systems/', 'sm-logo.png');
        };
        if ($request->file('home_bg') == true) {
            $request->validate([
                'home_bg' => 'mimes:jpg',
            ]);
            File::delete(('style/TheEvent/assets/img/home-bg.jpg'));
            $home_bg = $request->file('home_bg');
            $home_bg->move('style/TheEvent/assets/img/', 'home-bg.jpg');
        };
        Systems::where('title', '=', 'event_name')->update(['description' => $validatedData['event_name']]);
        Systems::where('title', '=', 'event_short_name')->update(['description' => $validatedData['event_short_name']]);
        Systems::where('title', '=', 'home_desc')->update(['description' => $validatedData['home_desc']]);
        Systems::where('title', '=', 'home_yt_teaser')->update(['description' => $validatedData['home_yt_teaser']]);
        Systems::where('title', '=', 'proposal_link')->update(['description' => $validatedData['proposal_link']]);
        Systems::where('title', '=', 'about_desc')->update(['description' => $validatedData['about_desc']]);
        Systems::where('title', '=', 'countdown')->update(['description' => $validatedData['countdown']]);
        Systems::where('title', '=', 'date_day')->update(['description' => $validatedData['date_day']]);
        Systems::where('title', '=', 'date_date')->update(['description' => $validatedData['date_date']]);
        Systems::where('title', '=', 'date_year')->update(['description' => $validatedData['date_year']]);
        Systems::where('title', '=', 'contact_name')->update(['description' => $validatedData['contact_name']]);
        Systems::where('title', '=', 'contact_desc')->update(['description' => $validatedData['contact_desc']]);
        Systems::where('title', '=', 'contact_address')->update(['description' => $validatedData['contact_address']]);
        Systems::where('title', '=', 'contact_phone')->update(['description' => $validatedData['contact_phone']]);
        Systems::where('title', '=', 'contact_email')->update(['description' => $validatedData['contact_email']]);
        Systems::where('title', '=', 'contact_fb')->update(['description' => $validatedData['contact_fb']]);
        Systems::where('title', '=', 'contact_ig')->update(['description' => $validatedData['contact_ig']]);
        Systems::where('title', '=', 'contact_tw')->update(['description' => $validatedData['contact_tw']]);
        Systems::where('title', '=', 'contact_wa')->update(['description' => $validatedData['contact_wa']]);
        Systems::where('title', '=', 'contact_yt')->update(['description' => $validatedData['contact_yt']]);
        return redirect()->route('admin.systems')->with('success', 'Update Systems Success!');
    }
}

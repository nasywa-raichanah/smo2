<?php

namespace App\Http\Controllers;

use App\Models\AthleteClass;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Classes;
use App\Models\Athletes;
use App\Models\Invoices;
use App\Models\Managers;
use App\Models\Messages;
use App\Models\Countries;
use App\Models\Payments;
use App\Models\Schedules;
use App\Models\Systems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class ParticipantController extends Controller
{
    protected $event_sm_logo;
    protected $event_date;
    public function __construct()
    {
        // Fetch the Site Settings object
        $this->event_sm_logo = Systems::where('title', '=', 'event_sm_logo')->value('description');
        View::share('event_sm_logo', $this->event_sm_logo);
        $countdown = Systems::where('title', '=', 'countdown')->first();
        View::share('event_date', $countdown->description);
    }

    public function index()
    {
        $team = auth()->user();
        $classtotal = AthleteClass::where('user_id', $team->id)->distinct('classes_id')->count('classes_id');
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
        $manager = Managers::where('id', '=', $team->manager_id)->first();
        $total_athletes = Athletes::where('user_id', $team->id)->count();
        $messages = Messages::where('user_id', '=', '0')
            ->orWhere('user_id', '=', $team->id)
            ->latest()->get();
        return view('participant/index', [
            'title' => 'My Board',
            'team' => $team,
            'new_athletes' => $new_athletes,
            'waiting_athletes' => $waiting_athletes,
            'valid_athletes' => $valid_athletes,
            'invalid_athletes' => $invalid_athletes,
            'total_athletes' => $total_athletes,
            'classtotal' => $classtotal,
            'manager' => $manager,
            'messages' => $messages
        ]);
    }
    public function team()
    {
        $team = auth()->user();
        $country = Countries::where('code', '=', $team->nationality)->first();
        $manager = Managers::where('id', '=', $team->manager_id)->first();
        $alt_managers = Managers::where('id', '!=', $team->manager_id)
            ->where('user_id', '=', $team->id)->latest()->get();
        return view('participant/team', [
            'title' => 'My Team',
            'team' => $team,
            'country' => $country,
            'manager' => $manager,
            'alt_managers' => $alt_managers,
        ]);
    }
    public function team_print()
    {
        $team = auth()->user();
        $country = Countries::where('code', '=', $team->nationality)->first();
        $manager = Managers::where('id', '=', $team->manager_id)->first();
        $alt_managers = Managers::where('id', '!=', $team->manager_id)
            ->where('user_id', '=', $team->id)->latest()->get();
        $athletes = Athletes::where('user_id', '=', $team->id)->latest()->get();
        $classes = Classes::orderBy('type', 'asc')->orderBy('sex', 'asc')->get();
        $athleteClass = AthleteClass::where('user_id', $team->id)->get();
        $total = $athletes->count();
        $invoices = Invoices::where('user_id', '=', $team->id)->first();

        return view('participant/team_print', [
            'title' => $team->username,
            'team' => $team,
            'country' => $country,
            'manager' => $manager,
            'alt_managers' => $alt_managers,
            "classes" => $classes,
            "athleteClass" => $athleteClass,
            "total" => $total,
            "athletes" => $athletes,
            "invoices" => $invoices,
        ]);
    }
    public function team_store(Request $request)
    {
        $team = auth()->user();
        $managerData = $request->validate([
            'manager_name' => 'required|min:3|max:40',
            'whatsapp_num' => 'required|numeric|max:999999999999999',
            // 'coach_num' => 'required',
        ]);
        $manager = new Managers($managerData);
        $manager->save();
        Managers::where('id', '=', $manager->id)->update(['user_id' => $team->id, 'coach_photo' => 'not-available.png']);

        if ($request->file('coach_photo') == true) {
            $request->validate([
                'coach_photo' => 'mimes:png,jpg|max:1024',
            ]);
            if ($manager->coach_photo != 'not-available.png') {
                File::delete('images/teams/managers/' . $manager->coach_photo);
            }
            $coach_photo = $request->file('coach_photo');
            $coach_photo_name = $manager->id . "_" . $coach_photo->getClientOriginalName();
            $coach_photo->move('images/teams/managers/', $coach_photo_name);
            Managers::where('id', '=', $manager->id)->update(['coach_photo' => $coach_photo_name]);
        };
        return redirect()->route('my-team')->with('success', 'Create Manager Success!');
    }
    public function team_edit(Request $request, $id)
    {
        $managerData = $request->validate([
            'manager_name' => 'required|min:3|max:40',
            'whatsapp_num' => 'required|numeric|max:999999999999999',
            // 'coach_num' => 'required',
        ]);
        Managers::where('id', '=', $id)->update($managerData);
        $manager = Managers::where('id', '=', $id)->first();
        if ($request->file('coach_photo') == true) {
            $request->validate([
                'coach_photo' => 'mimes:png,jpg|max:1024',
            ]);
            if ($manager->coach_photo != 'not-available.png') {
                File::delete('images/teams/managers/' . $manager->coach_photo);
            }
            $coach_photo = $request->file('coach_photo');
            $coach_photo_name = $id . "_" . $coach_photo->getClientOriginalName();
            $coach_photo->move('images/teams/managers/', $coach_photo_name);
            Managers::where('id', '=', $id)->update(['coach_photo' => $coach_photo_name]);
        };
        return redirect()->route('my-team')->with('success', 'Update Manager Success!');
    }
    public function team_delete($id)
    {
        $manager = Managers::where('id', '=', $id)->first();
        $image_old = $manager->coach_photo;
        $image_address = 'images/teams/managers/';
        if ($image_old != 'not-available.png') {
            File::delete($image_address . $image_old);
        }
        Managers::where('id', '=', $id)->delete();
        return redirect()->route('my-team')->with('success', 'Delete Manager Success!');
    }
    public function edit_team()
    {
        $team = auth()->user();
        $country = Countries::where('code', '=', $team->nationality)->first();
        $countries = Countries::get();
        $manager = Managers::where('id', '=', $team->manager_id)->first();
        return view('participant/edit_team', [
            'title' => 'Edit Team',
            'team' => $team,
            'country' => $country,
            'countries' => $countries,
            'manager' => $manager,
        ]);
    }
    public function edit_team_process(Request $request)
    {
        $team = auth()->user();
        $manager = Managers::where('id', '=', $team->manager_id)->first();
        $teamData = $request->validate([
            'username' => 'required|min:3|max:40',
            'university' => 'required|min:3|max:40',
            'address' => 'required',
            'postal_code' => 'required',
            'nationality' => 'required',
        ]);
        $managerData = $request->validate([
            'manager_name' => 'required|min:3|max:40',
            'whatsapp_num' => 'required|numeric|max:999999999999999',
            // 'coach_num' => 'required',
        ]);
        $teamData['status'] = 1;
        User::where('id', '=', $team->id)->update($teamData);
        Managers::where('id', '=', $team->manager_id)->update($managerData);

        if ($request->file('logo') == true) {
            $request->validate([
                'logo' => 'mimes:png,jpg|max:1024',
            ]);
            if ($team->logo != 'not-available.png') {
                File::delete('images/teams/' . $team->logo);
            }
            $logo = $request->file('logo');
            $logo_name = $team->id . "_" . $logo->getClientOriginalName();
            $logo->move('images/teams/', $logo_name);
            User::where('id', '=', $team->id)->update(['logo' => $logo_name]);
        };
        if ($request->file('coach_photo') == true) {
            $request->validate([
                'coach_photo' => 'mimes:png,jpg|max:1024',
            ]);
            if ($manager->coach_photo != 'not-available.png') {
                File::delete('images/teams/managers/' . $manager->coach_photo);
            }
            $coach_photo = $request->file('coach_photo');
            $coach_photo_name = $manager->id . "_" . $coach_photo->getClientOriginalName();
            $coach_photo->move('images/teams/managers/', $coach_photo_name);
            Managers::where('id', '=', $team->manager_id)->update(['coach_photo' => $coach_photo_name]);
        };
        if ($request->file('mandate_letter') == true) {
            $request->validate([
                'mandate_letter' => 'mimes:png,jpg,pdf|max:2048',
            ]);
            File::delete('images/teams/documents/' . $team->mandate_letter);
            $mandate_letter = $request->file('mandate_letter');
            $mandate_letter_name = "mandate_" . $team->id . "_" . $mandate_letter->getClientOriginalName();
            $mandate_letter->move('images/teams/documents/', $mandate_letter_name);
            User::where('id', '=', $team->id)->update(['mandate_letter' => $mandate_letter_name]);
        };

        return redirect()->route('my-team')->with('success', 'Update Team Data Success!');
    }

    public function athletes()
    {
        $team = auth()->user();
        $athletes = Athletes::where('user_id', '=', auth()->user()->id)->latest();
        $athleteClass = AthleteClass::where('user_id', auth()->user()->id)->get();
        $total = $athletes->count();

        if (request('search')) {
            $athletes->where('athlete_name', 'like', '%' . request('search') . '%');
        }

        return view('participant/athletes', [
            "title" => 'My Athletes',
            "team" => $team,
            "athleteClass" => $athleteClass,
            "total" => $total,
            "athletes" => $athletes->paginate(10)
        ]);
    }
    public function athlete($id)
    {
        $team = auth()->user();
        $athlete = Athletes::where('id', '=', $id)->first();
        $athleteClass = AthleteClass::where('user_id', auth()->user()->id)->get();
        if ($athlete->user_id != $team->id) {
            return redirect()->route('my-athletes');
        }
        return view('participant/athlete', [
            'title' => $athlete->athlete_name,
            'team' => $team,
            'athlete' => $athlete,
            'athleteClass' => $athleteClass,
        ]);
    }
    public function athletes_store(Request $request)
    {
        $team = auth()->user();
        $athleteData = $request->validate([
            'athlete_name' => 'required|min:3|max:40',
            'birth_place' => 'required',
            'birth_date' => 'required',
            'sex' => 'required',
            'weight' => 'required|numeric',
            'athlete_email' => 'required|email:dns',
            'athlete_whatsapp' => 'required|numeric|max:999999999999999'
        ]);
        $athleteData['user_id'] = $team->id;
        $athleteData['status'] = 0;
        $athlete = new Athletes($athleteData);
        $athlete->save();

        $photo_name = 'not-available.png';
        if ($request->file('photo') == true) {
            $request->validate([
                'photo' => 'mimes:png,jpg|max:1024',
            ]);
            $photo = $request->file('photo');

            $photo_name = "12" . $team->id . $athlete->id . "_" . strtok($request->athlete_name, " ") . "." . $photo->extension();
            $photo->move('images/teams/athletes/', $photo_name);
        };

        $documents = array("nic", "campus_card", "belt_certificate", "college_payment");
        $documents_name = array("", "", "", "");
        $doc_count = 0;
        for ($i = 0; $i < 4; $i++) {
            if ($request->file($documents[$i]) == true) {
                $request->validate([
                    $documents[$i] => 'mimes:png,jpg|max:2048',
                ]);
                $doc = $request->file($documents[$i]);
                $documents_name[$i] = "12" . $team->id . $athlete->id . "_" . strtok($request->athlete_name, " ") . "_" . $i + 1 . "." . $doc->extension();
                $doc->move('images/teams/athletes/documents/', $documents_name[$i]);
                $doc_count++;
            }
        }
        if ($doc_count == 4) {
            $status = 1;
        } else {
            $status = 0;
        }
        Athletes::where('id', '=', $athlete->id)->update(['user_id' => $team->id]);
        Athletes::where('id', '=', $athlete->id)->update(['photo' => $photo_name, 'status' => $status]);
        for ($i = 0; $i < 4; $i++) {
            Athletes::where('id', '=', $athlete->id)->update([$documents[$i] => $documents_name[$i]]);
        }

        return redirect()->route('my-athletes')->with('success', 'Create Athlete Success!');
    }
    public function athlete_edit(Request $request, $id)
    {
        $team = auth()->user();
        $athlete = Athletes::where('id', '=', $id)->first();
        $athleteData = $request->validate([
            'athlete_name' => 'required|min:3|max:40',
            'birth_place' => 'required',
            'birth_date' => 'required',
            'sex' => 'required',
            'weight' => 'required|numeric',
            'athlete_email' => 'required|email:dns',
            'athlete_whatsapp' => 'required|numeric|max:999999999999999'
        ]);
        if ($request->file('photo') == true) {
            $request->validate([
                'photo' => 'mimes:png,jpg|max:1024',
            ]);
            if ($athlete->photo != 'not-available.png') {
                File::delete('images/teams/athletes/' . $athlete->photo);
            }
            $photo = $request->file('photo');
            $photo_name = "12" . $team->id . $athlete->id . "_" . strtok($request->athlete_name, " ") . "." . $photo->extension();
            $photo->move('images/teams/athletes/', $photo_name);
            Athletes::where('id', '=', $id)->update(['photo' => $photo_name]);
        };
        $documents = array("nic", "campus_card", "belt_certificate", "college_payment");
        $doc_count = 0;
        if ($athlete->photo == true) {
            $doc_count++;
        }
        for ($i = 0; $i < 4; $i++) {
            if ($request->file($documents[$i]) == true) {
                $request->validate([
                    $documents[$i] => 'mimes:png,jpg|max:2048',
                ]);
                File::delete('images/teams/athletes/documents/' . $athlete->{$documents[$i]});
                $doc = $request->file($documents[$i]);
                $documents_name[$i] = "12" . $team->id . $athlete->id . "_" . strtok($request->athlete_name, " ") . "_" . $i + 1 . "." . $doc->extension();
                $doc->move('images/teams/athletes/documents/', $documents_name[$i]);
                Athletes::where('id', '=', $id)->update([$documents[$i] => $documents_name[$i]]);
                $doc_count++;
            };
        }
        for ($i = 0; $i < 4; $i++) {
            if ($athlete->{$documents[$i]} == true) {
                $doc_count++;
            }
        }
        if ($doc_count == 5) {
            $athleteData['status'] = 1;
        } else {
            $athleteData['status'] = 0;
        }
        Athletes::where('id', '=', $id)->update($athleteData);
        return redirect()->route('my-athletes')->with('success', 'Update Athlete Success!');
    }
    public function athlete_delete($id)
    {
        $athleteClass = AthleteClass::where([
            ['user_id', auth()->user()->id],
            ['athletes_id', $id]
        ])->first();
        if ($athleteClass == true) {
            return redirect()->route('my-athletes')->with('fail', 'Delete Athlete from Class First!');
        }
        $athlete = Athletes::where('id', '=', $id)->first();
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
        // $athleteClass = AthleteClass::where([
        //     ['user_id', auth()->user()->id],
        //     ['athletes_id', $id]
        // ])->get();
        // foreach ($athleteClass as $class) {
        //     if ($class->group == 0) {
        //         $class->delete();
        //     } else {
        //         AthleteClass::where([
        //             ['user_id', auth()->user()->id],
        //             ['classes_id', $class->classes_id],
        //             ['group', $class->group]
        //         ])->delete();
        //     }
        // }

        Athletes::where('id', '=', $id)->delete();
        return redirect()->route('my-athletes')->with('success', 'Delete Athlete Success!');
    }

    public function classes()
    {
        $classes = Classes::orderBy('type', 'asc')->orderBy('sex', 'asc')->get();
        $athleteClass = AthleteClass::where('user_id', auth()->user()->id)->get();
        return view('participant/classes', ["title" => 'Classes'], compact('classes', 'athleteClass'));
    }
    public function detail_class($id)
    {
        $team = auth()->user();
        $classes = Classes::get();
        $class = Classes::where('id', $id)->first();
        $athletes = Athletes::where('user_id', '=', auth()->user()->id)->latest()->get();
        $athleteClass = AthleteClass::where([
            ['user_id', auth()->user()->id],
            ['classes_id', $id]
        ])->orderBy('group', 'asc')->get();
        $group = $athleteClass->max('group');
        // dd($group);
        return view('participant/detail_class', [
            'title' => $class->class_name,
            'team' => $team,
            'classes' => $classes,
            'athletes' => $athletes,
            'athleteClass' => $athleteClass,
            'group' => $group,
            'class' => $class
        ]);

        // $team = auth()->user();
        // $class = Classes::where('id', $id)->first();
        // $athletes = Classes::paginate(10);
        // // $athleteClass = $athletes->with(relations: 'classes')->latest();
        // // dd($athleteClass);
        // $total = $athletes->count();

        // return view('participant/detail_class', [
        //     "title" => 'Detail Class',
        //     "class" => $class,
        //     "athletes" => $athletes,
        //     "total" => $total,
        // ]);
    }
    public function athlete_class_store(Request $request, $id)
    {
        $invoice = Invoices::where('user_id', '=', auth()->user()->id)->first();
        $payment = Payments::where([
            ['user_id', auth()->user()->id],
            ['item', $request['type']]
        ])->first();
        switch ($request['type'] - 1) {
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
                return redirect()->back()->with('fail', 'Add Athlete Failed!');
                break;
        }
        $min_athlete = Classes::where('id', $id)->value('min_athlete');
        $max_athlete = Classes::where('id', $id)->value('max_athlete');
        for ($i = 1; $i <= $min_athlete; $i++) {
            $request->validate(['athlete_id' . $i => 'required']);
        }
        if ($payment == true) {
            $payment_update['qty'] = $payment->qty + 1;
            $payment_update['cost'] = $type_cost;
            $payment_update['total_cost'] = $payment->total_cost + $type_cost;
            $payment->update($payment_update);
        } else {
            Payments::insert([
                'invoices_id' => $invoice->id,
                'user_id' => auth()->user()->id,
                'item' => $request['type'],
                'qty' => 1,
                'cost' => $type_cost,
                'total_cost' => $type_cost,
                'created_at' => Carbon::now(),
            ]);
        }
        for ($i = 1; $i <= $max_athlete; $i++) {
            if ($request['athlete_id' . $i]) {
                AthleteClass::insert([
                    'classes_id' => $id,
                    'user_id' => auth()->user()->id,
                    'athletes_id' => $request['athlete_id' . $i],
                    'group' => $request['group'],
                    'created_at' => Carbon::now(),
                ]);
            }
        }
        return redirect()->back()->with('success', 'Add Athlete Success!');
    }
    public function athlete_class_delete($id)
    {
        $athlete = AthleteClass::where('id', '=', $id)->first();
        $payment = Payments::where([
            ['user_id', auth()->user()->id],
            ['item', $athlete->classes->type + 1],
        ])->first();
        if ($payment->qty == 1) {
            $payment->delete();
        } else {
            $payment_update['qty'] = $payment->qty - 1;
            switch ($athlete->classes->type) {
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
    public function team_class_delete($class, $id)
    {
        $athlete = AthleteClass::where([
            ['user_id', auth()->user()->id],
            ['classes_id', $class],
            ['group', $id]
        ])->first();
        $payment = Payments::where([
            ['user_id', auth()->user()->id],
            ['item', $athlete->classes->type + 1],
        ])->first();
        if ($payment->qty == 1) {
            $payment->delete();
        } else {
            $payment_update['qty'] = $payment->qty - 1;
            switch ($athlete->classes->type) {
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
            ['user_id', auth()->user()->id],
            ['classes_id', $class],
            ['group', $id]
        ])->delete();
        return redirect()->back()->with('success', 'Delete Team Success!');
    }


    public function payment()
    {
        $team = auth()->user();
        $manager = Managers::where('id', '=', $team->manager_id)->first();
        $invoices = Invoices::where('user_id', '=', auth()->user()->id)->first();
        $payments = Payments::where('user_id', '=', auth()->user()->id)->orderBy('item', 'asc')->get();
        $registration_payment = $payments->where('item', '=', '0')->first();
        $contact_name = Systems::where('title', '=', 'contact_name')->value('description');
        $contact_phone = Systems::where('title', '=', 'contact_phone')->value('description');
        $contact_address = Systems::where('title', '=', 'contact_address')->value('description');
        $bank_name = Systems::where('title', '=', 'bank_name')->value('description');
        $bank_name_of = Systems::where('title', '=', 'bank_name_of')->value('description');
        $bank_logo = Systems::where('title', '=', 'bank_logo')->value('description');
        $bank_number = Systems::where('title', '=', 'bank_number')->value('description');
        $trans_confirm_contact = Systems::where('title', '=', 'trans_confirm_contact')->value('description');

        if ($team->is_confirm == 0) {
            $route_view = 'participant/confirmation';
            $title = 'Confirmation';
        } else {
            $route_view = 'participant/payment';
            $title = 'Payment';
        }
        return view($route_view, [
            'title' => $title,
            'team' => $team,
            'manager' => $manager,
            'invoices' => $invoices,
            'payments' => $payments,
            'registration_payment' => $registration_payment,
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
    public function is_confirm(Request $request, $id)
    {
        $team = User::where('id', '=', $id)->first();
        $invoice = Invoices::where('user_id', '=', $id)->first();
        $payments_cost = Payments::where('invoices_id', '=', $invoice->id)->get()->sum('total_cost');
        $request->validate([
            'password' => 'required',
        ]);
        if (Auth::attempt(['email' => $team->email, 'password' => $request->password])) {
            User::where('id', '=', $id)->update(['is_confirm' => '1']);
            $invoice->update(['total' => $payments_cost]);
            return redirect()->route('my-payment')->with('success', 'Confirmation Success!');
        }
        return back()->with('fail', 'Confirm failed!');
    }
}

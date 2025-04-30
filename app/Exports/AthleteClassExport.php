<?php

namespace App\Exports;

// use App\AthleteClass;
use App\Models\User;
use App\Models\Classes;
use App\Models\Athletes;
use App\Models\AthleteClass;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AthleteClassExport implements FromView
{
    protected $id;
    function __construct($id) {
        $this->id = $id;
    }
    public function view(): View
    {
        // dd($this->id);
        $classes = Classes::get();
        $class = Classes::where('id', $this->id)->first();
        $athletes = Athletes::latest()->get();
        $athleteClass = AthleteClass::where('classes_id', $this->id)->orderBy('group', 'asc')->get();
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
        return view('admin/detail_class_print', [
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
}
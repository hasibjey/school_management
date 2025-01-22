<?php

namespace App\Repositories;

use App\Models\District;
use App\Models\Division;
use App\Models\Nationality;
use App\Models\State;
use App\Models\Lga;
use App\Models\Upazilas;

class LocationRepo
{
    public function getStates()
    {
        return Division::all();
    }

    public function getAllStates()
    {
        return Division::orderBy('name', 'asc')->get();
    }

    public function getAllNationals()
    {
        return Nationality::orderBy('name', 'asc')->get();
    }

    public function getDivision($division_id)
    {
        return District::where('division_id', $division_id)->orderBy('name', 'asc')->get();
    }

    public function getUpazila($district_id)
    {
        return Upazilas::where('district_id', $district_id)->orderBy('upazila', 'asc')->get();
    }

}

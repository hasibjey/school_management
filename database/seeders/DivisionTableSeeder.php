<?php
namespace Database\Seeders;

use App\Models\Division;
use App\Models\State;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('divisions')->delete();

        $divisions = [
            'Barishal',
            'Chattogram',
            'Dhaka',
            'Khulna',
            'Rajshahi',
            'Rangpur',
            'Sylhet',
            'Mymensingh'
        ];

        foreach ($divisions as $division) {
            Division::create(['name' => $division]);
        }
    }

}

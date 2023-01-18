<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\Analyz;
use App\Models\Doctor;
use App\Models\Gender;
use App\Models\Account;
use App\Models\Section;
use App\Models\Setting;
use App\Models\Supplier;
use App\Models\TestUnit;
use App\Models\adminTupe;
use App\Models\Antibiotic;
use App\Models\TestMethod;
use App\Models\AdminSetting;
use Illuminate\Database\Seeder;
use Database\Factories\adminTupeFactory;
use Database\Factories\AdminSettingFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        $list = ['red', 'green', 'blue', 'yellow'];

        TestMethod::factory(2)->create();
        Gender::factory(2)->create();
        TestUnit::factory(2)->create();
        Admin::factory(1)->has(adminTupe::factory()->count(1))->create();


        Account::factory()->count(5)
            ->haspaymentMethod(5)
            ->hassendMethod(5)
            ->hasCompanies(5)
            ->hasGenders(3)
            ->hasTestUnit(3)
            ->hasTestMethod(3)
            ->hasSection(1, [

                'name' => 'testName',

                'role' => Section::ACCOUNT,

            ])->has(Doctor::factory()->count(2)

                ->hasDoctorImage(['src' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSLrP0J_IBiIgGFucEl8W7RnKKqQrcq9mD-HfbJ85id&s']))

            ->has(Analyz::factory()->count(3))

            ->hasAccountImage([
                'src' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSLrP0J_IBiIgGFucEl8W7RnKKqQrcq9mD-HfbJ85id&s'
            ])->has(Setting::factory(1)->count(1))

            ->create();

        Antibiotic::factory(2)->create();
    }
}

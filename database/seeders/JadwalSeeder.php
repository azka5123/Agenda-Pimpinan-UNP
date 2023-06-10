<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i = 0; $i < 25; $i++) {
            $activity = $faker->randomElement(['meeting', 'dinas', 'ngajar']);
            $desc = $faker->paragraph();
            $start_time = Carbon::parse();
            $end_time = Carbon::parse();
            $random_date = Carbon::now()->startOfMonth()->addDays(rand(0, Carbon::now()->daysInMonth - 1)); //random tanggal di bulan ini

            // Generate random start time between 08:00:00 and 15:00:00
            $min_start_time = $start_time->copy()->setHour(8)->setMinute(0)->setSecond(0);
            $max_start_time = $start_time->copy()->setHour(17)->setMinute(0)->setSecond(0);
            $start_time = $min_start_time->addSeconds(mt_rand(0, $max_start_time->diffInSeconds($min_start_time)));

            $random_datetime = $random_date->copy()->setTime($start_time->hour, $start_time->minute, $start_time->second); //set tanggal dan waktu acak

            // Set end time 2 hours after start time
            $end_time = $random_datetime->copy()->addHours(2);
            DB::table('jadwals')->insert([
                'user_id' => 2,
                'title' => $activity,
                'keterangan' => $desc,
                'start_time' => $random_datetime,
                'finish_time' => $end_time
            ]);
        }
    }
}

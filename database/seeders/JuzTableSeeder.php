<?php

use App\Juz;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JuzTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Juz::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $juzs = [ 
        	1=>  "الم",
			2 => "سيقول",
			3 => "تلك الرسل",
			4 => "لن تنالوا",
			5 => "والمحصنات",
			6 =>  "لايحب الله",
			7 =>  "واذا سمعوا", 
			8 =>  "ولو اننا" ,
			9 => "قال الملأ", 
			10=>  "واعلموا",
			11=>  "يعتذرون" ,
			12=>  "ومامن دابه" ,
			13=>  "وماابرئ" ,
			14=> "ربما", 
			15=>  "سبحن الذي", 
			16=>  "قال الم", 
			17=>  "اقترب الناس", 
			18=>  "قد افلح", 
			19=>  "وقال الذين", 
			20=>  "من خلق", 
			21=>  "اتل مااوحي", 
			22=>  "ومن يقنت", 
			23=>  "ومالي", 
			24=>  "فمن اظلم", 
			25=>  "اليه يرد", 
			26=>  "حم",
			27=>  "قال فماخطبكم",
			28=>  "قد سمع الله", 
			29=>  "تبارك",
			30=>  "عم"
		];
		foreach ($juzs as $number => $name) {
			Juz::create([
				'number' => $number,
				'name' => $name,
			]);
		}
    }
}

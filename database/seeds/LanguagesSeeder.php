<?php

use App\Models\VrLanguageCodes;
use Illuminate\Database\Seeder;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = [
            ["name" => "Lietuvių", "id" => "lt", "language_code" => "lt"],
            ["name" => "English", "id" => "en", "language_code" => "en"],
            ["name" => "Русский", "id" => "ru", "language_code" => "ru"],
            ["name" => "Deutsch", "id" => "de", "language_code" => "de"],
            ["name" => "Français", "id" => "fr", "language_code" => "fr"],
        ];

        DB::beginTransaction ();
        try {
            foreach ($languages as $langData) {
                $lang = VrLanguageCodes::where ('id', $langData['id'])->first ();
                if (!$lang)
                    VrLanguageCodes::create ($langData);
            }
        } catch (\Exception $e) {
            DB::rollback ();
            throw new Exception($e->getMessage ());
        }
        DB::commit ();
    }
}

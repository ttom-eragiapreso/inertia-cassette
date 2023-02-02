<?php

namespace Database\Seeders;

use App\Models\Cassette;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Redis\Limiters\DurationLimiterBuilder;

class CassetteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $library = config('db-enrico');

        foreach($library as $record){
            $new_record = new Cassette();

            $new_record->title = $record['title'];
            $new_record->author = $record['author'];
            $new_record->thumb = $record['thumb'];
            $new_record->release_year = $record['release_year'];

            $new_record->save();
        }
    }
}

<?php

use Illuminate\Database\Seeder;

class ClickSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Click::class, 50)->create();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use App\Models\kamar;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $table->foreignId('kamar_id'); 
        //     $table->integer("state_lampu");
        //     $table->integer("state_listrik");
        //     $table->string("tegangan");
        //     $table->string("arus");
        //     $table->string("daya");
        //     $table->string("kwh");
        User::create([
            'name' => "rumah",
            'email' => "rumah@gmail.com",
            'password' => Hash::make("123"),
        ]);

        kamar::create([
            'kamar_id' => 1,
            'state_lampu' => 1,
            'state_listrik' => 1,
            'tegangan' => "1",
            'arus' => "1",
            'daya' => "1",
            'kwh' => "1",
        ]);
        
        kamar::create([
            'kamar_id' => 1,
            'state_lampu' => 11,
            'state_listrik' => 11,
            'tegangan' => "11",
            'arus' => "11",
            'daya' => "11",
            'kwh' => "11",
        ]);

        kamar::create([
            'kamar_id' => 2,
            'state_lampu' => 2,
            'state_listrik' => 2,
            'tegangan' => "2",
            'arus' => "2",
            'daya' => "2",
            'kwh' => "2",
        ]);
        
        kamar::create([
            'kamar_id' => 2,
            'state_lampu' => 22,
            'state_listrik' => 22,
            'tegangan' => "22",
            'arus' => "22",
            'daya' => "22",
            'kwh' => "22",
        ]);

    }
}

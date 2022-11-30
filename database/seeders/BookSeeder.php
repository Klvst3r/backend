<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//Importacion del Facade DB se importa
use Illuminate\Support\Facades\DB; 

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        
        //Metodo truncate para evitar duplicidad de registros
        DB::table('books')->truncate();

        //Inserción de registros para los libros
        DB::table('books')->insert([
            'title' => 'Libro 1',
        ]);
    }
}

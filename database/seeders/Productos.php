<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Productos as p;

class Productos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        p::create([
            'name'      =>  'Manzana',
            'precio'     =>  100,
            'impuesto'  =>  5,
        ]);

        p::create([
            'name'      =>  'Durazno',
            'precio'     =>  50,
            'impuesto'  =>  15,
        ]);
        
        p::create([
            'name'      =>  'Fresa',
            'precio'     =>  150,
            'impuesto'  =>  12,
        ]);
        
        p::create([
            'name'      =>  'Mango',
            'precio'     =>  30,
            'impuesto'  =>  8,
        ]);
        
        p::create([
            'name'      =>  'Uvas',
            'precio'     =>  44,
            'impuesto'  =>  10,
        ]);        
    }
}

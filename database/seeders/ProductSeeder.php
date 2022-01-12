<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Testing product data seed.
     *
     * @return void
     */
    public function run()
    {
        $name = array(
            "Black Umbrella", "Pink Hat",
            "Synergistic Leather Hat",
            "Heavy Duty Iron Hat",
            "Classic Wool Trilby Hat",
            "Lenloy Cotton Cap",
            "Outdoor jacket with hood",
            "Wide Leg Trousers",
            "Sherpa Lined Shirt Jacket",
            "Western Flannel Shirt",
            "Insulated Puffer Jacket",
            "Stretch Formal Trousers",
            "Stretch Chino Trousers",
            "Flex Flat Front Straight Fit Pant",
            "Lux Cotton Stretch Khaki Pant",
            "Flat Front Pant",
            "Waist Pleat-Front Dress Pant",
            "Trim Fit Cotton Dress Shirt",
            "Classic Fit Non-Iron Dress Shirt",
            "Trim Fit Solid Dress Shirt",
            "Windowpane Print Trim Fit Shirt",
            "Trim Fit Solid Dress Shirt",
            "Slim Fit Check Cotton Dress Shirt",
            "Leather Moto Jacket",
            "Dalby Leather Biker Jacket",
            "Forest Pack Away Hat"
        );

        $data = [count($name)];

        for ($i=0; $i < count($name); $i++) {

            $price = mt_rand (150, 400) / 10;
            $data[$i] = [
                'sku' => 'UM-' . ($i+1),
                'name' => $name[$i],
                'price' => $price,
                'weather_id' => (int)($i/2)+1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }

        DB::table('products')->insert($data);
    }
}

<?php 

namespace Database\Seeders;

use App\Models\Sopir;
use Illuminate\Database\Seeder;

class SopirSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $sopirs = [
            [
                'name' => 'Sopir 1',
                'no_wa' => '081234112345',
            ],
            [
                'name' => 'Sopir 2',
                'no_wa' => '085878976767',
            ],
            [
                'name' => 'Sopir 3',
                'no_wa' => '081324234432',
            ],
            [
                'name' => 'Sopir 4',
                'no_wa' => '085989723484',
            ],
            [
                'name' => 'Sopir 5',
                'no_wa' => '089738247789',
            ],
            [
                'name' => 'Sopir 6',
                'no_wa' => '085983724643',
            ]
        ];

        foreach ($sopirs as $value) {
            $sopir = Sopir::create([
                'name' => $value['name'],
                'no_wa' => $value['no_wa'],
            ]);
            $sopir->save();
        }
    }
}

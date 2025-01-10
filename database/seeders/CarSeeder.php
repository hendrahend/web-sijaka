<?php 

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $cars = [
            [
                'name' => 'Honda Civic',
                'nopol' => 'B 1234 A',
                'image' => 'https://th.bing.com/th/id/OIP.oMdI79ZeZ32nKTf4DjAECQHaHa?w=174&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7'
            ],
            [
                'name' => 'Toyota Avanza',
                'nopol' => 'B 1234 A',
                'image' => 'https://th.bing.com/th/id/OIP.oMdI79ZeZ32nKTf4DjAECQHaHa?w=174&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7'
            ],
            [
                'name' => 'Suzuki Ertiga',
                'nopol' => 'B 1234 A',
                'image' => 'https://th.bing.com/th/id/OIP.oMdI79ZeZ32nKTf4DjAECQHaHa?w=174&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7'
            ],
            [
                'name' => 'Kijang Innova',
                'nopol' => 'B 1234 A',
                'image' => 'https://th.bing.com/th/id/OIP.oMdI79ZeZ32nKTf4DjAECQHaHa?w=174&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7'
            ],
            [
                'name' => 'Agya',
                'nopol' => 'B 1234 A',
                'image' => 'https://th.bing.com/th/id/OIP.oMdI79ZeZ32nKTf4DjAECQHaHa?w=174&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7'
            ],
            [
                'name' => 'Honda Brio',
                'nopol' => 'B 1234 A',
                'image' => 'https://th.bing.com/th/id/OIP.oMdI79ZeZ32nKTf4DjAECQHaHa?w=174&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7'
            ]
        ];

        foreach ($cars as $value) {
            $car = Car::create([
                'name' => $value['name'],
                'nopol' => $value['nopol'],
                'image' => $value['image'],
            ]);
            $car->save();
        }
    }
}

<?php 

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Administrator',
                'email' => 'admin@mail.com',
                'password' => Hash::make('admin@mail.com'),
                'jabatan' => 'Administrator',
                'seksi' => 'PKD',
                'nip' => '7020210010',
                'no_wa' => '085723832342',
                'type' => 0
            ],
            [
                'name' => 'User',
                'email' => 'user@mail.com',
                'password' => Hash::make('user@mail.com'),
                'jabatan' => 'User',
                'seksi' => 'subbag umum',
                'nip' => '7020210000',
                'no_wa' => '085998086723',
                'type' => 1
            ]
        ];

        foreach ($users as $value) {
            $user = User::create([
                'name' => $value['name'],
                'email' => $value['email'],
                'seksi' => $value['seksi'],
                'jabatan' => $value['jabatan'],
                'nip' => $value['nip'],
                'no_wa' => $value['no_wa'],
                'password' => $value['password'],
                'type' => $value['type'],
                'email_verified_at' => now(),
                'remember_token' => \Str::random(10),

            ]);
            $user->save();
        }
    }
}

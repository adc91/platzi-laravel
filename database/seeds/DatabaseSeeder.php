<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(App\User::class, 50)->create();

        $users->each(function(App\User $user) use ($users) {
            factory(App\Message::class)
                ->times(mt_rand(1, 3))
                ->create([
                    'user_id' => $user->id
                ]);

            $user->follows()->sync(
                $users->random(random_int(4, 12))
            );
        });

        /**
        factory(App\User::class)
            ->times(10)
            ->create();

        factory(App\Message::class)
            ->times(mt_rand(10, 90))
            ->create([
                'user_id' => mt_rand(1, 10)
            ]);
        */
    }
}

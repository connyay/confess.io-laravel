<?php

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Eloquent::unguard();

        $this->call('UsersTableSeeder');
        $this->call('PostsTableSeeder');
        $this->call('ConfessionsTableSeeder');
        $this->call('ConfessionCommentsTableSeeder');
        $this->call('VotesTableSeeder');

}

}

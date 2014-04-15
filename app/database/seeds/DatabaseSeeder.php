<?php

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Eloquent::unguard();

        //$this->call('PostsTableSeeder');
        //$this->call('CommentsTableSeeder');
        $this->call('ConfessionsTableSeeder');
        $this->call('ConfessionCommentsTableSeeder');
        $this->call('VotesTableSeeder');

}

}

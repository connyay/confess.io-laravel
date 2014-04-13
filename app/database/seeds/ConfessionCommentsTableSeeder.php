<?php
use \Confess\Models\Confession;
class ConfessionCommentsTableSeeder extends Seeder {

    protected $content1 = 'Lorem ipsum dolor sit amet, mutat utinam nonumy ea mel.';
    protected $content2 = 'Lorem ipsum dolor sit amet, sale ceteros liberavisse duo ex, nam mazim maiestatis dissentiunt no. Iusto nominavi cu sed, has.';
    protected $content3 = 'Et consul eirmod feugait mel! Te vix iuvaret feugiat repudiandae. Solet dolore lobortis mei te, saepe habemus imperdiet ex vim. Consequat signiferumque per no, ne pri erant vocibus invidunt te.';


    public function run()
    {
        DB::table('confession_comments')->delete();

        $confession_id = Confession::first()->id;

        DB::table('confession_comments')->insert( array(
            array(
                'confession_id'    => $confession_id,
                'content'    => $this->content1,
                'approved'	=> 1,
                'pass'		=> 'hacky1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
            array(
                'confession_id'    => $confession_id,
                'content'    => $this->content2,
                'approved'	=> 1,
                'pass'		=> 'hacky1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
            array(
                'confession_id'    => $confession_id,
                'content'    => $this->content3,
                'approved'	=> 1,
                'pass'		=> 'hacky1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
            array(
                'confession_id'    => $confession_id+1,
                'content'    => $this->content1,
                'approved'	=> 1,
                'pass'		=> 'hacky1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
            array(
                'confession_id'    => $confession_id+1,
                'content'    => $this->content2,
                'approved'	=> 1,
                'pass'		=> 'hacky1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ),
        ));
    }

}

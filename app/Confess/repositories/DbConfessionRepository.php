<?php namespace Confess\Repositories;

use Auth, URL, Cache;
use Confess\Models\Confession;
use Confess\Models\ConfessionComment;

class DbConfessionRepository implements ConfessionRepositoryInterface
{
    /**
     * Get all of the confessions.
     *
     * @return array
     */
    public function all() {
        return Confession::orderBy( 'id', 'DESC' )->get();
    }

    /**
     * Paginate the confessions.
     *
     * @param int     $per_page
     *
     * @return array
     */
    public function paginate( $per_page = 10 ) {
        return Confession::where( 'approved', true )->orderBy( 'id', 'DESC' )->paginate( $per_page );
    }

    /**
     * Get a Confession by its hash.
     *
     * @param string  $hash
     * @return Confession
     */
    public function byHash( $hash ) {
        return $this->byId( \PseudoCrypt\PseudoCrypt::unhash( $hash ) );
    }

    /**
     * Get a Confession by its id.
     *
     * @param int     $id
     * @return Confession
     */
    public function byId( $id ) {
        return Confession::rememberForever( 'confession-'.$id )->findOrFail( $id );
    }

    public function addComment( $hash, $content ) {
        $confession = $this->byHash( $hash );

        return $confession->comments()->save( ConfessionComment::create( array( 'content'=>trim( $content ) ) ) );
    }

    /**
     * Create a new Confession.
     *
     * @param string  $content
     * @return Post
     */
    public function create( $content ) {
        return Confession::create( array( 'link'=>$this->getNewHash(), 'confession'=>trim($content) ) );
    }

    private function getNewHash() {
            $confession = Confession::orderBy('id', 'DESC')->first();
            $lastID = (isset($confession)) ? $confession->id : 0;
        return \PseudoCrypt\PseudoCrypt::hash(++$lastID);
    }

}

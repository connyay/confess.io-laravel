<?php namespace Confess\Repositories;

use Auth, URL, Cache, Request;
use Confess\Models\Confession;
use Confess\Models\ConfessionComment;
use Confess\Models\Vote;

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

    public function addVote( $hash, $value ) {
        $confession = $this->byHash( $hash );
        $vote = Vote::firstOrNew( array( 'confession_id'=>$confession->id, 'user_ip'=>ip2long( Request::getClientIp() ) ) );
        $status = 201;
        if ( $vote->exists && $vote->vote == $value ) {
            $status = 304;
        } else if ( $vote->exists && $vote->vote != $value ) {
                $status = 200;
            }
        if ( $status != 304 ) {
            $vote->vote = $value;
            $vote->save();
        }
        return $status;
    }

    /**
     * Create a new Confession.
     *
     * @param string  $confession
     * @return Post
     */
    public function create( $confession ) {
        return Confession::create( array( 'hash'=>$this->getNewHash(), 'confession'=>trim( $confession ) ) );
    }

    public function approveConfession($hash, $pass) {
        $confession = $this->byHash($hash);
        if($confession->pass == $pass) {
            $confession->approved = true;
            $confession->save();
        }
        return $confession;
    }

    private function getNewHash() {
        $confession = Confession::orderBy( 'id', 'DESC' )->first();
        $lastID = ( isset( $confession ) ) ? $confession->id : 0;
        return \PseudoCrypt\PseudoCrypt::hash( ++$lastID );
    }

}

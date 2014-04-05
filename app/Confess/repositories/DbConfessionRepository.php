<?php namespace Confess\Repositories;

use Auth, URL, Thumb, DB;
use Confess\Models\Confession;

class DbConfessionRepository implements ConfessionRepositoryInterface
{
    /**
     * Get all of the confessions.
     *
     * @return array
     */
    public function all()
    {
        return Gif::orderBy( 'id', 'DESC' )->get();
    }

    /**
     * Paginate the confessions.
     *
     * @param int $per_page
     *
     * @return array
     */
    public function paginate($per_page = 10)
    {
        return Confession::where('approved', true)->orderBy('id', 'DESC')->paginate($per_page);
    }

    /**
     * Get a Confession by its id.
     *
     * @param  int $id
     * @return Confession
     */
    public function find($id)
    {
        return Confession::rememberForever( 'gif-'.$id )->find( $id );
    }

    /**
     * Create a new Confession.
     *
     * @param  string $url
     * @return Post
     */
    public function create()
    {

        return Confession::create( compact( 'url', 'thumb' ) );
    }

}
<?php namespace Confess\Repositories;

interface ConfessionRepositoryInterface
{
    /**
     * Get all of the confessions.
     *
     * @return array
     */
    public function all();

    /**
     * Paginate the confessions.
     *
     * @param int $per_page
     *
     * @return array
     */
    public function paginate( $per_page );


    /**
     * Get a Confession by its id.
     *
     * @param  int $id
     * @return Confession
     */
    public function find( $id );

    /**
     * Create a new Confession.
     *
     * @return Confession
     */
    public function create( );

}
<?php namespace Confess\Controllers;

use Confess\Repositories\ConfessionRepositoryInterface;
class BaseConfessionController extends BaseController
{
    /**
     * The confession repository implementation.
     *
     * @var confessions
     */
    protected $confessions;

    /**
     * Create a new Confession controller.
     *
     * @param ConfessionRepositoryInterface $confessions
     *
     * @return ConfessionController
     */
    public function __construct(ConfessionRepositoryInterface $confessions)
    {
        $this->confessions = $confessions;
    }

}
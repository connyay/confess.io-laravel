<?php namespace Confess\Controllers;
use Mailgun;
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

    protected function sendApprovalEmail($data)
    {
        Mailgun::send( 'emails.approve', $data, function ($message) use ($data) {
                $message->to( 'grouphug.io@gmail.com' )->subject( $data['subject'] );
            } );
    }

}

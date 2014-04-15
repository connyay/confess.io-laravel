<?php namespace Confess\Controllers;

use View, Validator, Input, Redirect;

class ConfessionController extends BaseConfessionController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // Get all the confessions
        $confessions = $this->confessions->paginate();
        // Show the page
        return View::make( 'confession/index', compact( 'confessions' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make( 'confession/create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $redirect = 'n/new';
        // Declare the rules for the form validation
        $rules = array(
            'confession' => 'required|min:3',
            'name'   => 'honeypot',
            'email'   => 'required|honeytime:3'
        );

        // Validate the inputs
        $validator = Validator::make( Input::all(), $rules );

        // Check if the form validates with success
        if ( $validator->passes() ) {
            // Save the confession
            $confession = $this->confessions->create( Input::get( 'confession' ) );

            // Do we have a confession?
            if (isset($confession)) {
                $redirect = 'n/'.$confession->hash;
                $data = array(
                    'body'=>$confession->confession,
                    'subject'=>'New Post // ' . $confession->hash,
                    'url'=> link_to_route( 'approveConfession', 'Approve', array( 'hash'=>$confession->hash, 'pass'=>$confession->pass ) ) );
                $this->sendApprovalEmail( $data );
                // Redirect to this confession page
                return Redirect::to( $redirect )->with( 'success', 'Thank you. Your confession is pending approval.' );
            }

            // Redirect to this confession page
            return Redirect::to( $redirect )->with( 'error', 'Oops! There was a problem adding your comment, please try again.' );
        }

        // Redirect to this confession page
        return Redirect::to( $redirect )->withInput()->withErrors( $validator );
    }

    /**
     * View a confession.
     *
     * @param  string                $hash
     * @return View
     * @throws NotFoundHttpException
     */
    public function view($hash)
    {
        // Get this confession data
        $confession = $this->confessions->byHash( $hash );
        // Show the page
        return View::make( 'confession/view', compact( 'confession' ) );
    }

    public function approve($hash, $pass)
    {
        $confession = $this->confessions->approveConfession( $hash, $pass );
        return Redirect::to( 'n/'.$confession->hash )->with( 'success', 'Confession Approved' );
    }

}

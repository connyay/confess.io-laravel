<?php namespace Confess\Controllers;

use Validator, Input, Response;
class ConfessionVoteController extends BaseConfessionController
{
    /**
     * Vote on a confession.
     *
     * @return string Response
     */
    public function vote($hash)
    {
        // Declare the rules for the validation
        $rules = array(
            'vote' => 'required'
        );

        // Validate the inputs
        $validator = Validator::make( Input::all(), $rules );

        // Check if the form validates with success
        if ( $validator->passes() ) {
            $vote = Input::get( 'vote' );
            $status = $this->confessions->addVote( $hash, $vote );
            $response = ['vote'=>(($vote === '1') ? "Hug" : "Shrug")];

            return Response::make( $response, $status );
        }

    }

}

<?php namespace Confess\Controllers;

use Validator, Redirect, Input;
class ConfessionCommentController extends BaseConfessionController {

    /**
     * Comment on a confession.
     *
     * @param string  $hash
     * @return Redirect
     */
    public function comment( $hash ) {
        $redirect = 'n/'.$hash;

        // Declare the rules for the form validation
        $rules = array(
            'comment' => 'required|min:3',
        );

        // Validate the inputs
        $validator = Validator::make( Input::all(), $rules );

        // Check if the form validates with success
        if ( $validator->passes() ) {
            if ( $this->confessions->addComment( $hash, Input::get( 'comment' ) ) ) {
                // Redirect to this confession page
                return Redirect::to( $redirect )->with( 'success', 'Thank you for your comment. Your comment will be posted once it is approved.' );
            }
            // Redirect to this confession page
            return Redirect::to( $redirect )->with( 'error', 'Oops! There was a problem adding your comment, please try again.' );
        }

        // Redirect to this confession page
        return Redirect::to( $redirect )->withInput()->withErrors( $validator );
    }

}

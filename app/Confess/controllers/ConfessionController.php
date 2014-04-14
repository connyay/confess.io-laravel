<?php namespace Confess\Controllers;

use View, Validator, Input, Redirect;

class ConfessionController extends BaseConfessionController {
    
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
        return View::make('confession/index', compact('confessions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('confession/create');
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
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Save the confession
            $lastId = $confession = Confession::orderBy('id', 'DESC')->first()->id;

            $confession = new Confession;
            $confession->confession = trim(Input::get('confession'));
            $confession->pass = Str::random(6);
            $confession->approved = true;
            $link = PseudoCrypt::hash(++$lastId);
            $confession->link = $link;
            $redirect = 'n/'.$link;
            // Was the comment saved with success?
            if($confession->save())
            {
                // Redirect to this confession page
                return Redirect::to($redirect)->with('success', 'Thank you. Your confession is pending approval.');
            }

            // Redirect to this confession page
            return Redirect::to($redirect)->with('error', 'Oops! There was a problem adding your comment, please try again.');
        }

        // Redirect to this confession page
        return Redirect::to($redirect)->withInput()->withErrors($validator);
    }

    /**
     * View a confession.
     *
     * @param  string  $link
     * @return View
     * @throws NotFoundHttpException
     */
    public function view($link)
    {
        // Get this confession data
        $confession = $this->confessions->byHash($link);

        // Check if the confession exists
        if (is_null($confession))
        {
            // If we ended up in here, it means that
            // a page or a confession didn't exist.
            // So, this means that it is time for
            // 404 error page.
            return App::abort(404);
        }

        // Get this confession comments
        $comments = $confession->comments()->orderBy('created_at', 'ASC')->get();

        // Show the page
        return View::make('confession/view', compact('confession', 'comments'));
    }

}
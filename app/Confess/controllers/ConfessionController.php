<?php namespace Confess\Controllers;

use View;
use Confess\Repositories\ConfessionRepositoryInterface;

class ConfessionController extends BaseController {
    
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
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
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
            $link = PseudoCrypt::udihash(++$lastId);
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
    public function getView($link)
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

    /**
     * Comment on a confession.
     *
     * @param  string  $link
     * @return Redirect
     */
    public function postView($link)
    {
        $redirect = 'n/'.$link;

        // Get this confession data
        $post = $this->confession->where('link', '=', $link)->first();

        // Declare the rules for the form validation
        $rules = array(
            'comment' => 'required|min:3',
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Save the comment
            $comment = new ConfessionComment;
            $comment->content = trim(Input::get('comment'));
            $comment->approved = true;
            // Was the comment saved with success?
            if($post->comments()->save($comment))
            {
                // Redirect to this confession page
                return Redirect::to($redirect)->with('success', 'Thank you for your comment. Your comment will be posted once it is approved.');
            }

            // Redirect to this confession page
            return Redirect::to($redirect)->with('error', 'Oops! There was a problem adding your comment, please try again.');
        }

        // Redirect to this confession page
        return Redirect::to($redirect)->withInput()->withErrors($validator);
    }

    /**
     * Vote on a confession.
     *
     * @return string Response
     */
    public function postVote()
    {
        // Declare the rules for the validation
        $rules = array(
            'vote' => 'required',
            'id' => 'required',
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            $id = Input::get('id');
            $newVote = Input::get('vote');
            $ip = ip2long(Request::getClientIp());
            $confession = $this->confession->where('id', '=', $id)->first();
            $vote = $confession->votes()->where('user_ip', '=', $ip)->first();
            if(isset($vote)) {
                if($vote->vote != $newVote) {
                    $response = array('result' => 'changed');
                } else {
                    $response = array('result' => 'same');
                }
            } else {
                $vote = new Vote;    
            }
            $vote->vote = $newVote;
            $vote->user_ip = $ip;
            
         if($confession->votes()->save($vote)) {
               if(!isset($response)) {$response = $response = array('result' => 'new'); }
             }
        }

        if(!isset($response)) {
            $response = array('status'=>'400', 'result' => 'failed'); 
        } else {
            $response['status'] = '200';
        }

        return json_encode($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
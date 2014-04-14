<?php namespace Confess\Controllers;

class ConfessionVoteController extends BaseConfessionController {
    
    /**
     * Vote on a confession.
     *
     * @return string Response
     */
    public function vote($hash)
    {
        dd($hash);
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

}
<?php namespace Confess\Models;

use URL;
use dflydev\markdown\MarkdownParser;

class Confession extends BaseModel {
    protected $guarded = array();

    public static $rules = array();

	/**
	 * Get the confession's comments.
	 *
	 * @return array
	 */
	public function comments()
	{
		return $this->hasMany('\Confess\Models\ConfessionComment')->where('approved', true);
	}

	/**
	 * Get the confession's votes.
	 *
	 * @return array
	 */
	public function votes()
	{
		return $this->hasMany('\Confess\Models\Vote');
	}

	/**
	 * Get the confession's hugs.
	 *
	 * @return array
	 */
	public function hugs()
	{
		return $this->votes()->where('vote', 1);
	}
	
	/**
	 * Get the confession's shrugs.
	 *
	 * @return array
	 */
	public function shrugs()
	{
		return $this->votes()->where('vote', -1);
	}

	/**
	 * Returns a formatted post content entry,
	 * this ensures that line breaks are returned.
	 *
	 * @return string
	 */
	public function content()
	{
		return strip_tags( md($this->confession), '<p><strong><em><blockquote>' );
	}

	public function twitterCard()
	{
		$card = '<meta name="twitter:card" content="summary">'
			.	'<meta name="twitter:site" content="@confess_io">'
			.	'<meta name="twitter:title" content="New Confession">'
			. 	'<meta name="twitter:description" content="' . $this->confession . '">';

		return $card;
	}

    /**
     * Get the date the confession was created.
     *
     * @param \Carbon|null $date
     * @return string
     */
    public function date($date=null)
    {
        if(is_null($date)) {
            $date = $this->created_at;
        }
        return String::date($date);
    }

    /**
	 * Get the URL to the confession.
	 *
	 * @return string
	 */
	public function url()
	{
		return Url::to('n/'.$this->link);
	}
}
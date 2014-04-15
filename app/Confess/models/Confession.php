<?php namespace Confess\Models;

use URL, Str;

class Confession extends BaseModel {
	protected $fillable = array( 'hash', 'confession' );

	public function save( array $options = array() ) {
		$this->pass = Str::random( 6 );
		parent::save( $options );
	}

	/**
	 * Get the confession's comments.
	 *
	 * @return array
	 */
	public function comments($approved = true) {
		return $this->hasMany( '\Confess\Models\ConfessionComment' )->where( 'approved', $approved );
	}

	/**
	 * Get the confession's votes.
	 *
	 * @return array
	 */
	public function votes() {
		return $this->hasMany( '\Confess\Models\Vote' );
	}

	/**
	 * Get the confession's hugs.
	 *
	 * @return array
	 */
	public function hugs() {
		return count($this->votes->filter(function($vote) {
			return ($vote->vote == 1);
		}));
	}

	/**
	 * Get the confession's shrugs.
	 *
	 * @return array
	 */
	public function shrugs() {
		return count($this->votes->filter(function($vote) {
			return ($vote->vote == -1);
		}));
	}

	/**
	 * Returns a formatted post content entry,
	 * this ensures that line breaks are returned.
	 *
	 * @return string
	 */
	public function content() {
		return strip_tags( md( $this->confession ), '<p><strong><em><blockquote>' );
	}

	public function twitterCard() {
		$card = '<meta name="twitter:card" content="summary">'
			. '<meta name="twitter:site" content="@confess_io">'
			. '<meta name="twitter:title" content="New Confession">'
			.  '<meta name="twitter:description" content="' . $this->confession . '">';

		return $card;
	}

	/**
	 * Get the date the confession was created.
	 *
	 * @return string
	 */
	public function date() {
		return \Carbon\Carbon::createFromTimeStamp( strtotime( $this->created_at ) )->diffForHumans();
	}

	/**
	 * Get the URL to the confession.
	 *
	 * @return string
	 */
	public function url() {
		return Url::to( 'n/'.$this->hash );
	}
}

<?php namespace Confess\Models;
use Str;

class ConfessionComment extends BaseModel {

    protected $fillable = array( 'content' );
    
    public function save( array $options = array() ) {
        $this->pass = Str::random(6);
        parent::save( $options );
    }

    /**
     * Get the comment's content.
     *
     * @return string
     */
    public function content() {
        return nl2br( $this->content );
    }

    /**
     * Get the comment's confession
     *
     * @return Confession
     */
    public function confession() {
        return $this->belongsTo( '\Confess\Models\Confession' );
    }

    /**
     * Get the date the post was created.
     *
     * @param \Carbon|null $date
     * @return string
     */
    public function date() {
        return \Carbon\Carbon::createFromTimeStamp( strtotime( $this->created_at ) )->diffForHumans();
    }

    /**
     * Returns the date of the blog post creation,
     * on a good and more readable format :)
     *
     * @return string
     */
    public function created_at() {
        return $this->date( $this->created_at );
    }

    /**
     * Returns the date of the blog post last update,
     * on a good and more readable format :)
     *
     * @return string
     */
    public function updated_at() {
        return $this->date( $this->updated_at );
    }

}

<?php namespace Confess\Models;
use URL;
class BlogPost extends BaseModel
{
    /**
     * Returns a formatted post content entry,
     * this ensures that line breaks are returned.
     *
     * @return string
     */
    public function content()
    {
         return strip_tags( md( $this->content ), '<p><strong><em><blockquote>' );
    }

    /**
     * Get the post's author.
     *
     * @return User
     */
    public function author()
    {
        return $this->belongsTo('\Confess\Models\User', 'user_id');
    }

    /**
     * Get the post's comments.
     *
     * @return array
     */
    public function comments()
    {
        return $this->hasMany('\Confess\Models\BlogComment');
    }

    /**
     * Get the date the post was created.
     *
     * @return string
     */
     public function date()
    {
        return \Carbon\Carbon::createFromTimeStamp( strtotime( $this->created_at ) )->diffForHumans();
    }

    /**
     * Get the URL to the post.
     *
     * @return string
     */
    public function url()
    {
        return Url::to('blog/'.$this->slug);
    }

    /**
     * Returns the date of the blog post creation,
     * on a good and more readable format :)
     *
     * @return string
     */
    public function created_at()
    {
        return $this->date($this->created_at);
    }

    /**
     * Returns the date of the blog post last update,
     * on a good and more readable format :)
     *
     * @return string
     */
    public function updated_at()
    {
        return $this->date($this->updated_at);
    }

}

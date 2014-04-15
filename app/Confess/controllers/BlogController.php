<?php namespace Confess\Controllers;

use View;
use Confess\Models\BlogPost;

class BlogController extends BaseController
{
    /**
     * Post Model
     * @var BlogPost
     */
    protected $post;

    /**
     * Inject the models.
     * @param BlogPost $post
     */
    public function __construct(BlogPost $post)
    {
        $this->post = $post;
    }

    /**
     * Returns all the blog posts.
     *
     * @return View
     */
    public function index()
    {
        // Get all the blog posts
        $posts = $this->post->orderBy('created_at', 'DESC')->paginate(10);

        // Show the page
        return View::make('blog/index', compact('posts'));
    }

    /**
     * View a blog post.
     *
     * @param  string                $slug
     * @return View
     * @throws NotFoundHttpException
     */
    public function view($slug)
    {
        // Get this blog post data
        $post = $this->post->where('slug', '=', $slug)->first();

        // Check if the blog post exists
        if (is_null($post)) {
            // If we ended up in here, it means that
            // a page or a blog post didn't exist.
            // So, this means that it is time for
            // 404 error page.
            return App::abort(404);
        }


        // Show the page
        return View::make('blog/view', compact('post'));
    }
}

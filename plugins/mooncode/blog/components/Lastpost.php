<?php namespace Mooncode\Blog\Components;

use Redirect;
use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use Mooncode\Blog\Models\Post as BlogPost;
use Mooncode\Blog\Models\Category as BlogCategory;
use Mooncode\Blog\Components\Posts;
class Lastpost extends ComponentBase
{
	 /**
     * A collection of posts to display
     * @var Collection
     */
    public $post;

    /**
     * Parameter to use for the page number
     * @var string
     */
    public $pageParam;

    /**
     * If the post list should be filtered by a category, the model to use.
     * @var Model
     */
    public $category;

    /**
     * Message to display when there are no messages.
     * @var string
     */
    public $noPostsMessage;

    /**
     * Reference to the page name for linking to posts.
     * @var string
     */
    public $postPage;

    /**
     * Reference to the page name for linking to categories.
     * @var string
     */
    public $categoryPage;

    /**
     * If the post list should be ordered by another attribute.
     * @var string
     */
    public $sortOrder;

    public function componentDetails()
    {
        return [
            'name'        => 'mooncode.blog::lang.settings.lastpost_title',
            'description' => 'mooncode.blog::lang.settings.lastpost_description'
        ];
    } 
    public function loadLastPost() 
    {
      $post = (new Posts)->lastPost();


      return $post;
    } 
    public function onRun()
    {
    	$this->post = $this->loadLastPost();

    } 
}


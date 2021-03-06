<?php namespace Mooncode\Blog\Components;

use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use Mooncode\Blog\Models\Post as BlogPost;

class Post extends ComponentBase
{
    /**
     * @var RainLab\Blog\Models\Post The post model used for display.
     */
    public $post;

    /**
     * @var string Reference to the page name for linking to categories.
     */
    public $categoryPage;

    public function componentDetails()
    {
        return [
            'name'        => 'mooncode.blog::lang.settings.post_title',
            'description' => 'mooncode.blog::lang.settings.post_description'
        ];
    }

    public function defineProperties()
    {
        return [
            'slug' => [
                'title'       => 'mooncode.blog::lang.settings.post_slug',
                'description' => 'mooncode.blog::lang.settings.post_slug_description',
                'default'     => '{{ :slug }}',
                'type'        => 'string'
            ],
            'categoryPage' => [
                'title'       => 'mooncode.blog::lang.settings.post_category',
                'description' => 'mooncode.blog::lang.settings.post_category_description',
                'type'        => 'dropdown',
                'default'     => 'blog/category',
            ],
        ];
    }

    public function getCategoryPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function onRun()
    {
        $this->categoryPage = $this->page['categoryPage'] = $this->property('categoryPage');
        $this->post = $this->page['post'] = $this->loadPost();
    }

    protected function loadPost()
    {
        $slug = $this->property('slug');

        $post = new BlogPost;

        $post = $post->isClassExtendedWith('Mooncode.Translate.Behaviors.TranslatableModel')
            ? $post->transWhere('slug', $slug)
            : $post->where('slug', $slug);

        $post = $post->isPublished()->first();

        /*
         * Add a "url" helper attribute for linking to each category
         */
        if ($post && $post->categories->count()) {
            $post->categories->each(function($category){
                $category->setUrl($this->categoryPage, $this->controller);
            });
        }

        return $post;
    }
}

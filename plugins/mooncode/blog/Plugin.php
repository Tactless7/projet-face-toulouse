<?php namespace Mooncode\Blog;

use Backend;
use Controller;
use Mooncode\Blog\Models\Post;
use System\Classes\PluginBase;
use Mooncode\Blog\Classes\TagProcessor;
use Mooncode\Blog\Models\Category;
use Event;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'mooncode.blog::lang.plugin.name',
            'description' => 'mooncode.blog::lang.plugin.description',
            'author'      => 'monica',
            'icon'        => 'icon-pencil',
            'homepage'    => 'https://github.com/mooncode/blog-plugin'
        ];
    }

    public function registerComponents()
    {
        return [
            'Mooncode\Blog\Components\Post'       => 'blogPost',
            'Mooncode\Blog\Components\Posts'      => 'blogPosts',
            'Mooncode\Blog\Components\Categories' => 'blogCategories',
            'Mooncode\Blog\Components\RssFeed'    => 'blogRssFeed',
            'Mooncode\Blog\Components\Lastpost'   => 'blogLastpost'


        ];
    }

    public function registerPermissions()
    {
        return [
            'mooncode.blog.access_posts' => [
                'tab'   => 'mooncode.blog::lang.blog.tab',
                'label' => 'mooncode.blog::lang.blog.access_posts'
            ],
            'mooncode.blog.access_categories' => [
                'tab'   => 'mooncode.blog::lang.blog.tab',
                'label' => 'mooncode.blog::lang.blog.access_categories'
            ],
            'mooncode.blog.access_other_posts' => [
                'tab'   => 'mooncode.blog::lang.blog.tab',
                'label' => 'mooncode.blog::lang.blog.access_other_posts'
            ],
            'mooncode.blog.access_import_export' => [
                'tab'   => 'mooncode.blog::lang.blog.tab',
                'label' => 'mooncode.blog::lang.blog.access_import_export'
            ],
            'mooncode.blog.access_publish' => [
                'tab'   => 'mooncode.blog::lang.blog.tab',
                'label' => 'mooncode.blog::lang.blog.access_publish'
            ]
        ];
    }

    public function registerNavigation()
    {
        return [
            'blog' => [
                'label'       => 'mooncode.blog::lang.blog.menu_label',
                'url'         => Backend::url('mooncode/blog/posts'),
                'icon'        => 'icon-pencil',
                'iconSvg'     => 'plugins/mooncode/blog/assets/images/blog-icon.svg',
                'permissions' => ['mooncode.blog.*'],
                'order'       => 30,

                'sideMenu' => [
                    'new_post' => [
                        'label'       => 'mooncode.blog::lang.posts.new_post',
                        'icon'        => 'icon-plus',
                        'url'         => Backend::url('mooncode/blog/posts/create'),
                        'permissions' => ['mooncode.blog.access_posts']
                    ],
                    'posts' => [
                        'label'       => 'mooncode.blog::lang.blog.posts',
                        'icon'        => 'icon-copy',
                        'url'         => Backend::url('mooncode/blog/posts'),
                        'permissions' => ['mooncode.blog.access_posts']
                    ],
                    'categories' => [
                        'label'       => 'mooncode.blog::lang.blog.categories',
                        'icon'        => 'icon-list-ul',
                        'url'         => Backend::url('mooncode/blog/categories'),
                        'permissions' => ['mooncode.blog.access_categories']
                    ]
                ]
            ]
        ];
    }

    public function registerFormWidgets()
    {
        return [
            'mooncode\Blog\FormWidgets\Preview' => [
                'label' => 'Preview',
                'code'  => 'preview'
            ]
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     */
    public function register()
    {
        /*
         * Register the image tag processing callback
         */
        TagProcessor::instance()->registerCallback(function($input, $preview) {
            if (!$preview) {
                return $input;
            }

            return preg_replace('|\<img src="image" alt="([0-9]+)"([^>]*)\/>|m',
                '<span class="image-placeholder" data-index="$1">
                    <span class="upload-dropzone">
                        <span class="label">Click or drop an image...</span>
                        <span class="indicator"></span>
                    </span>
                </span>',
            $input);
        });
    }

    public function boot()
    {
        /*
         * Register menu items for the mooncode.Pages plugin
         */
        Event::listen('pages.menuitem.listTypes', function() {
            return [
                'blog-category'       => 'mooncode.blog::lang.menuitem.blog_category',
                'all-blog-categories' => 'mooncode.blog::lang.menuitem.all_blog_categories',
                'blog-post'           => 'mooncode.blog::lang.menuitem.blog_post',
                'all-blog-posts'      => 'mooncode.blog::lang.menuitem.all_blog_posts',
            ];
        });

        Event::listen('pages.menuitem.getTypeInfo', function($type) {
            if ($type == 'blog-category' || $type == 'all-blog-categories') {
                return Category::getMenuTypeInfo($type);
            }
            elseif ($type == 'blog-post' || $type == 'all-blog-posts') {
                return Post::getMenuTypeInfo($type);
            }
        });

        Event::listen('pages.menuitem.resolveItem', function($type, $item, $url, $theme) {
            if ($type == 'blog-category' || $type == 'all-blog-categories') {
                return Category::resolveMenuItem($item, $url, $theme);
            }
            elseif ($type == 'blog-post' || $type == 'all-blog-posts') {
                return Post::resolveMenuItem($item, $url, $theme);
            }
        });
    }
}

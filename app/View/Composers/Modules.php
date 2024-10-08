<?php

namespace App\View\Components;

use Illuminate\View\Component;
use WP_Query;

class FeaturedProducts extends Component
{
    public $categoryId;
    public $productPerPage;
    public $sectionTitle;
    public $sectionDescription;

    public function __construct($categoryId, $productPerPage = 4, $sectionTitle = '', $sectionDescription = '')
    {
        $this->categoryId = $categoryId;
        $this->productPerPage = $productPerPage;
        $this->sectionTitle = $sectionTitle;
        $this->sectionDescription = $sectionDescription;
    }

    public function getFeaturedProducts()
    {
        $args = [
            'post_type' => 'product',
            'posts_per_page' => $this->productPerPage,
            'tax_query' => [
                [
                    'taxonomy' => 'product_cat',
                    'field' => 'term_id',
                    'terms' => $this->categoryId,
                ],
            ],
            'post__in' => wc_get_featured_product_ids(),
        ];

        return new WP_Query($args);
    }

    public function render()
    {
        return view('components.module.featured-products', [
            'featured_products' => $this->getFeaturedProducts(),
            'category' => get_term($this->categoryId, 'product_cat'),
        ]);
    }
}


class FeaturedText extends Component
{
    public $sectionTitle;
    public $sectionDescription;
    public $items; 

 
    public function __construct($sectionTitle = '', $sectionDescription = '', array $items = [])
    {
        $this->sectionTitle = $sectionTitle;
        $this->sectionDescription = $sectionDescription;
        $this->items = $items; 
    }

    public function render()
    {
        return view('components.module.featured-text', [
            'items' => $this->items, 
        ]);
    }
}

class Subcategories extends Component
{
    public $categoryId;
    public $subcategories;

    /**
     * Create the component instance.
     *
     * @param  int  $categoryId
     * @return void
     */
    public function __construct($categoryId)
    {
        $this->categoryId = $categoryId;
        $this->subcategories = get_terms([
            'taxonomy' => 'product_cat',
            'hide_empty' => false,
            'parent' => $this->categoryId,
        ]);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.subcategories');
    }
}
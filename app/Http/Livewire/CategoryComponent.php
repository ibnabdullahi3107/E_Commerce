<?php

namespace App\Http\Livewire;

use Cart;
use App\Models\Product;
use Livewire\Component;
// use Gloudemans\Shoppingcart\Cart;
use App\Models\Category;
use Livewire\WithPagination;

class CategoryComponent extends Component
{
    use WithPagination;
    public $pagesize = 12;
    public $orderBy = "Default Sorting";

    public $slug;

    public function store($product_id, $product_name, $product_price)
    {

        Cart::add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        session()->flash('success_message', 'Item Added successfully in Cart');
        return redirect()->route('shop.cart');
        
    }
    public function changePageSize($size)
    {
        $this->pagesize = $size;
    }

    public function changeOrderBy($order)
    {
        $this->orderBy = $order;
    }

    public function mount($slug)
    {
        $this->slug = $slug;
    }
    public function render()
    {
        $category = Category::where('slug', $this->slug)->first();
        $category_id = $category->id;
        $category_name = $category->name;


        if($this->orderBy == 'Price: Low to High')
        {
            $products = Product::where('category_id', $category_id)->orderBy('regular_price', 'ASC')->paginate($this->pagesize);
        }
        else if($this->orderBy == 'Price: High to Low')
        {
            $products = Product::where('category_id', $category_id)->orderBy('regular_price', 'DESC')->paginate($this->pagesize);

        }
        else if($this->orderBy == 'Sort By Newness')
        {
            $products = Product::where('category_id', $category_id)->orderBy('created_at', 'DESC')->paginate($this->pagesize);

        }
        else{
            $products = Product::where('category_id', $category_id)->paginate($this->pagesize);

        }

        $categories = Category::orderBy('name', 'ASC')->get();


        return view('livewire.category-component', compact('products', 'categories', 'category_name'));
    }
}

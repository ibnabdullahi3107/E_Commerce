<?php

namespace App\Http\Livewire;

use Cart;
use App\Models\Product;
use Livewire\Component;
// use Gloudemans\Shoppingcart\Cart;
use App\Models\Category;
use Livewire\WithPagination;

class ShopComponent extends Component
{
    use WithPagination;
    public $pagesize = 12;
    public $orderBy = "Default Sorting";

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
    public function render()
    {
        if($this->orderBy == 'Price: Low to High')
        {
            $products = Product::orderBy('regular_price', 'ASC')->paginate($this->pagesize);
        }
        else if($this->orderBy == 'Price: High to Low')
        {
            $products = Product::orderBy('regular_price', 'DESC')->paginate($this->pagesize);

        }
        else if($this->orderBy == 'Sort By Newness')
        {
            $products = Product::orderBy('created_at', 'DESC')->paginate($this->pagesize);

        }
        else{
            $products = Product::paginate($this->pagesize);

        }

        $categories = Category::orderBy('name', 'ASC')->get();


        return view('livewire.shop-component', compact('products', 'categories'));
    }
}

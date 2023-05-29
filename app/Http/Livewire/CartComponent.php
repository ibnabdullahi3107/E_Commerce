<?php

namespace App\Http\Livewire;
use Cart;

use Livewire\Component;

class CartComponent extends Component
{
    public function increaseQuantity($rowId)
    {
        $product = Cart::get($rowId);
        $qty = $product -> qty + 1;
        Cart::update($rowId, $qty);
        $this->emitTo('cart-icon-component', 'refreshComponent');
    }

    public function decreaseQuantity($rowId)
    {
        $product = Cart::get($rowId);
        $qty = $product -> qty - 1;
        Cart::update($rowId, $qty);
        $this->emitTo('cart-icon-component', 'refreshComponent');

    }

    public function destory($id)
    {
        Cart::remove($id);
        $this->emitTo('cart-icon-component', 'refreshComponent');

        session()->flash('success_message', 'Item Removed successfully');
    }

    public function destoryAll()
    {
        Cart::destroy();
        $this->emitTo('cart-icon-component', 'refreshComponent');

    }

    public function render()
    {
        return view('livewire.cart-component');
    }
}

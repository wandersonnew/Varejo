<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class Productstable extends Component
{
    public $products = '';

    public function mount()
    {
        $this->products = Product::all();
    }

    public function deleteConfirmation(Product $product)
    {
        // $this->dispatch('show-delete-confirmation', ['productId' => $id]);
        $product->delete();
        session()->flash('message','Produto deletado com sucesso!');
        return redirect()->route('products.index');
    }

    public function render()
    {
        return view('livewire.productstable');
    }
}

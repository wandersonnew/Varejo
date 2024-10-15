<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;

class ProductList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function deleteConfirmation(Product $product)
    {
        // $this->dispatch('show-delete-confirmation', ['productId' => $id]);
        $product->delete();
        session()->flash('message','Produto deletado com sucesso!');
        return redirect()->route('products.index');
    }

    public function render()
    {
        return view('livewire.product-list', [
            'products' => Product::paginate(2),
        ]);
    }
}

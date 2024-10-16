<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use Storage;

class ProductList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function deleteConfirmation(Product $product)
    {
        if(Storage::fileExists($product->imagem_url))
            Storage::delete($product->imagem_url);
        // $folder = Storage::files('livewire-tmp');
        
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

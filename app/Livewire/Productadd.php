<?php

namespace App\Livewire;

use Livewire\Attributes\Validate; 
use Livewire\Component;
use App\Models\Category;
use App\Models\Product;

class Productadd extends Component
{
    public $categories = '';

    #[Validate('required')]
    public $nome = '';

    public $descricao = '';

    #[Validate('required')]
    public $preco_compra = '';
    
    #[Validate('required')]
    public $preco_venda = '';
    
    #[Validate('required')]
    public $categoria_id = '';
    
    public $quantidade_estoque = 2;
    
    public $imagem_url = '';

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function save()
    {
        Product::create(
        $this->only(['nome', 'descricao', 'preco_compra', 'preco_venda', 'categoria_id', 'quantidade_estoque', 'imagem_url'])
        );

        session()->flash('message', 'Produto cadastrado com sucesso.');
 
        return $this->redirect('/products');

    }

    public function render()
    {
        return view('livewire.productadd');
    }
}

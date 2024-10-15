<?php

namespace App\Livewire;

use Livewire\Attributes\Validate; 
use Livewire\Component;
use App\Models\Category;
use App\Models\Product;

class Productedit extends Component
{
    public $categories;
    public $nome;
    public $descricao;
    public $preco_compra;
    public $preco_venda;
    public $categoria_id;
    public $quantidade_estoque = 2;
    public $imagem_url;

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function render()
    {
        return view('livewire.productedit');
    }
}

/*

namespace App\Livewire;

use Livewire\Attributes\Validate; 
use Livewire\Component;
use App\Models\Category;
use App\Models\Product;

class Productadd extends Component
{
    public $categories;
    public $nome;
    public $descricao;
    public $preco_compra;
    public $preco_venda;
    public $categoria_id;
    public $quantidade_estoque = 2;
    public $imagem_url;

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function save()
    {
        $this->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:500',
            'preco_compra' => 'required|numeric|min:0',
            'preco_venda' => 'required|numeric|min:0',
            'categoria_id' => 'required|exists:categories,id',
            'imagem_url' => 'nullable|image|max:2048',
        ]);

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
*/
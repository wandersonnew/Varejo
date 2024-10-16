<?php

namespace App\Livewire;

use Livewire\WithFileUploads;
use Livewire\Attributes\Validate; 
use Livewire\Component;
use App\Models\Category;
use App\Models\Product;

class Productadd extends Component
{
    use WithFileUploads;

    public $nome
    ,$descricao
    ,$preco_compra
    ,$preco_venda
    ,$categoria_id
    ,$quantidade_estoque = 2
    ,$imagem_url;

    public function rules()
    {
        return [
            'nome' => 'required|string|min:3|max:50',
            'descricao' => 'nullable|string|min:3|max:100',
            'preco_compra' => 'required|numeric|min:0',
            'preco_venda' => 'required|numeric|min:0',
            'categoria_id' => 'required|exists:categories,id',
            'imagem_url' => 'nullable|image|max:2048',
        ];
    }

    public function messages() 
    {
        return [
            'nome.required' => 'O nome é obrigatório.',
            'nome.min' => 'O nome deve ter pelo menos 3 caracteres.',
            'nome.max' => 'O nome deve ter no máximo 50 caracteres.',

            'descricao.min' => 'A descrição deve ter pelo menos 3 caracteres.',
            'descricao.max' => 'A descrição deve ter no máximo 100 caracteres.',

            'preco_compra.required' => 'O preço de compra é obrigatório.',
            'preco_compra.numeric' => 'O preço de compra deve ser um número.',
            'preco_compra.min' => 'O preço de compra não pode ser negativo.',

            'preco_venda.required' => 'O preço de venda é obrigatório.',
            'preco_venda.numeric' => 'O preço de venda deve ser um número.',
            'preco_venda.min' => 'O preço de venda não pode ser negativo.',

            'categoria_id.required' => 'A categoria é obrigatória.',
            'categoria_id.exists' => 'A categoria selecionada é inválida.',

            'imagem_url.image' => 'O arquivo deve ser uma imagem.',
            'imagem_url.max' => 'A imagem não pode exceder 2MB.',
        ];
    }

    public function save()
    {
        $validated = $this->validate();

        // if($this->imagem_url)
        // {
        //     $this->imagem_url->store(path: 'public/uploads');
        //     $name = $this->imagem_url->getClientOriginalName();
        //     $path = $this->imagem_url->storeAs('images', $name, 'public');
        // }

        Product::create(
            $this->only([
                'nome',
                'descricao',
                'preco_compra',
                'preco_venda',
                'categoria_id',
                'quantidade_estoque',
                'imagem_url',
            ])
        );

        session()->flash('message', 'Produto cadastrado com sucesso.');
 
        return $this->redirect('/products');

    }

    public function render()
    {
        return view('livewire.product-add', [
            'categories'=> Category::all(),
        ]);
    }
}

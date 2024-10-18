<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Category;
use App\Models\Product;
use Mail;
use App\Mail\SendMail;
use Livewire\WithPagination;
use Storage;

class Products extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    use WithFileUploads;

    public $productId
    ,$nome
    ,$descricao
    ,$preco_compra
    ,$preco_venda
    ,$categoria_id
    ,$quantidade_estoque
    ,$imagem_url;

    public function rules()
    {
        return [
            'nome' => 'required|string|min:3|max:50',
            'descricao' => 'nullable|string|min:3|max:100',
            'preco_compra' => 'required|numeric|min:0',
            'preco_venda' => 'required|numeric|min:0',
            'quantidade_estoque' => 'required|numeric',
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

            'quantidade_estoque.required' => 'A quantidade é obrigatória.',
            'quantidade_estoque.numeric' => 'A quantidade deve ser um número.',

            'categoria_id.required' => 'A categoria é obrigatória.',
            'categoria_id.exists' => 'A categoria selecionada é inválida.',

            'imagem_url.image' => 'O arquivo deve ser uma imagem.',
            'imagem_url.max' => 'A imagem não pode exceder 2MB.',
        ];
    }

    // public function mount()
    // {
    //     $this->products = Product::paginate(2);
    // }

    public function deleteConfirmation(Product $product)
    {
        if(Storage::fileExists($product->imagem_url))
            Storage::delete($product->imagem_url);
        
        $product->delete();
        session()->flash('message','Produto deletado com sucesso!');
        // return redirect()->route('products');
        $this->resetPage();
    }

    public function save()
    {
        $validated = $this->validate();

        if ($this->productId) {
            $product = Product::find($this->productId);

            if ($this->imagem_url) {
                $path = $this->imagem_url->store('public', 'public');
            } else {
                $path = $product->imagem_url;
            }

            $product->update([
                'nome' => $validated['nome'],
                'descricao' => $validated['descricao'],
                'preco_compra' => $validated['preco_compra'],
                'preco_venda' => $validated['preco_venda'],
                'categoria_id' => $validated['categoria_id'],
                'quantidade_estoque' => $validated['quantidade_estoque'],
                'imagem_url' => $path,
            ]);

            session()->flash('message', 'Produto atualizado com sucesso.');
        } else {
            // Criando um novo produto
            if ($this->imagem_url) {
                $path = $this->imagem_url->store('public', 'public');
            } else {
                $path = '';
            }

            Product::create([
                'nome' => $validated['nome'],
                'descricao' => $validated['descricao'],
                'preco_compra' => $validated['preco_compra'],
                'preco_venda' => $validated['preco_venda'],
                'categoria_id' => $validated['categoria_id'],
                'quantidade_estoque' => $validated['quantidade_estoque'],
                'imagem_url' => $path,
            ]);

            session()->flash('message', 'Produto cadastrado com sucesso.');
        }

        return $this->redirect('/products');
    }


    public function edit($id)
    {
        $product = Product::findOrFail($id);

        // Preenche as propriedades com os dados do produto encontrado
        $this->nome = $product->nome;
        $this->descricao = $product->descricao;
        $this->preco_compra = $product->preco_compra;
        $this->preco_venda = $product->preco_venda;
        $this->categoria_id = $product->categoria_id;
        $this->quantidade_estoque = $product->quantidade_estoque;
        $this->productId = $product->id;
    }

    public function resetForm()
    {
        $this->productId = null;
        $this->nome = '';
        $this->descricao = '';
        $this->preco_compra = '';
        $this->preco_venda = '';
        $this->categoria_id = '';
        $this->quantidade_estoque = '';
        $this->imagem_url = null;
    }

    public function render()
    {
        return view('livewire.products', [
            'categories'=> Category::all(),
            'products' => Product::paginate(10),
        ]);
    }
}

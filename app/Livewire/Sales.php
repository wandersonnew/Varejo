<?php

namespace App\Livewire;

use App\Models\Sale;
use Livewire\Component;
use Mail;
use App\Mail\SendMail;
use App\Models\Product;

class Sales extends Component
{
    public $searchvalue;

    public $itens = [];

    public $saleId
        ,$cliente_id
        ,$data_venda
        ,$total_venda
        ,$cupom_desconto
        ,$total_final
        ,$status;

    public function rules()
    {
        return [
            'cliente_id' => 'required|exists:customers,id',
            'data_venda' => 'required|date',
            'total_venda' => 'required|numeric|min:0',
            'cupom_desconto' => 'nullable|exists:discounts,id',
            'total_final' => 'required|numeric|min:0',
            'status' => 'nullable|string|max:50',
        ];
    }
    
    public function messages() 
    {
        return [
            'cliente_id.required' => 'O cliente é obrigatório.',
            'cliente_id.exists' => 'O cliente selecionado não é válido.',
    
            'data_venda.required' => 'A data da venda é obrigatória.',
            'data_venda.date' => 'A data da venda deve ser uma data válida.',
    
            'total_venda.required' => 'O total da venda é obrigatório.',
            'total_venda.numeric' => 'O total da venda deve ser um número.',
            'total_venda.min' => 'O total da venda não pode ser negativo.',
    
            'cupom_desconto.exists' => 'O cupom de desconto selecionado não é válido.',
    
            'total_final.required' => 'O total final é obrigatório.',
            'total_final.numeric' => 'O total final deve ser um número.',
            'total_final.min' => 'O total final não pode ser negativo.',
    
            'status.string' => 'O status deve ser uma string.',
            'status.max' => 'O status não pode ter mais de 50 caracteres.',
        ];
    }

    public function search()
    {
        $validated = $this->validate([ 
            'searchvalue' => 'required|min:3',
        ]);

        $this->searchvalue = $validated['searchvalue'];
    }

    public function addToCart($id)
    {
        $this->itens = session()->get('itens', []);

        $this->itens[] = $id;

        session()->put('itens', $this->itens);

        session()->flash('message', 'Produto adicionado ao carrinho.');

        return $this->redirect('/sales');
    }

    public function save()
    {
        $validated = $this->validate();

        Sale::create([
            'cliente_id' => $validated['cliente_id'],
            'data_venda'=> $validated['data_venda'],
            'total_venda'=> $validated['total_venda'],
            'cupom_desconto'=> $validated['cupom_desconto'],
            'total_final'=> $validated['total_final'],
            'status'=> $validated['status'],
        ]);

        Mail::to("wandersondrtlvs.new@gmail.com")->send(new SendMail() );

        session()->flash('message', 'Venda cadastrado com sucesso.');

        return $this->redirect('/sales');

    }

    public function render()
    {
        $products = Product::where('nome', 'like', "%{$this->searchvalue}%")
            ->orWhere("descricao","like", "%{$this->searchvalue}%")
            ->paginate(10);

        return view('livewire.sales', [
            'products' => $products,
        ]);
    }
}

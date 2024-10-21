<?php

namespace App\Livewire;

use App\Models\Discount;
use App\Models\Sale;
use App\Models\SaleEmail;
use App\Models\SaleItem;
use Livewire\Component;
use Mail;
use App\Mail\SendMail;
use App\Models\Product;
use App\Models\Customer;
use App\Jobs\SendSaleEmail;

class Sales extends Component
{
    public $searchvalue;

    public $cartItems = [];

    public $saleId
        ,$cliente_id
        ,$data_venda
        ,$total_venda
        ,$cupom_desconto
        ,$total_final
        ,$status;

    public $customer, $cpf;

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
    public function addToCart($cart)
    {
        $productIds = array_map(function($item) {
            return $item['id'];
        }, $cart);

        $products = Product::whereIn('id', $productIds)->get();

        $total = 0;

        foreach ($products as $product) {
            foreach ($cart as $item) {
                if ($item['id'] == $product->id) {
                    $product->quantidade = $item['quantidade'];
                    $total += $product->preco_venda * $product->quantidade;
                }
            }
        }

        $this->cartItems = $products;
        $this->total_venda = $total;
    }

    public function searchCustomer()
    {
        $validated = $this->validate([
            'cpf' => 'required|digits:11',
        ]);

        $this->cpf = $validated['cpf']; 
    }

    public function finishSale($vendaInfo)
    {
        $productIds = array_map(function($item) {
            return $item['id'];
        }, $vendaInfo['cart']);

        $products = Product::whereIn('id', $productIds)->get();

        $desconto = Discount::where('codigo', $vendaInfo['desconto'])->first();

        if($desconto) $calculoDisconto = $vendaInfo['totalVenda'] - ($vendaInfo['totalVenda'] * ($desconto->percentual / 100));
        else $calculoDisconto = $vendaInfo['totalVenda'];



        $sale = Sale::create([
            'cliente_id' => $this->customer->id,
            'data_venda' => now(),
            'total_venda' => $vendaInfo['totalVenda'],
            'cupom_desconto' => $vendaInfo['desconto'], 
            'total_final' => $calculoDisconto,
            'status' => 'Pago',
        ]);

        

        foreach ($vendaInfo['cart'] as $cartItem) {
            $product = $products->where('id', $cartItem['id'])->first();
    
            if ($product) {
                $subtotal = $product->preco_venda * $cartItem['quantidade'];
    
                SaleItem::create([
                    'venda_id' => $sale->id,
                    'produto_id' => $product->id,
                    'quantidade' => $cartItem['quantidade'],
                    'preco_unitario' => $product->preco_venda,
                    'subtotal' => $subtotal,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $saleEmail = SaleEmail::create([
            'venda_id' => $sale->id,
            'email_cliente' => now(),
            'data_envio' => now(),
        ]);

        if ($saleEmail) 
        {
            $host = config('custom.host');
            $port = config('custom.port');
            $url = $host . ':' . $port . '?id=' . $sale->id;
            $orderDetails = [
                'sale' => $sale,
                'link' => $url,
            ];

            // Mail::to($this->customer->email)->queue(new SendMail());
            SendSaleEmail::dispatch($this->customer, $orderDetails);
            // Mail::to($this->customer->email)->queue(new SendMail($this->customer, $orderDetails));
            // Mail::to($this->customer->email)->send(new SendMail($this->customer, $orderDetails));


            session()->flash('message', 'Venda cadastrado com sucesso.');
        } else session()->flash('message', 'Erro ao efetuar venda.');
        return $this->redirect('/sales');

    }

    public function render()
    {

        $products = Product::where('nome', 'like', "%{$this->searchvalue}%")
            ->orWhere("descricao","like", "%{$this->searchvalue}%")
            ->paginate(10);

        $this->customer = Customer::where('cpf', $this->cpf)->first();

        return view('livewire.sales', [
            'products' => $products,
            'customer' => $this->customer,
        ]);
    }
}
<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Customer;
use Livewire\WithPagination;
use App\Jobs\SendSaleEmail;

class Customers extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $customerId, $nome, $email, $cpf, $telefone;

    public function rules()
    {
        return [
            'nome' => 'required|string|min:3|max:50',
            'email' => 'nullable|string|min:13|max:225',
            'telefone' => 'required|string|min:11|max:15',
            'cpf' => 'required|digits:11',
        ];
    }

    public function messages() 
    {
        return [
            'nome.required' => 'O nome é obrigatório.',
            'nome.min' => 'O nome deve ter pelo menos 3 caracteres.',
            'nome.max' => 'O nome deve ter no máximo 50 caracteres.',
            'email.email' => 'O email deve ser um endereço de email válido.',
            'email.max' => 'O email deve ter no máximo 255 caracteres.',
            'telefone.required' => 'O telefone é obrigatório.',
            'telefone.min' => 'O telefone deve ter pelo menos 10 caracteres.',
            'telefone.max' => 'O telefone deve ter no máximo 15 caracteres.',
            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.digits' => 'O CPF deve ter exatamente 11 dígitos.',
        ];
    }

    public function deleteConfirmation(Customer $customer)
    {        
        $customer->delete();
        session()->flash('message','Cliente deletado com sucesso!');
        $this->resetPage();
    }

    public function save()
    {
        $validated = $this->validate();

        if ($this->customerId) {
            $customer = Customer::find($this->customerId);
            $customer->update([
                'nome' => $validated['nome'],
                'email' => $validated['email'],
                'telefone' => $validated['telefone'],
                'cpf' => $validated['cpf'],
            ]);
    
            session()->flash('message', 'Cliente atualizado com sucesso.');
        } else {
            $customer = Customer::create([
                'nome' => $validated['nome'],
                'email' => $validated['email'],
                'telefone' => $validated['telefone'],
                'cpf' => $validated['cpf'],
            ]);

            // SendSaleEmail::dispatch($customer);
    
            session()->flash('message', 'Cliente criado com sucesso.');
        }


        return $this->redirect('/customers');
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);

        // Preenche as propriedades com os dados do produto encontrado
        $this->nome = $customer->nome;
        $this->email = $customer->email;
        $this->telefone = $customer->telefone;
        $this->cpf = $customer->cpf;
        $this->customerId = $customer->id;
    }

    public function resetForm()
    {
        $this->customerId = null;
        $this->nome = '';
        $this->email = '';
        $this->telefone = '';
        $this->cpf = '';
    }

    public function render()
    {
        return view('livewire.customers', [
            'customers' => Customer::paginate(10),
        ]);
    }
}

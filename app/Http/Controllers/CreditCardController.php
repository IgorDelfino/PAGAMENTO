<?php

namespace App\Http\Controllers;

use App\CreditCard;
use Illuminate\Http\Request;
use PagarMe;
use App\Card;

class CreditCardController extends Controller

{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $creditCards = CreditCard::all();

       return response()->json([$creditCards]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create(Request $request)
    // {


    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
    public function store(Request $request)
    {
        
        $creditCard = new CreditCard;

        $creditCard->number = $request->number;
        $creditCard->valid = $request->valid;
        $creditCard->cvv = $request->cvv;
        $creditCard->name = $request->name;
        
        

        $creditCard->save();

        return response()->json( [ $creditCard]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CreditCard  $creditCard
     * @return \Illuminate\Http\Response
     */
    public function show(CreditCard $creditCard)
    {
        // $card =Card::findOrFail()
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CreditCard  $creditCard
     * @return \Illuminate\Http\Response
     */
    public function edit(CreditCard $creditCard)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CreditCard  $creditCard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $creditCard= CreditCard::findOrFail($id);

        if ($request->number){
            $creditCard->number = $request->number;
        }

        if ($request->valid){
            $creditCard->valid = $request->valid;
        }

        if($request->cvv){
            $creditCard->cvv = $request->cvv;
        }

        if($request->name){
            $creditCard->name= $rrequest->name;
        }

        $creditCard->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CreditCard  $creditCard
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $creditCard = CreditCard::findOrFail($id);

        $creditCard = CreditCard::destroy($id);

        return response()->json('Credit Card  destroyed');
    }
    
    public function subscription(){
        $pagarme = new PagarMe\Client('ak_test_eBXEmnZjfEEZttihpSaHdbh3VJjmPA');

        $subscription = $pagarme->subscriptions()->create([
        'plan_id' => 123456,
        'payment_method' => 'credit_card',
        'card_cvv' => '316',
        'card_number' => '5191421129442442',
        'card_expiration_date' => '0322',
        'card_holder_name' => 'isabella vitoria ',
        'postback_url' => 'http://postbacj.url',
        'customer' => [
            'email' => 'time@unix.com',
            'name' => 'Unix Time',
            'document_number' => '75948706036',
            'address' => [
            'street' => 'Rua de Teste',
            'street_number' => '100',
            'complementary' => 'Apto 666',
            'neighborhood' => 'Bairro de Teste',
            'zipcode' => '11111111'
            ],
            'phone' => [
            'ddd' => '01',
            'number' => '923456780'
            ],
            'sex' => 'other',
            'born_at' => '1970-01-01',
        ],
        'metadata' => [
            'foo' => 'bar'
        ]
        ]);
        return response()->json([$subscription]);
 
    }

    public function transaction(){
        //inicializamos o client
        $pagarme = new PagarMe\Client('ak_test_eBXEmnZjfEEZttihpSaHdbh3VJjmPA');//aqui vc coloca o nome da variavel do .env
        
        $transaction = $pagarme->transactions()->create([
        'amount' => 1000,
        'payment_method' => 'credit_card',
        'card_holder_name' => 'Anakin Skywalker',
        'card_cvv' => '316',
        'card_number' => '5191421129442442',
        'card_expiration_date' => '0322',
        'customer' => [
            'external_id' => '1',
            'name' => 'Nome do cliente',
            'type' => 'individual',
            'country' => 'br',
            'documents' => [
              [
                'type' => 'cpf',
                'number' => '01568128002'
              ]
            ],
            'phone_numbers' => [ '+551199999999' ],
            'email' => 'cliente@email.com'
        ],
        'billing' => [
            'name' => 'Nome do pagador',
            'address' => [
              'country' => 'br',
              'street' => 'Avenida Brigadeiro Faria Lima',
              'street_number' => '1811',
              'state' => 'sp',
              'city' => 'Sao Paulo',
              'neighborhood' => 'Jardim Paulistano',
              'zipcode' => '01451001'
            ]
        ],
        'shipping' => [
            'name' => 'Nome de quem receberá o produto',
            'fee' => 1020,
            'delivery_date' => '2018-09-22',
            'expedited' => false,
            'address' => [
              'country' => 'br',
              'street' => 'Avenida Brigadeiro Faria Lima',
              'street_number' => '1811',
              'state' => 'sp',
              'city' => 'Sao Paulo',
              'neighborhood' => 'Jardim Paulistano',
              'zipcode' => '01451001'
            ]
        ],
        'items' => [
            [
              'id' => '1',
              'title' => 'R2D2',
              'unit_price' => 300,
              'quantity' => 1,
              'tangible' => true
            ],
            [
              'id' => '2',
              'title' => 'C-3PO',
              'unit_price' => 700,
              'quantity' => 1,
              'tangible' => true
            ]
        ]
        ]);
        return response()->json([$transaction]);
    }
  
    // public function criarCartao(){
    //     $pagarme = new PagarMe\Client('ak_test_eBXEmnZjfEEZttihpSaHdbh3VJjmPA');
    //     $customer = $pagarme->customers()->create([
    //         'external_id' => '#123456789',
    //         'name' => 'João das Neves',
    //         'type' => 'individual',
    //         'country' => 'br',
    //         'email' => 'joaoneves@norte.com',
    //         'documents' => [
    //         [
    //             'type' => 'cpf',
    //             'number' => '18476641729'
    //         ]
    //         ],
    //         'phone_numbers' => [
    //         '+5511999999999',
    //         '+5511888888888'
    //         ],
    //         'birthday' => '1985-01-01'
    //     ]);
    //     return response()->json([$customer]);;
    // }
}

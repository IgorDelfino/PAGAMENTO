<?php

namespace App\Http\Controllers;

use App\CreditCard;
use Illuminate\Http\Request;
use PagarMe;


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
        $creditCard->valid = $request->validad;
        $creditCard->cvv = $request->cvv;
        $creditCard->name = $request->name;
        $creditCard->user_id= $request->user_id;
        $creditCard->card_hash= $request->card_hash;

        $creditCard->save();

        return response()->json(  $creditCard]);
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

    public function transaction(){
        //inicializamos o client
        $pagarme = new PagarMe\Client(env('PAGAR_ME_API_KEY'));//aqui vc coloca o nome da variavel do .env
        
        $transaction = $pagarme->transactions()->create([
        'amount' => 1000,
        'payment_method' => 'credit_card',
        'card_holder_name' => 'Anakin Skywalker',
        'card_cvv' => '905',
        'card_number' => '5191421139442442',
        'card_expiration_date' => '0522',
        'customer' => [
            'external_id' => '1',
            'name' => 'Nome do cliente',
            'type' => 'individual',
            'country' => 'br',
            'documents' => [
              [
                'type' => 'cpf',
                'number' => '12484104758'
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
        return response()->json([$transaction]);;
    }
}

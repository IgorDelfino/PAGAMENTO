<?php

namespace App\Http\Controllers;

use App\CreditCard;
use Illuminate\Http\Request;
 use PagarMe;

// require("vendor/autoload.php");
class CreditCardController extends Controller

{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
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
       
    }
    // public function createCard(Request $request){
    //     $card = New Card;
    //     $card->newCard($request);
    //     //return response()->json($teste);
    //     return response()->json($card);
    // }
    public function createCard(Request $request){
      
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CreditCard  $creditCard
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
    
    // public function subscription(){
    //     $pagarme = new PagarMe\Client('ak_test_eBXEmnZjfEEZttihpSaHdbh3VJjmPA');

    //     $subscription = $pagarme->subscriptions()->create([
    //     'plan_id' => 123456,
    //     'payment_method' => 'credit_card',
    //     'card_cvv' => '316',
    //     'card_number' => '5191421129442442',
    //     'card_expiration_date' => '0322',
    //     'card_holder_name' => 'isabella vitoria ',
    //     'postback_url' => 'http://postbacj.url',
    //     'customer' => [
    //         'email' => 'time@unix.com',
    //         'name' => 'Unix Time',
    //         'document_number' => '75948706036',
    //         'address' => [
    //         'street' => 'Rua de Teste',
    //         'street_number' => '100',
    //         'complementary' => 'Apto 666',
    //         'neighborhood' => 'Bairro de Teste',
    //         'zipcode' => '11111111'
    //         ],
    //         'phone' => [
    //         'ddd' => '01',
    //         'number' => '923456780'
    //         ],
    //         'sex' => 'other',
    //         'born_at' => '1970-01-01',
    //     ],
    //     'metadata' => [
    //         'foo' => 'bar'
    //     ]
    //     ]);
    //     return response()->json([$subscription]);
 
    // }
    
    public function transacao(){
        //inicializamos o client
        $pagarme = new PagarMe\Client('ak_test_eBXEmnZjfEEZttihpSaHdbh3VJjmPA');//aqui vc coloca o nome da variavel do .env
        
        $transaction = $pagarme->transactions()->create([
        'amount' => 1000,
        'payment_method' => 'credit_card',
        'card_holder_name' => 'Anakin Skywalker',
        'card_cvv' => '844',
        'card_number' => '5405305853900010',
        'card_expiration_date' => '0422',
        'customer' => [
            'external_id' => '1',
            'name' => 'Nome do cliente',
            'type' => 'individual',
            'country' => 'br',
            'documents' => [
              [
                'type' => 'cpf',
                'number' => '33586078013'
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
       
        'items' => [
            [
              'id' => '1',
              'title' => 'R2D2',
              'unit_price' => 300,
              'quantity' => 1,
              'tangible' => false
            ],
            [
              'id' => '2',
              'title' => 'C-3PO',
              'unit_price' => 700,
              'quantity' => 1,
              'tangible' => false
            ]
          ],
          'split_rules' => [
            [
              'liable' => true,
              'charge_processing_fee'=> true,
              'percentage' => '20',
              'charge_remainder_fee' => false,
              'recipient_id' => 're_ckb5ji1570u1qs66evriuxocj'
            ],
            [
              'liable' => true,
              'charge_processing_fee'=> true,
              'percentage' => '80',
              'charge_remainder_fee' => false,
              'recipient_id' => 're_ckb5ns9sd0iu8dq6evxknkucg'
            ]
              
            
          ]

        ]);
        return response()->json([$transaction]);
    }
    public function recebedor(){

      $pagarme = new PagarMe\Client('ak_test_eBXEmnZjfEEZttihpSaHdbh3VJjmPA');

     $recipient = $pagarme->recipients()->create([
      'anticipatable_volume_percentage' => '85', 
      'automatic_anticipation_enabled' => 'true', 
      
      'transfer_day' => '5', 
      'transfer_enabled' => 'true', 
      'transfer_interval' => 'monthly',
      'bank_account' => [
        'bank_code' =>'341',
        'agencia' =>'3196',
        'agencia_dv' =>'1',
        'conta' =>'31696',
        'conta_dv' =>'6',
        'type' => 'conta_corrente',
        'document_number' =>'71128197090',
        'legal_name' =>'fulano'
        

      ]
    ]);
    return response()->json([$recipient]);
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

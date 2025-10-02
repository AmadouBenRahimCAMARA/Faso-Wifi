<?php

function Payin_with_redirection($transaction_id,$amount){

    $url = App::make('url')->to('/');
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://app.ligdicash.com/pay/v01/redirect/checkout-invoice/create",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS =>'
					  {
					  "commande": {
						"invoice": {
						  "items": [
							{
							  "name": "Nom de article ou service ou produits",
							  "description": "Description du service ou produits",
							  "quantity": 1,
							  "unit_price": "'.$amount.'",
							  "total_price": "'.$amount.'"
							}
						  ],
						  "total_amount": "'.$amount.'",
						  "devise": "XOF",
						  "description": "Descrion de la commande des produits ou services",
						  "customer": "",
						  "customer_firstname":"Prenom du client",
						  "customer_lastname":"Nom du client",
						  "customer_email":"tester@ligdicash.com"
						},
						"store": {
						  "name": "Rencontre B2B",
						  "website_url": "http://localhost/erencci"
						},
						"actions": {
						  "cancel_url": "'.$url.'/status",
						  "return_url": "'.$url.'/status",
						  "callback_url": "'.$url.'/status"
						},
						"custom_data": {
						  "transaction_id": "'.$transaction_id.'"
						}
					  }
					}',
        CURLOPT_HTTPHEADER => array(
            "Apikey: MAGPMLT3QFJLIPUDN",
            "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZF9hcHAiOjE0MDUwLCJpZF9hYm9ubmUiOjMzNjI3NSwiZGF0ZWNyZWF0aW9uX2FwcCI6IjIwMjQtMDQtMDggMDg6MzI6MjQifQ.We4hEwsqnFzauZzKQBUE6Lh-Un2rVaoXYkhj_NdKX4E",
            "Accept: application/json",
            "Content-Type: application/json"
        ),

    ));

    $response = json_decode(curl_exec($curl));
    //dd($response);
    curl_close($curl);
    return $response;
}


//XXXXXXXXXXXXXXXX-EXECUTION DES METHODES-XXXXXXXXXXXXXXXXXXXXXXX

/*
 En cas de reclamation ou de besoin de correction ou verrification d'une transaction,
 vous pouvez rappeler la transaction en recuperant le token par session ou depuis votre DB ou par variable $_GET['token']
 Raison pour laquel vous devez stocker le 'invoiceToken=' de votre transaction client dans votre base de données historique transaction ou en variable SESSION
 On suppose que le 'invoiceToken=' est recuperé par exemple
*/
//echo $_GET['token'];
//$invoiceToken=$_GET['token'];

session_start();
//XXXXXXXXXXXXXXXX-EXECUTION DES METHODES-XXXXXXXXXXXXXXXXXXXXXXX
$transaction_id='FW'.date('Y').date('m').date('d').'.'.date('h').date('m').'.C'.rand(5,100000);
$amount= $tarif->montant;

//$amount=$_GET['option']*1.035;
$redirectPayin =Payin_with_redirection($transaction_id,$amount);

//vous pouvez decommenter print_r($response) pour voir les resultats vour la documentationV1.2
//print_r($redirectPayin);exit;
//echo $redirectPayin->response_text;exit;
//echo $redirectPayin->token;exit;//Ce token doit etre enregistrer dans votre base de donne trasction client pour vos verrification de status apres paiement
//$_SESSION['invoiceToken']=$redirectPayin->token;//Vous devez stoker ce TOKEN pour de verrification de status ulterieur
//$_SESSION['idParticipant']=$_GET['id'];//On recupere l'identifiant du participant
//$_SESSION['idForum']=$_GET['f'];//On recupere l'identifiant du forum
$_SESSION['total']=$amount;//On recupere le total
//$_SESSION['montant']=$_GET['option'];//On recupere le montant
$_SESSION['tid']=$transaction_id;//On recupere l'identifiant transaction

$ticket = App\Models\Ticket::where([
  "etat_ticket" => "EN_VENTE",
  "tarif_id" => $tarif->id
])->first();//$tarif->tickets()->where("etat_ticket","EN_VENTE")->first()->id;

if($ticket){
  $_SESSION['ticket_id'] = $ticket->id;
}else{
  // Aucun ticket disponible : redirection vers la page ticket non disponible
  header('Location: '.App::make('url')->to('/'));
  exit;
}
//dd($redirectPayin);

if(isset($redirectPayin->response_code) and $redirectPayin->response_code=="00") {
    //$redirectPayin->response_text contient l'url de redirection
    $_SESSION['invoiceToken']=$redirectPayin->token;
    header('Location: '.$redirectPayin->response_text);
    print_r($redirectPayin->response_code);exit;
}
else{
  //dd($redirectPayin);
    echo 'response_code='.$redirectPayin->response_code;
    echo '<br><br>';
    echo 'response_text='.$redirectPayin->response_text;
    echo '<br><br>';
    echo 'description='.$redirectPayin->description;
    echo '<br><br>';
    echo '<br><br>Veuillez lire la documentation et le WIKI subcodes[]';
    exit;
}

?>



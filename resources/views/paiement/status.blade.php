<?php

//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

function StatusPayin($invoiceToken)
{
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://app.ligdicash.com/pay/v01/redirect/checkout-invoice/confirm/?invoiceToken=' . $invoiceToken,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => [
            "Apikey: MAGPMLT3QFJLIPUDN",
            "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZF9hcHAiOjE0MDUwLCJpZF9hYm9ubmUiOjMzNjI3NSwiZGF0ZWNyZWF0aW9uX2FwcCI6IjIwMjQtMDQtMDggMDg6MzI6MjQifQ.We4hEwsqnFzauZzKQBUE6Lh-Un2rVaoXYkhj_NdKX4E",
    ]]);
    $response = json_decode(curl_exec($curl));
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
$invoiceToken = $_SESSION['invoiceToken'];
//$idcompte=$_SESSION['idForum'];
//$idparticipant=$_SESSION['idParticipant'];
$_SESSION['first_time'] = 1;
$montant=$_SESSION['total'];
$total = $_SESSION['total'];
$tid = $_SESSION['tid'];
$ticket_id = $_SESSION['ticket_id'];

$ticket = App\Models\Ticket::find($ticket_id);


$Payin = StatusPayin($invoiceToken);


if (isset($Payin)) {

    if (trim($Payin->status) == 'completed') {

        echo 'Le client(Payer) a validé le paiement vous devez executé vos traitements apres paiement valide<br><br>';
        //print_r($Payin);
        //dd($Payin);
        $from_data = [
            'transaction_id' => $tid,
            'ticket_id' => $ticket_id,
            //'date'   =>  date('d/m/Y'),
            //'montant'   =>  $montant,
            'numero' => $Payin->customer,
            'slug' => Illuminate\Support\Str::random(10),
            /*'total'   =>  $total,
            'frais'   =>  ($total - $montant),
            'tel_paiement'   =>  $Payin->customer,
            'nom_paiement'   =>  $participant->nomPart,
            'prenom_paiement'   =>  $participant->prenomPart,*/
            //'nom_recep'   =>  "",
            //'prenom_recep'   =>  "",
            /*'etat'   =>  $Payin->status,
             'operator_id'   =>  $Payin->operator_id,*/
            'moyen_de_paiement' => $Payin->operator_name,
            /*'token_d'   =>  $invoiceToken,
             'token_r'   =>  $invoiceToken*/
        ];

        $_SESSION['paiement'] = serialize($from_data);

        //\Session::flash('success','Paiement effectué avec succès !!!');
        //include('recu.blade.php');
        header('Location: '.App::make('url')->to('/').'/acheter-mon-ticket/recu/'.$ticket->slug);
        exit;
        echo "ok";
        //return view('paiement.recu');
        //echo 'status='.$Payin->status;;
        //echo '<br><br>';
        //echo 'response_text='.$Payin->response_text;
    } elseif (trim($Payin->status) == 'nocompleted') {
        //return view('client.index');

        echo 'Le client(Payer) a annulé le paiement donc vous devez executer vos traitements correspondant<br><br>';
        //print_r($Payin);
        echo 'status=' . $Payin->status;
        echo '<br><br>';
        echo 'response_text=' . $Payin->response_text;
    } elseif (trim($Payin->status) == 'pending') {
        //return view('client.index');
        echo "Le client(Payer) n'a pas encore validé le paiement mobile money,donc vous devez executer vos traitements correspondant<br><br>";
        //print_r($Payin);
        echo 'status=' . $Payin->status;
        echo '<br><br>';
        echo 'response_text=' . $Payin->response_text;
    } else {
        //return view('client.index');

        echo '<br><br>Veuillez lire la documentation et le WIKI subcodes[]<br>';
        print_r($Payin);
    }
} else {
    return false;
}

?>

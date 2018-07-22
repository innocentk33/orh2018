<?php
/**
 * Created by PhpStorm.
 * User: Morningstar
 * Date: 30/01/2018
 * Time: 21:57
 */

try{

$destinataire = 'jocelindegni@gmail.com';
$envoyeur	='hostlocal07@gmail.com';
$sujet = 'Email de test';
$message = "Bonjour !\r\nCeci est un email de test.\r\n";
$headers = 'From: '.$envoyeur . "\r\n" .
    'Reply-To: '.$envoyeur. "\r\n" .
    'X-Mailer: PHP/' . phpversion();
$envoye = mail($destinataire, $sujet, $message, $headers);

echo $envoye;


} catch (Exception $e) {
// En cas d'erreur précédemment, on affiche un message
die('Erreur : '.$e->getMessage());
}

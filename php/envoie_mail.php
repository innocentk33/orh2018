<?php
/**
 * Created by PhpStorm.
 * User: Morningstar
 * Date: 30/01/2018
 * Time: 21:18
 */

//fonction pour envoyer mail contenant du html
function envoyer_mail($envoyeur,$destinataire,$sujet){
    $header = "MIME-Version: 1.0\r\n"; //lorsqu'on envoie du html
    $header .= 'From:"@localhost"<' . $envoyeur.'>' . "\n";
    $header .= 'Content-Type:text/html; charset="uft-8"' . "\n";
    $header .= 'Content-Transfer-Encoding: 8bit';

    $message = '
    <html>
        <body>
            <div align="center">
                 "Bonjour !\r\nCeci est un email de test.\r\n"
            </div>
        </body>
    </html>
    ';

    mail($destinataire, $sujet, $message, $header);
}

$envoyeur="jocelindegni@gmail.com";
$destinataire="decancun18@gmail.com";
$sujet="test fonction";
envoyer_mail($envoyeur,$destinataire ,$sujet );
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"
    <html lang="de">
     <head>
         <title>Freies Magazin E-Mail Registrierung</title>
     <link href="style.css" type="text/css" rel="stylesheet" />
     <meta charset="UTF-8">
     </head>
     <body>
     <!-- start header div -->
             <div id="header">
                 <h3>Freies Magazin Registrierung</h3>
             </div>
             <div id="wrap">
<?php

/*
    This file is part of Freies Magazin email distribution software.

    Freies Magazin email distribution software is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Freies Magazin email distribution software is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Freies Magazin email distribution software.  If not, see <http://www.gnu.org/licenses/>
*/     
     require_once('db.php');
$db = new DB();
$str = $_SERVER['QUERY_STRING'];
if (strlen($str)) {
    parse_str($str);
    $db->insert($email, $zf != 'PDF');
    $msg = sprintf('<center>Ihre E-Mail-Adresse %s wurde für die monatliche Zustellung des freien Magazins gespeichert.<br><br>br>Die nächste
Aushabe wird Ihnen Anfang des kommenden Monats per E-Mail zugestellt<br><br><br>Vielen Dank für Ihre Registrierung!</center>', $email);
} else {
    $email = $_POST['email'];
    $epub = $_POST['zf'];
    if ($db->check($email)) {
        $msg = 'Diese E-Mail-Adresse wurde bereits registriert.';
    } else {
        $text = sprintf("Vielen Dank für die Anmeldung des E-Mail-Verteilers des freien Magazins.\r\n\r\nBitte klicken Sie auf http://www.monochromec.com/fm/conf.php?email=%s&zf=%s um die Registrierung abzuschließen.\r\n\r\n       Viele Grüße,\r\n           Ihre Verteiler-Verwaltung", $email, $epub);
        $head = "From: <monochromec@monochromec.com>\r\n";
        $head .= 'MIME-Version: 1.0' . "\r\n" . 'Content-type: text/plain; charset=UTF-8' . "\r\n";
        mail($email, 'freies Magazin Registrierung', $text, $head);
        $msg = 'Eine E-Mail für die weitere Bestätigung wurde an die angebene Adresse geschickt.';
    }
}
printf('<h4>%s</h4>', $msg);
include './mail.php';
?>

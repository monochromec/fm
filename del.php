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
<div class="watermark">
         Beta
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
$str = $_POST['email'];
$msg = file_get_contents('./mail.php');
if (strlen($str)) {
    $db->delete($str);
    printf('<h4><center>Ihre E-Mail-Adresse %s wurde erfolgreich von dem monatlichen Verteiler des freienMagazins entfernt.</center></h4>', $email);
    echo $msg;
} else {
    exit('<h3>Interner Fehler - bitte kontaktieren Sie den Administrator unter der unten angegebenen E-Mail-Adresse!</h3><br>' . $msg);
}
?>

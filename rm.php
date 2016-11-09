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
                 <h3>Freies Magazin Verteiler-Löschung</h3>
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

$str = $_SERVER['QUERY_STRING'];
$msg = file_get_contents('./mail.php');
if (strlen($str)) {
//    parse_str($str;  
    printf('<h4>Sind Sie sicher, daß Sie die Adresse %s vom Verteiler löschen wollen? Bitte bestätigen Sie dieses entsprechend!</h4><br>', $str);
?>
              <form name="form" action="del.php" method="post">
<?php
    printf('<input name="email" value="%s" type="hidden">', $str);
?>    
     <center>
         <input type="submit" class="submit_button" value="Bestätigen!"/>
     </center>
     </form>
<?php
    echo $msg;
} else {
    exit('<h3>Interner Fehler - bitte kontaktieren Sie den Administrator unter der unten angegebenen E-Mail-Adresse!</h3><br>' . $msg);
}
?>

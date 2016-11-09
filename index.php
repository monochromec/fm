<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"
    <html lang="de">
     <head>
         <title>freies Magazin E-Mail Registrierung</title>
     <link href="style.css" type="text/css" rel="stylesheet" />
     <meta charset="UTF-8">
     <script type="text/javascript">
     function checkEmail(emailAddress) {
         var sQtext = '[^\\x0d\\x22\\x5c\\x80-\\xff]';
         var sDtext = '[^\\x0d\\x5b-\\x5d\\x80-\\xff]';
         var sAtom = '[^\\x00-\\x20\\x22\\x28\\x29\\x2c\\x2e\\x3a-\\x3c\\x3e\\x40\\x5b-\\x5d\\x7f-\\xff]+';
         var sQuotedPair = '\\x5c[\\x00-\\x7f]';
         var sDomainLiteral = '\\x5b(' + sDtext + '|' + sQuotedPair + ')*\\x5d';
         var sQuotedString = '\\x22(' + sQtext + '|' + sQuotedPair + ')*\\x22';
         var sDomain_ref = sAtom;
         var sSubDomain = '(' + sDomain_ref + '|' + sDomainLiteral + ')';
         var sWord = '(' + sAtom + '|' + sQuotedString + ')';
         var sDomain = sSubDomain + '(\\x2e' + sSubDomain + ')*';
         var sLocalPart = sWord + '(\\x2e' + sWord + ')*';
         var sAddrSpec = sLocalPart + '\\x40' + sDomain; // complete RFC822 email address spec
         var sValidEmail = '^' + sAddrSpec + '$'; // as whole string

         var reValidEmail = new RegExp(sValidEmail);

         return reValidEmail.test(emailAddress);
     }
     function check() {
         adr = document.forms['form']['email'].value;
         chk = checkEmail(adr);
         if (! chk) {
             window.alert('Bitte geben Sie eine gültige E-Mail Addresse ein!');
         }
         return chk;
     }
     </script>
     </head>
<body>
<div class="watermark">
         Beta
         </div>
     <!-- start header div -->
             <div id="header">
                 <h3>freies Magazin Registrierung</h3>
             </div>
             <!-- end header div -->

             <!-- start wrap div -->
             <div id="wrap">
                 <!-- title and description -->
                 <h3>Registrierungs-Formular für die Zustellung des <a href="http://www.freiesmagazin.de" target=_blank>freien Magazins</a> per E-Mail</h3>
     <p>Bitte geben Sie Ihre E-Mail Adresse ein und wählen Sie das gewünschte Zustellformat:<p>

                 <!-- start sign up form -->
         <form name="form" action="conf.php" method="post" onsubmit="return check();">
     <table>
     <tr><td>
         Email:
     </td><td>
     <input type="text" name="email" size=45 value=""/>
     </td></tr><tr><td>
     Zustellformat: 
     </td><td>
     <input type="radio" name="zf" value="PDF" checked/> PDF
     <input type="radio" name="zf" value="EPUB"/> EPUB
     </td></tr></table>
     <center>
         <input type="submit" class="submit_button" value="Abschicken!"/>
     <center>
     </form>
     </div>
     <!-- end wrap div -->
</body>
</html>
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

// Create DB if not present
   require_once('db.php');
   $db = new DB();
?>

#!/bin/bash

# This file is part of Freies Magazin email distribution software.

# Freies Magazin email distribution software is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.

# Freies Magazin email distribution software is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.

# You should have received a copy of the GNU General Public License
# along with Freies Magazin email distribution software.  If not, see <http://www.gnu.org/licenses/>This file is part of Freies Magazin email distribution software.

# Freies Magazin email distribution software is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.

# Freies Magazin email distribution software is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.

# You should have received a copy of the GNU General Public License
# along with Freies Magazin email distribution software.  If not, see <http://www.gnu.org/licenses/>

ADR=`dirname $0`/adr.db
D=$(date +%Y-%m)
EPUBF=freiesMagazin-$D-bilder.epub
PDFF=freiesMagazin-$D.pdf
wget -NP ~/tmp http://www.freiesmagazin.de/ftp/$(date +%Y)/$PDFF
wget -NP ~/tmp http://www.freiesmagazin.de/ftp/$(date +%Y)/$EPUBF
for i in 0 1; do
    for j in $(sqlite3 $ADR "SELECT email FROM adr WHERE active=1 AND epub=$i"); do
	if [ $i -eq 1 ]; then F=$EPUBF; else F=$PDFF; fi
	F=~/tmp/$F
	A="Hallo $j,"$'\n'$'\n'
	if [ -r $F ] ; then
			    A+="Anbei aufgrund Ihrer Registrierung für die E-Mail Zustellung des freien Magazins im Anhang die monatliche 
Ausgabe im bestellten Format. 

Zum Abbestellen klicken Sie bitte auf folgenden Link: http://www.monochromec.com/fm/rm.php?$j.

Bei Fragen, Anmerkungen oder Hinweisen würden wir uns über eine E-Mail an monochromec@monochromec.com freuen!"
	    P="-a $F"
	else
	    P=""
	    A+="


Leider konnte das freie Magazin diesen Monat nicht heruntergeladen werden"
	fi
	A+="

            Viele Grüße,
               Ihre Verteiler-Verwaltung"
	echo "$A" | heirloom-mailx $P -r monochromec@monochromec.com -s "freies Magazin $D" $j
    done
done

rm ~/tmp/freiesMagazin-$D*

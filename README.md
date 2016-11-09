# fm
Freies Magazin source code

This repository contains a simple email-based subscription administration system
originally developed for the German open source magazine "Freies Magazin" before
its ultimate demise at the end of 2016. 

The source code is licensed unter GPL v3 in the hope that it may be useful. Feel
free to check out, learn and improve.

Software prereqs:

- wget
- heirloom mailer frontend
- Sqlite3 and php driver for this DB

The workflow is as follows: upon first invocation, a requestor has the opportunity
to enter his email address and select the delivery format (EPUB or PDF) after which an email
is sent to the address supplied containing a confirmation link. Once this 
email address has been confirmed, the Freies Magazin is sent once a month
in the requested format via email. These emails also contains a removal link
for the discontinuation of the subscription upon confirmation of this removal.

The individual files contain the following functionality:

conf.php: Subscription confirmation after successful registration
db.php: SQLite-based DB handling class including methods to enter records, delete them and check for their presence
del.php: Removal confirmation 
index.php: Landing page including the entry form (along with some client-side validation code)
mail.php: Email header for inclusion purposes
rm.php: Removal confirmation page
sendFM.sh: Bash script for the retrieval
style.css: Global style sheet for all pages

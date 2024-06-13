POSTAVLJANJE:


Pokretanje XAMPP-a:

	Otvorite XAMPP i pokrenite Apache i MySQL usluge.

Kopiranje datoteka:

	Unutar XAMPP mape (npr. C:\xampp\htdocs\, ili prema vašoj instalaciji), zalijepite mapu s datotekama projekta.

Postavljanje baze podataka:

	Otvorite web preglednik i idite na phpMyAdmin (http://localhost/phpmyadmin/).
	Kreirajte novu bazu podataka.
	Kliknite na novu bazu, zatim u navigaciji odaberite "Import".
	Importirajte bazu podataka iz datoteke projekt.sql, koja se nalazi u mapi projekta.

Pokretanje stranice:

	U pregledniku idite na: http://localhost/tomislav_vrhovski_projekt/index.php kako biste isprobali web stranicu.



-------------------------------------------------------------------------

KORIŠTENJE:

Struktura stranica:

	U mapi projekta nalaze se slike clanak.png i pocetna.png, koje prikazuju strukturu stranica.
	Svaka stranica sadrži header, body i footer. Header i footer su isti na svim stranicama, dok se sadržaj (body) mijenja.

Početna stranica:

	Body početne stranice sadrži dvije kategorije vijesti, svaka s po tri članka.
	Klikom na članak otvara se nova stranica s člancima iz odabrane kategorije.

Administracija stranice:

	Stranica omogućava prijavu (login) s korisničkim računima.
	Postoje dva seta korisničkih podataka:
		Administrator: usr: admin, pass: admin (ima prava uređivanja i brisanja članaka).
		Korisnik: usr: user, pass: user (nema administratorska prava).
	Administratori mogu uređivati i brisati članke.

Unos novih članaka:

	Stranica za unos novih članaka omogućava dodavanje članaka u bazu podataka. Forma ima postavljene uvjete za validaciju.

Registracija novih korisnika:

	Na stranici za registraciju moguće je unijeti nove korisnike. Forma također sadrži uvjete za validaciju unosa.


To je to ;)
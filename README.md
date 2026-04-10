Student Database Management System
Overzicht

Dit is een veilig studentendatabasebeheersysteem gebouwd met PHP en MySQL. De applicatie stelt geauthenticeerde beheerders in staat om studentgegevens te beheren met volledige CRUD-functionaliteit (Create, Read, Update, Delete). Het bevat uitgebreide beveiligingsmaatregelen om SQL-injectieaanvallen te voorkomen en ondersteunt rolgebaseerde toegangscontrole.

Functies
Gebruikersauthenticatie: Veilig inlogsysteem voor beheerders
Studentbeheer:
Nieuwe studenten toevoegen aan de database
Studentgegevens zoeken en bekijken
Studentinformatie bewerken
Studentgegevens verwijderen
Rolgebaseerde toegangscontrole: Verschillende weergaven voor ingelogde en niet-ingelogde gebruikers
Beveiliging:
Prepared statements om SQL-injectie te voorkomen
Invoervalidatie voor alle gebruikersinvoer
Sessiebeheer met automatisch uitloggen
Wachtwoordbeveiliging voor beheeracties
Gebruiksvriendelijke interface: Responsief ontwerp gebaseerd op Bootstrap
Gegevensprivacy: Gevoelige informatie alleen zichtbaar voor ingelogde beheerders
Systeemvereisten
PHP 7.4 of hoger
MySQL 5.7 of hoger
XAMPP of vergelijkbare lokale ontwikkelomgeving
Moderne webbrowser
Installatie
Plaats de projectmap in C:\xampp\htdocs\Eenvoudige_Database\Eindopdracht\ (of vergelijkbaar op jouw server)
Maak een MySQL-database aan met de naam studenten_db
Maak de tabel studenten met de volgende structuur:
StudentID (INT, Primary Key, Auto Increment)
Voornaam (VARCHAR 50)
Achternaam (VARCHAR 50)
Geboortedatum (DATE)
Geslacht (VARCHAR 10)
Email (VARCHAR 100)
Studierichting (VARCHAR 100)
StudieStatus (VARCHAR 20)
Startjaar (INT)
Start je lokale server (XAMPP)
Ga naar http://localhost/Eenvoudige_Database/Eindopdracht/paginas/login.php
Inloggegevens
Gebruikersnaam: admin
Wachtwoord: 1234
Gebruik
Voor eerste gebruikers (niet-beheerder)
Ga naar de inlogpagina
Klik op "Doorgaan zonder in te loggen" om studentgegevens te bekijken
Je ziet een beperkte weergave met alleen basisinformatie
Toevoegen, bewerken of verwijderen is niet beschikbaar
Voor beheerders
Ga naar de inlogpagina
Vul gebruikersnaam admin en wachtwoord 1234 in
Klik op "Inloggen"
Je wordt doorgestuurd naar de hoofdpagina
Hoofdfuncties (alleen beheerder)
Studenten zoeken
Gebruik de zoekbalk om studenten te vinden op:
Voornaam
Achternaam
StudentID
Klik op "Zoeken" om resultaten te tonen
Nieuwe student toevoegen
Klik op "Voeg student toe"
Vul het formulier in met:
Voornaam (verplicht)
Achternaam (verplicht)
Geboortedatum (verplicht, formaat YYYY-MM-DD)
Geslacht (verplicht)
Email (verplicht, domein @student.kw1c.nl wordt automatisch toegevoegd)
Studierichting (verplicht)
Klik op "Voeg student toe" om op te slaan
Startjaar wordt automatisch ingesteld op 2026
Student bewerken
Zoek een student of bekijk deze in de tabel
Klik op "Bewerk"
Pas de gewenste velden aan
Klik op "Bewerking opslaan"
Het formulier wordt herladen met de bijgewerkte gegevens
Student verwijderen
Zoek een student of bekijk deze in de tabel
Klik op "Verwijder"
Bevestig de verwijdering in het pop-upvenster
De student wordt permanent verwijderd uit de database
Sessiebeheer
Sessies verlopen automatisch wanneer je de browser sluit
Beheerders worden automatisch uitgelogd bij het sluiten van de pagina
Voor handmatig uitloggen: sluit de browser of het tabblad
Uitleg van gegevensvelden
Veld	Beschrijving
StudentID	Unieke identificatie voor elke student
Voornaam	Voornaam
Achternaam	Achternaam
Geboortedatum	Geboortedatum (YYYY-MM-DD)
Geslacht	Geslacht (Man, Vrouw, Anders)
Email	E-mailadres (@student.kw1c.nl)
Studierichting	Opleiding (bijv. ICT, Verpleegkunde, etc.)
StudieStatus	Huidige status (Actief, Gestopt, Afgestudeerd)
Startjaar	Startjaar studie (momenteel 2026)
Beschikbare studierichtingen
Verpleegkunde
Logistiek
Toerisme
ICT
Autotechniek
Bouwkunde
Maatschappelijke Zorg
Onderwijsassistent
Economie
Marketing
Beveiligingsfuncties
Bescherming tegen SQL-injectie
Alle databasequery’s gebruiken prepared statements met parameterbinding
Gebruikersinvoer wordt nooit direct in SQL-query’s geplaatst
Invoervalidatie
E-mailadressen worden gecontroleerd op correct formaat
Datums moeten in YYYY-MM-DD-formaat zijn
Tekstinvoer wordt gecontroleerd op geldige tekens (letters, cijfers, spaties, standaard leestekens)
Numerieke invoer wordt gevalideerd
Maximale lengtes worden afgedwongen
Sessie-beveiliging
PHP-sessies worden gebruikt voor authenticatie
Sessies worden server-side beheerd en zijn niet manipuleerbaar
Automatisch uitloggen bij sluiten van de browser
Beheeracties worden server-side gecontroleerd
Bestandsstructuur
Eindopdracht/
├── README.md
├── paginas/
│   ├── index.php
│   ├── edit.php
│   ├── login.php
│   ├── Toevoegen.php
│   └── opmaak.css
└── includes/
└── db_functions.php
Gebruikte technologieën
Backend: PHP 7.4+
Database: MySQL
Frontend: HTML5, CSS3, Bootstrap 5
Beveiliging: PDO (PHP Data Objects), Prepared Statements
Ontwikkelnotities
Alle PHP-code bevat Engelstalige comments
Prepared statements worden overal gebruikt voor databasebewerkingen
Validatiefuncties ondersteunen meerdere datatypes: string, email, datum, integer
De applicatie volgt een MVC-achtige structuur
Probleemoplossing

Vraag: Ik krijg een "Connection failed" foutmelding

Controleer of MySQL actief is
Controleer de databasegegevens in db_functions.php
Controleer of de database studenten_db bestaat

Vraag: Inloggen werkt niet

Controleer gebruikersnaam admin en wachtwoord 1234
Controleer of PHP-sessies ingeschakeld zijn

Vraag: Ik kan een toegevoegde student niet vinden

Controleer of de gegevens correct zijn ingevoerd
Zoek op StudentID indien mogelijk
Controleer de browserconsole op fouten

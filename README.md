# Számlázó
webes számlázó program (php, javascript)

A fejlesztését abbahagytam, 2018. Junius 1 utáni NAV online számlázást már nem tartalmazza. Aki akarja folytathatja vagy felhasználhatja. :D

Esetleg hozzárakhatja a hiányzó kódot a NAV online számlaküldéshez

!!! A kezdő oldal a szamla.php (nem index.php), majd átírod ha akarod. :D

## Demó itt elérhető:
http://jozko.com/szamla/szamla.php

Felhasználónév: proba

Jelszó:         1

| Felhasználónév:     | proba      |
|------------|-------------|
| Jelszó: | 1 |

## Adatbázis: 
DATABASE/localhost.sql

## Felhasználói leírás: 
[kszamla_felhasznaloi_utmutato.pdf](https://github.com/kocsisj/szamlazo/blob/master/felhasznaloi_utmutato/kszamla_felhasznaloi_utmutato.pdf)

## Beállítások: 
- config.php

   Itt kell beálljtani az adatbázis kapcsolatot paramétereit
   

- szla_email.php
- pro_szla_email.php
- registration.php

   Itt be kell állítani az SMTP szerver adatait, különben nem fog működni az email küldés. 
   (úgy tűnik lusta voltam egy fájlba összeszedni az SMTP paramétereket, ezért mindhárom fájlben kell módosítanod) 


## Képek a programból: 
![kep1](https://github.com/kocsisj/szamlazo/blob/master/felhasznaloi_utmutato/kep1.JPG)

![kep2](https://github.com/kocsisj/szamlazo/blob/master/felhasznaloi_utmutato/kep2.JPG)

![kep3](https://github.com/kocsisj/szamlazo/blob/master/felhasznaloi_utmutato/kep3.JPG)

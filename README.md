TM Pizza Website

A TM Pizza hivatalos weboldalának saját fejlesztésű WordPress-témája.

🌐 Éles weboldal: https://www.tmpizza.net

A repository a WordPress-téma forráskódját tartalmazza. Az Apache-, Certbot-, DNS-, adatbázis- és szerverkonfigurációk biztonsági okokból nem részei a repónak.

Tartalom

A projektről

Fő funkciók

Technológiák

Könyvtárstruktúra

Telepítés

WordPress-beállítások

Projektek kezelése

GitHub-letöltések

Newsroom

SEO és megosztási előnézetek

Eszköznézet és mobilmenü

Domain és szerver

Fejlesztési munkafolyamat

Biztonsági mentés

Hibaelhárítás

Biztonság

Projektállapot

A projektről

A TM Pizza egy kreatív közösség, amely játékokon, filmeken, alkalmazásokon, technikai kísérleteken és közösségi projekteken dolgozik.

A weboldal célja, hogy ezeknek a projekteknek egy közös, saját kezelésű felületet adjon. A látogatók megismerhetik a részlegeket, böngészhetik a projekteket, elolvashatják a Newsroom-frissítéseket, és bizonyos projekteket közvetlenül GitHubról is letölthetnek.

A vizuális irány:

sötét alap;

piros–narancssárga kiemelések;

üvegszerű panelek;

modern, letisztult elrendezés;

finom animációk;

teljes mobil- és tablet-támogatás.

A projekt külső page builder nélkül készült. Nem használ Elementort, Wixet, Divit vagy hasonló rendszert.

Fő funkciók

Saját WordPress-téma

A teljes megjelenés és a legtöbb funkció saját PHP-, CSS- és JavaScript-kódból áll.

Projektkezelő rendszer

A projektek külön WordPress bejegyzéstípusként kezelhetők.

Egy projekthez megadható:

cím;

hosszú leírás;

kivonat;

borítókép;

státusz;

platform;

részleg;

megjelenési sorrend;

kiemelt állapot;

külső projektlink;

GitHub repository;

GitHub-letöltés engedélyezése.

Projektarchívum

Az összes publikus projekt külön archívumoldalon jelenik meg:

/projektek/

A projektek részlegek szerint csoportosíthatók.

Newsroom

A készítők fejlesztési naplókat, híreket, bejelentéseket és frissítéseket adhatnak ki.

/newsroom/

GitHub-letöltés

Egy projektnél külön kapcsolóval engedélyezhető a GitHubról történő letöltés.

Bekapcsolás után a projektoldalon megjelenik:

Letöltés GitHubról

Repository megnyitása

SEO és közösségi előnézet

A téma saját SEO-modult tartalmaz:

meta description;

Open Graph cím és leírás;

Open Graph kép;

Twitter/X large image card;

aktuális oldal URL;

strukturált WebSite- és Organization-adatok;

projekt- és Newsroom-bejegyzéseknél article metaadatok.

Eszköznézet-választó

A weboldal felismeri vagy bekéri az eszköztípust:

asztali gép;

telefon;

tablet.

A választás a böngésző localStorage tárhelyébe kerül.

Mobilmenü

A fejléc saját mobilmenüvel rendelkezik hamburger gombbal, hozzáférhetőségi attribútumokkal és háttérgörgetés-kezeléssel.

Automatikus cache-busting

A CSS- és JavaScript-fájlok verzióját a téma a fájl módosítási idejéből készíti. Így frissítés után a böngésző nem tartja meg a régi fájlokat.

Technológiák

Szerver

Ubuntu Server

Apache HTTP Server

PHP

MariaDB vagy MySQL

WordPress

Certbot

Let’s Encrypt

Frontend

HTML5

CSS3

Vanilla JavaScript

PHP

WordPress template-rendszer

Inter

Space Grotesk

Külső szolgáltatások

GoDaddy

DuckDNS

GitHub

Google Search Console

Let’s Encrypt

Könyvtárstruktúra

A téma alapértelmezett helye:

/var/www/html/wp-content/themes/tmpizza-theme/

Jellemző struktúra:

tmpizza-theme/
├── assets/
│   ├── css/
│   │   ├── about.css
│   │   ├── animations.css
│   │   ├── base.css
│   │   ├── buttons.css
│   │   ├── device-choice.css
│   │   ├── divisions.css
│   │   ├── footer.css
│   │   ├── github-downloads.css
│   │   ├── header.css
│   │   ├── hero.css
│   │   ├── join.css
│   │   ├── newsroom.css
│   │   ├── project-archive.css
│   │   ├── projects.css
│   │   ├── responsive.css
│   │   └── single-project.css
│   ├── images/
│   │   └── social-preview.jpg
│   └── js/
│       └── main.js
├── inc/
│   ├── github-downloads.php
│   ├── newsroom.php
│   ├── projects.php
│   └── seo.php
├── template-parts/
│   ├── about.php
│   ├── device-dilemma.php
│   ├── divisions.php
│   ├── hero.php
│   ├── join.php
│   ├── project-archive-card.php
│   └── projects.php
├── archive-tmpizza_news.php
├── archive-tmpizza_project.php
├── footer.php
├── front-page.php
├── functions.php
├── header.php
├── index.php
├── single-tmpizza_news.php
├── single-tmpizza_project.php
├── style.css
└── README.md

Telepítés

1. Repository klónozása

cd /var/www/html/wp-content/themes
sudo git clone REPOSITORY_URL tmpizza-theme

Állítsd be a megfelelő tulajdonost és jogosultságokat a saját szerverkörnyezeted szerint.

Példa:

sudo chown -R www-data:www-data   /var/www/html/wp-content/themes/tmpizza-theme

2. Téma aktiválása

WordPress admin
→ Megjelenés
→ Sablonok
→ TM Pizza Theme
→ Bekapcsolás

3. Rewrite-szabályok frissítése

Beállítások
→ Közvetlen hivatkozások
→ Módosítások mentése

Nem kell módosítani semmit. A mentés újragenerálja a WordPress útvonalait.

WordPress-beállítások

Általános

Honlap neve:
TM Pizza

Honlap egysoros leírása:
Játékok, filmek és kreatív projektek egy közösségben.

WordPress-cím:
https://www.tmpizza.net

Webhelycím:
https://www.tmpizza.net

Olvasás

A következő opció ne legyen bepipálva:

Megtiltjuk a keresőmotoroknak, hogy bejárják az oldalt

Webhelyikon

Ajánlott méret:

512 × 512 px

Közösségi előnézeti kép

Elvárt fájl:

assets/images/social-preview.jpg

Ajánlott méret:

1200 × 630 px

Projektek kezelése

Adminfelület:

Projektek

Új projekt

Projektek
→ Új hozzáadása

Ajánlott kitöltési sorrend:

Projekt címe

Részletes leírás

Kivonat

Borítókép

Részleg

Státusz

Platform

Sorrend

Külső link

GitHub-beállítások

Közzététel

Kivonat

A kivonat felhasználható:

projektkártyán;

SEO-leírásként;

Discord-előnézetben;

közösségi megosztásnál.

Érdemes rövid, 1–3 mondatos leírást megadni.

Borítókép

A borítókép megjelenhet:

projektkártyán;

projektoldalon;

Open Graph előnézetben;

Discord-megosztásnál.

GitHub-letöltések

A GitHub-beállítások az adott projekt szerkesztőoldalán találhatók:

GitHub-letöltés

Bekapcsolás

Pipáld be:

A projekt letölthető GitHubról

Add meg:

GitHub repository linkje:
https://github.com/OWNER/REPOSITORY

Letölthető branch:
main

Letöltési URL

A téma automatikusan elkészíti a ZIP-linket:

https://github.com/OWNER/REPOSITORY/archive/refs/heads/main.zip

A GitHub-panel csak akkor jelenik meg, ha:

a letöltés engedélyezve van;

a repository-link érvényes;

a projekt el lett mentve;

a projekt publikus;

a megadott branch létezik.

Elfogadott repository-forma

https://github.com/felhasznalo/repository

A rendszer kizárólag HTTPS-es GitHub-linket fogad el.

Gyakori branchek

main
master
release/stable

Newsroom

Adminfelület:

Newsroom

Új frissítés

Newsroom
→ Új frissítés

Ajánlott mezők:

cím;

kivonat;

teljes tartalom;

borítókép;

szerző;

közzétételi dátum.

Publikus címek

https://www.tmpizza.net/newsroom/

https://www.tmpizza.net/newsroom/bejegyzes-neve/

Javasolt bejegyzéstípusok

fejlesztési napló;

új projekt bejelentése;

weboldalfrissítés;

karbantartási értesítés;

verziófrissítés;

közösségi esemény;

kulisszák mögötti bejegyzés.

SEO és megosztási előnézetek

A téma többek között ezeket generálja:

<meta name="description" content="...">
<meta property="og:title" content="...">
<meta property="og:description" content="...">
<meta property="og:image" content="...">
<meta property="og:url" content="...">
<meta name="twitter:card" content="summary_large_image">

Leírás prioritása

WordPress kivonat

A bejegyzés tartalmából generált rövid leírás

Alapértelmezett TM Pizza leírás

Kép prioritása

Kiemelt kép

social-preview.jpg

WordPress webhelyikon

Sitemap

https://www.tmpizza.net/wp-sitemap.xml

Google Search Console

Domain property:

tmpizza.net

Beküldött sitemap:

https://www.tmpizza.net/wp-sitemap.xml

Eszköznézet és mobilmenü

Támogatott módok:

desktop
mobile
tablet

A kiválasztás kulcsa:

tmpizza-device-view

A HTML-elemre kerülő osztályok:

view-desktop
view-mobile
view-tablet

A fejléc mobilmenüje a következő elemekre támaszkodik:

.mobile-menu-toggle
#primary-navigation
body.menu-open

Ezeket az osztályokat és ID-ket csak a JavaScript és a CSS egyidejű frissítésével szabad átnevezni.

Domain és szerver

Publikus webcím

https://www.tmpizza.net

DNS-felépítés

www.tmpizza.net
→ CNAME
→ tmpizza.duckdns.org

A gyökérdomain átirányít:

tmpizza.net
→ https://www.tmpizza.net

DuckDNS

A DuckDNS továbbra is szükséges, mert az otthoni publikus IP-cím megváltozhat. A látogatók ezt nem látják, de a háttérben ez tartja elérhetően a szervert.

HTTPS

A weboldal Let’s Encrypt tanúsítványt használ.

A közös tanúsítványon szerepelhet:

www.tmpizza.net
tmpizza.duckdns.org

Ez segít elkerülni az Apache 421 Misdirected Request problémáját.

Ellenőrzés:

sudo certbot certificates
sudo certbot renew --dry-run

Apache:

sudo apache2ctl configtest
sudo apache2ctl -S

Elvárt konfigurációs eredmény:

Syntax OK

Fejlesztési munkafolyamat

Témamappa

cd /var/www/html/wp-content/themes/tmpizza-theme

Git státusz

git status

Változások áttekintése

git diff

PHP-szintaxis ellenőrzése

find . -name "*.php" -print0 |
xargs -0 -n1 php -l

Commit

git add .
git commit -m "Rövid és érthető leírás"
git push

Frissítés a repositoryból

git pull

A téma PHP-fájljainak módosítása általában nem igényel Apache-újraindítást. Apache-konfiguráció módosítása után viszont:

sudo apache2ctl configtest
sudo systemctl reload apache2

Biztonsági mentés

A Git repository csak a témakódot védi.

Nem tartalmazza:

az adatbázist;

a feltöltött médiát;

a pluginbeállításokat;

a felhasználókat;

az Apache-konfigurációt;

a Certbot-konfigurációt;

a DNS-beállításokat;

a titkos kulcsokat.

Fontos mentési helyek

/var/www/html/wp-content/themes/tmpizza-theme
/var/www/html/wp-content/uploads
/var/www/html/wp-config.php
/etc/apache2/sites-available
/etc/apache2/sites-enabled
/etc/letsencrypt

A wp-config.php és az /etc/letsencrypt tartalma soha ne kerüljön nyilvános repositoryba.

Adatbázis-mentés WP-CLI-vel

wp db export backup.sql

Ajánlott gyakoriság:

témakód: minden érdemi változtatás után;

adatbázis: legalább hetente;

feltöltések: legalább hetente;

szerverkonfiguráció: nagyobb változtatások előtt.

Hibaelhárítás

Newsroom vagy projektoldal 404

Beállítások
→ Közvetlen hivatkozások
→ Módosítások mentése

A GitHub-gomb nem jelenik meg

Ellenőrizd:

be van-e kapcsolva a letöltés;

érvényes-e a repository-link;

HTTPS-sel kezdődik-e;

létezik-e a branch;

el lett-e mentve a projekt;

publikus-e a projekt.

A GitHub-gomb sárga vagy aláhúzott

A github-downloads.css végén legyen:

.project-github-panel a.project-github-button,
.project-github-panel a.project-github-button:visited {
    color: #ffffff !important;
    text-decoration: none !important;
}

.project-github-panel a.project-github-button:hover,
.project-github-panel a.project-github-button:focus,
.project-github-panel a.project-github-button:active {
    color: #ffffff !important;
    text-decoration: none !important;
}

.project-github-panel a.project-github-button svg {
    color: inherit;
    stroke: currentColor;
}

A CSS nem frissül

Ctrl + F5

A téma filemtime() alapú verziózást használ, ezért mentés után normál esetben az új fájlt tölti be.

Kritikus WordPress-hiba

find . -name "*.php" -print0 |
xargs -0 -n1 php -l

Naplók:

sudo tail -n 100 /var/log/apache2/error.log

sudo tail -n 100   /var/log/apache2/tmpizza-net-error.log

Nem biztonságos oldal

curl -I https://www.tmpizza.net/

Tanúsítvány:

echo | openssl s_client   -connect www.tmpizza.net:443   -servername www.tmpizza.net   2>/dev/null |
openssl x509 -noout -subject -issuer -dates -ext subjectAltName

Vegyes HTTP-tartalom keresése:

curl -s https://www.tmpizza.net/ |
grep -Eo 'http://[^"<> ]+' |
sort -u

421 Misdirected Request

sudo apache2ctl -S
sudo certbot certificates

Ellenőrizni kell, hogy a www.tmpizza.net és a DuckDNS-host SSL-konfigurációja kompatibilis-e.

Sitemap-hiba

curl -I https://www.tmpizza.net/wp-sitemap.xml

Elvárt eredmény:

HTTP/1.1 200 OK

Mobilmenü nem nyílik

Ellenőrizd:

betöltődik-e az assets/js/main.js;

létezik-e a .mobile-menu-toggle;

az ID primary-navigation;

megjelenik-e a body.menu-open osztály;

van-e JavaScript-hiba a konzolban.

Biztonság

Soha ne kerüljön GitHubra

wp-config.php;

adatbázis-jelszó;

WordPress adminjelszó;

SSH privát kulcs;

GitHub token;

DuckDNS token;

GoDaddy-fiókadat;

Certbot privát kulcs;

.env fájl;

Discord bot token;

személyes felhasználói adat.

Ajánlott védelem

kétlépcsős hitelesítés GitHubon;

kétlépcsős hitelesítés GoDaddy-n;

erős WordPress adminjelszó;

rendszeres Ubuntu-frissítés;

rendszeres WordPress-frissítés;

csak szükséges UFW-portok;

SSH-kulcsos belépés;

rendszeres biztonsági mentés;

ismeretlen pluginok kerülése.

UFW:

sudo ufw status

Jellemző szabályok:

22/tcp
Apache Full

Jövőbeli ötletek

Newsroom-kategóriák;

projektverzió mező;

changelog projektenként;

GitHub Releases integráció;

automatikus legújabb kiadás felismerése;

letöltésszámláló;

projektkereső és szűrők;

Discord webhook új Newsroom-bejegyzésnél;

automatikus GitHub Actions telepítés;

staging környezet;

teljesítményoptimalizálás;

automatikus adatbázis-mentés;

admin dashboard TM Pizza összefoglalóval.

Projektállapot

Állapot: stabil, publikus és használható

Saját WordPress-téma

Reszponzív kezdőlap

Mobilmenü

Eszköznézet-választó

Projektkezelő rendszer

Projektarchívum

Egyedi projektoldalak

Newsroom

Egyedi Newsroom-oldalak

GitHub-letöltési kapcsoló

GitHub repository-gomb

SEO-metaadatok

Open Graph előnézet

Webhelyikon

Saját domain

HTTPS

Google Search Console

WordPress sitemap

Git verziókezelés

Hasznos parancsok

cd /var/www/html/wp-content/themes/tmpizza-theme
git status
git add .
git commit -m "Leírás"
git push

find . -name "*.php" -print0 |
xargs -0 -n1 php -l

sudo apache2ctl configtest
sudo apache2ctl -S
sudo systemctl reload apache2
sudo systemctl status apache2

sudo certbot certificates
sudo certbot renew --dry-run

curl -I https://www.tmpizza.net/
curl -I https://www.tmpizza.net/wp-sitemap.xml

Tulajdon és felhasználás

Ez a projekt a TM Pizza saját weboldalához készült, és elsődlegesen belső használatra szolgál.

A kód másolása, terjesztése vagy más projekthez történő felhasználása csak a projekt tulajdonosának engedélyével történhet.

Záró megjegyzés

A TM Pizza weboldala saját infrastruktúrára, saját WordPress-témára és saját fejlesztési munkára épül.

Nem weboldalépítő szolgáltatás generálta, nem előfizetéses sablon, és nem egy kész téma egyszerű átszínezése. A projekt célja az volt, hogy a TM Pizza kapjon egy olyan weboldalt, amely technikailag és vizuálisan is tényleg a közösséghez tartozik.

TM Pizza — játékok, filmek és kreatív projektek egy közösségben.

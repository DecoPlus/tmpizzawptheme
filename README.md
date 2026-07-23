# TM Pizza Website

A **TM Pizza hivatalos weboldalának saját fejlesztésű WordPress-témája**.

🌐 **Éles weboldal:** [https://www.tmpizza.net](https://www.tmpizza.net)

> A repository a WordPress-téma forráskódját tartalmazza. Az Apache-, Certbot-, DNS-, adatbázis- és szerverkonfigurációk biztonsági okokból nem részei a repónak.

---

## Tartalom

- [A projektről](#a-projektről)
- [Fő funkciók](#fő-funkciók)
- [Technológiák](#technológiák)
- [Könyvtárstruktúra](#könyvtárstruktúra)
- [Telepítés](#telepítés)
- [WordPress-beállítások](#wordpress-beállítások)
- [Projektek kezelése](#projektek-kezelése)
- [GitHub-letöltések](#github-letöltések)
- [Newsroom](#newsroom)
- [SEO és megosztási előnézetek](#seo-és-megosztási-előnézetek)
- [Eszköznézet és mobilmenü](#eszköznézet-és-mobilmenü)
- [Domain és szerver](#domain-és-szerver)
- [Fejlesztési munkafolyamat](#fejlesztési-munkafolyamat)
- [Biztonsági mentés](#biztonsági-mentés)
- [Hibaelhárítás](#hibaelhárítás)
- [Biztonság](#biztonság)
- [Projektállapot](#projektállapot)

---

## A projektről

A TM Pizza egy kreatív közösség, amely játékokon, filmeken, alkalmazásokon, technikai kísérleteken és közösségi projekteken dolgozik.

A weboldal célja, hogy ezeknek a projekteknek egy közös, saját kezelésű felületet adjon. A látogatók megismerhetik a részlegeket, böngészhetik a projekteket, elolvashatják a Newsroom-frissítéseket, és bizonyos projekteket közvetlenül GitHubról is letölthetnek.

A vizuális irány:

- sötét alap;
- piros–narancssárga kiemelések;
- üvegszerű panelek;
- modern, letisztult elrendezés;
- finom animációk;
- teljes mobil- és tablet-támogatás.

A projekt külső page builder nélkül készült. Nem használ Elementort, Wixet, Divit vagy hasonló rendszert.

---

## Fő funkciók

### Saját WordPress-téma

A teljes megjelenés és a legtöbb funkció saját PHP-, CSS- és JavaScript-kódból áll.

### Projektkezelő rendszer

A projektek külön WordPress bejegyzéstípusként kezelhetők.

Egy projekthez megadható:

- cím;
- hosszú leírás;
- kivonat;
- borítókép;
- státusz;
- platform;
- részleg;
- megjelenési sorrend;
- kiemelt állapot;
- külső projektlink;
- GitHub repository;
- GitHub-letöltés engedélyezése.

### Projektarchívum

Az összes publikus projekt külön archívumoldalon jelenik meg:

```text
/projektek/
```

A projektek részlegek szerint csoportosíthatók.

### Newsroom

A készítők fejlesztési naplókat, híreket, bejelentéseket és frissítéseket adhatnak ki.

```text
/newsroom/
```

### GitHub-letöltés

Egy projektnél külön kapcsolóval engedélyezhető a GitHubról történő letöltés.

Bekapcsolás után a projektoldalon megjelenik:

- **Letöltés GitHubról**
- **Repository megnyitása**

### SEO és közösségi előnézet

A téma saját SEO-modult tartalmaz:

- meta description;
- Open Graph cím és leírás;
- Open Graph kép;
- Twitter/X large image card;
- aktuális oldal URL;
- strukturált WebSite- és Organization-adatok;
- projekt- és Newsroom-bejegyzéseknél article metaadatok.

### Eszköznézet-választó

A weboldal felismeri vagy bekéri az eszköztípust:

- asztali gép;
- telefon;
- tablet.

A választás a böngésző `localStorage` tárhelyébe kerül.

### Mobilmenü

A fejléc saját mobilmenüvel rendelkezik hamburger gombbal, hozzáférhetőségi attribútumokkal és háttérgörgetés-kezeléssel.

### Automatikus cache-busting

A CSS- és JavaScript-fájlok verzióját a téma a fájl módosítási idejéből készíti. Így frissítés után a böngésző nem tartja meg a régi fájlokat.

---

## Technológiák

### Szerver

- Ubuntu Server
- Apache HTTP Server
- PHP
- MariaDB vagy MySQL
- WordPress
- Certbot
- Let’s Encrypt

### Frontend

- HTML5
- CSS3
- Vanilla JavaScript
- PHP
- WordPress template-rendszer
- Inter
- Space Grotesk

### Külső szolgáltatások

- GoDaddy
- DuckDNS
- GitHub
- Google Search Console
- Let’s Encrypt

---

## Könyvtárstruktúra

A téma alapértelmezett helye:

```text
/var/www/html/wp-content/themes/tmpizza-theme/
```

Jellemző struktúra:

```text
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
```

---

## Telepítés

### 1. Repository klónozása

```bash
cd /var/www/html/wp-content/themes
sudo git clone REPOSITORY_URL tmpizza-theme
```

Állítsd be a megfelelő tulajdonost és jogosultságokat a saját szerverkörnyezeted szerint.

Példa:

```bash
sudo chown -R www-data:www-data   /var/www/html/wp-content/themes/tmpizza-theme
```

### 2. Téma aktiválása

```text
WordPress admin
→ Megjelenés
→ Sablonok
→ TM Pizza Theme
→ Bekapcsolás
```

### 3. Rewrite-szabályok frissítése

```text
Beállítások
→ Közvetlen hivatkozások
→ Módosítások mentése
```

Nem kell módosítani semmit. A mentés újragenerálja a WordPress útvonalait.

---

## WordPress-beállítások

### Általános

```text
Honlap neve:
TM Pizza
```

```text
Honlap egysoros leírása:
Játékok, filmek és kreatív projektek egy közösségben.
```

```text
WordPress-cím:
https://www.tmpizza.net
```

```text
Webhelycím:
https://www.tmpizza.net
```

### Olvasás

A következő opció ne legyen bepipálva:

```text
Megtiltjuk a keresőmotoroknak, hogy bejárják az oldalt
```

### Webhelyikon

Ajánlott méret:

```text
512 × 512 px
```

### Közösségi előnézeti kép

Elvárt fájl:

```text
assets/images/social-preview.jpg
```

Ajánlott méret:

```text
1200 × 630 px
```

---

## Projektek kezelése

Adminfelület:

```text
Projektek
```

### Új projekt

```text
Projektek
→ Új hozzáadása
```

Ajánlott kitöltési sorrend:

1. Projekt címe
2. Részletes leírás
3. Kivonat
4. Borítókép
5. Részleg
6. Státusz
7. Platform
8. Sorrend
9. Külső link
10. GitHub-beállítások
11. Közzététel

### Kivonat

A kivonat felhasználható:

- projektkártyán;
- SEO-leírásként;
- Discord-előnézetben;
- közösségi megosztásnál.

Érdemes rövid, 1–3 mondatos leírást megadni.

### Borítókép

A borítókép megjelenhet:

- projektkártyán;
- projektoldalon;
- Open Graph előnézetben;
- Discord-megosztásnál.

---

## GitHub-letöltések

A GitHub-beállítások az adott projekt szerkesztőoldalán találhatók:

```text
GitHub-letöltés
```

### Bekapcsolás

Pipáld be:

```text
A projekt letölthető GitHubról
```

Add meg:

```text
GitHub repository linkje:
https://github.com/OWNER/REPOSITORY
```

```text
Letölthető branch:
main
```

### Letöltési URL

A téma automatikusan elkészíti a ZIP-linket:

```text
https://github.com/OWNER/REPOSITORY/archive/refs/heads/main.zip
```

A GitHub-panel csak akkor jelenik meg, ha:

- a letöltés engedélyezve van;
- a repository-link érvényes;
- a projekt el lett mentve;
- a projekt publikus;
- a megadott branch létezik.

### Elfogadott repository-forma

```text
https://github.com/felhasznalo/repository
```

A rendszer kizárólag HTTPS-es GitHub-linket fogad el.

### Gyakori branchek

```text
main
master
release/stable
```

---

## Newsroom

Adminfelület:

```text
Newsroom
```

### Új frissítés

```text
Newsroom
→ Új frissítés
```

Ajánlott mezők:

- cím;
- kivonat;
- teljes tartalom;
- borítókép;
- szerző;
- közzétételi dátum.

### Publikus címek

```text
https://www.tmpizza.net/newsroom/
```

```text
https://www.tmpizza.net/newsroom/bejegyzes-neve/
```

### Javasolt bejegyzéstípusok

- fejlesztési napló;
- új projekt bejelentése;
- weboldalfrissítés;
- karbantartási értesítés;
- verziófrissítés;
- közösségi esemény;
- kulisszák mögötti bejegyzés.

---

## SEO és megosztási előnézetek

A téma többek között ezeket generálja:

```html
<meta name="description" content="...">
<meta property="og:title" content="...">
<meta property="og:description" content="...">
<meta property="og:image" content="...">
<meta property="og:url" content="...">
<meta name="twitter:card" content="summary_large_image">
```

### Leírás prioritása

1. WordPress kivonat
2. A bejegyzés tartalmából generált rövid leírás
3. Alapértelmezett TM Pizza leírás

### Kép prioritása

1. Kiemelt kép
2. `social-preview.jpg`
3. WordPress webhelyikon

### Sitemap

```text
https://www.tmpizza.net/wp-sitemap.xml
```

### Google Search Console

Domain property:

```text
tmpizza.net
```

Beküldött sitemap:

```text
https://www.tmpizza.net/wp-sitemap.xml
```

---

## Eszköznézet és mobilmenü

Támogatott módok:

```text
desktop
mobile
tablet
```

A kiválasztás kulcsa:

```text
tmpizza-device-view
```

A HTML-elemre kerülő osztályok:

```text
view-desktop
view-mobile
view-tablet
```

A fejléc mobilmenüje a következő elemekre támaszkodik:

```text
.mobile-menu-toggle
#primary-navigation
body.menu-open
```

Ezeket az osztályokat és ID-ket csak a JavaScript és a CSS egyidejű frissítésével szabad átnevezni.

---

## Domain és szerver

### Publikus webcím

```text
https://www.tmpizza.net
```

### DNS-felépítés

```text
www.tmpizza.net
→ CNAME
→ tmpizza.duckdns.org
```

A gyökérdomain átirányít:

```text
tmpizza.net
→ https://www.tmpizza.net
```

### DuckDNS

A DuckDNS továbbra is szükséges, mert az otthoni publikus IP-cím megváltozhat. A látogatók ezt nem látják, de a háttérben ez tartja elérhetően a szervert.

### HTTPS

A weboldal Let’s Encrypt tanúsítványt használ.

A közös tanúsítványon szerepelhet:

```text
www.tmpizza.net
tmpizza.duckdns.org
```

Ez segít elkerülni az Apache `421 Misdirected Request` problémáját.

Ellenőrzés:

```bash
sudo certbot certificates
sudo certbot renew --dry-run
```

Apache:

```bash
sudo apache2ctl configtest
sudo apache2ctl -S
```

Elvárt konfigurációs eredmény:

```text
Syntax OK
```

---

## Fejlesztési munkafolyamat

### Témamappa

```bash
cd /var/www/html/wp-content/themes/tmpizza-theme
```

### Git státusz

```bash
git status
```

### Változások áttekintése

```bash
git diff
```

### PHP-szintaxis ellenőrzése

```bash
find . -name "*.php" -print0 |
xargs -0 -n1 php -l
```

### Commit

```bash
git add .
git commit -m "Rövid és érthető leírás"
git push
```

### Frissítés a repositoryból

```bash
git pull
```

A téma PHP-fájljainak módosítása általában nem igényel Apache-újraindítást. Apache-konfiguráció módosítása után viszont:

```bash
sudo apache2ctl configtest
sudo systemctl reload apache2
```

---

## Biztonsági mentés

A Git repository csak a témakódot védi.

Nem tartalmazza:

- az adatbázist;
- a feltöltött médiát;
- a pluginbeállításokat;
- a felhasználókat;
- az Apache-konfigurációt;
- a Certbot-konfigurációt;
- a DNS-beállításokat;
- a titkos kulcsokat.

### Fontos mentési helyek

```text
/var/www/html/wp-content/themes/tmpizza-theme
/var/www/html/wp-content/uploads
/var/www/html/wp-config.php
/etc/apache2/sites-available
/etc/apache2/sites-enabled
/etc/letsencrypt
```

A `wp-config.php` és az `/etc/letsencrypt` tartalma soha ne kerüljön nyilvános repositoryba.

### Adatbázis-mentés WP-CLI-vel

```bash
wp db export backup.sql
```

Ajánlott gyakoriság:

- témakód: minden érdemi változtatás után;
- adatbázis: legalább hetente;
- feltöltések: legalább hetente;
- szerverkonfiguráció: nagyobb változtatások előtt.

---

## Hibaelhárítás

### Newsroom vagy projektoldal 404

```text
Beállítások
→ Közvetlen hivatkozások
→ Módosítások mentése
```

### A GitHub-gomb nem jelenik meg

Ellenőrizd:

- be van-e kapcsolva a letöltés;
- érvényes-e a repository-link;
- HTTPS-sel kezdődik-e;
- létezik-e a branch;
- el lett-e mentve a projekt;
- publikus-e a projekt.

### A GitHub-gomb sárga vagy aláhúzott

A `github-downloads.css` végén legyen:

```css
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
```

### A CSS nem frissül

```text
Ctrl + F5
```

A téma `filemtime()` alapú verziózást használ, ezért mentés után normál esetben az új fájlt tölti be.

### Kritikus WordPress-hiba

```bash
find . -name "*.php" -print0 |
xargs -0 -n1 php -l
```

Naplók:

```bash
sudo tail -n 100 /var/log/apache2/error.log
```

```bash
sudo tail -n 100   /var/log/apache2/tmpizza-net-error.log
```

### Nem biztonságos oldal

```bash
curl -I https://www.tmpizza.net/
```

Tanúsítvány:

```bash
echo | openssl s_client   -connect www.tmpizza.net:443   -servername www.tmpizza.net   2>/dev/null |
openssl x509 -noout -subject -issuer -dates -ext subjectAltName
```

Vegyes HTTP-tartalom keresése:

```bash
curl -s https://www.tmpizza.net/ |
grep -Eo 'http://[^"<> ]+' |
sort -u
```

### `421 Misdirected Request`

```bash
sudo apache2ctl -S
sudo certbot certificates
```

Ellenőrizni kell, hogy a `www.tmpizza.net` és a DuckDNS-host SSL-konfigurációja kompatibilis-e.

### Sitemap-hiba

```bash
curl -I https://www.tmpizza.net/wp-sitemap.xml
```

Elvárt eredmény:

```text
HTTP/1.1 200 OK
```

### Mobilmenü nem nyílik

Ellenőrizd:

- betöltődik-e az `assets/js/main.js`;
- létezik-e a `.mobile-menu-toggle`;
- az ID `primary-navigation`;
- megjelenik-e a `body.menu-open` osztály;
- van-e JavaScript-hiba a konzolban.

---

## Biztonság

### Soha ne kerüljön GitHubra

- `wp-config.php`;
- adatbázis-jelszó;
- WordPress adminjelszó;
- SSH privát kulcs;
- GitHub token;
- DuckDNS token;
- GoDaddy-fiókadat;
- Certbot privát kulcs;
- `.env` fájl;
- Discord bot token;
- személyes felhasználói adat.

### Ajánlott védelem

- kétlépcsős hitelesítés GitHubon;
- kétlépcsős hitelesítés GoDaddy-n;
- erős WordPress adminjelszó;
- rendszeres Ubuntu-frissítés;
- rendszeres WordPress-frissítés;
- csak szükséges UFW-portok;
- SSH-kulcsos belépés;
- rendszeres biztonsági mentés;
- ismeretlen pluginok kerülése.

UFW:

```bash
sudo ufw status
```

Jellemző szabályok:

```text
22/tcp
Apache Full
```

---

## Jövőbeli ötletek

- Newsroom-kategóriák;
- projektverzió mező;
- changelog projektenként;
- GitHub Releases integráció;
- automatikus legújabb kiadás felismerése;
- letöltésszámláló;
- projektkereső és szűrők;
- Discord webhook új Newsroom-bejegyzésnél;
- automatikus GitHub Actions telepítés;
- staging környezet;
- teljesítményoptimalizálás;
- automatikus adatbázis-mentés;
- admin dashboard TM Pizza összefoglalóval.

---

## Projektállapot

**Állapot:** stabil, publikus és használható

- [x] Saját WordPress-téma
- [x] Reszponzív kezdőlap
- [x] Mobilmenü
- [x] Eszköznézet-választó
- [x] Projektkezelő rendszer
- [x] Projektarchívum
- [x] Egyedi projektoldalak
- [x] Newsroom
- [x] Egyedi Newsroom-oldalak
- [x] GitHub-letöltési kapcsoló
- [x] GitHub repository-gomb
- [x] SEO-metaadatok
- [x] Open Graph előnézet
- [x] Webhelyikon
- [x] Saját domain
- [x] HTTPS
- [x] Google Search Console
- [x] WordPress sitemap
- [x] Git verziókezelés

---

## Hasznos parancsok

```bash
cd /var/www/html/wp-content/themes/tmpizza-theme
git status
git add .
git commit -m "Leírás"
git push
```

```bash
find . -name "*.php" -print0 |
xargs -0 -n1 php -l
```

```bash
sudo apache2ctl configtest
sudo apache2ctl -S
sudo systemctl reload apache2
sudo systemctl status apache2
```

```bash
sudo certbot certificates
sudo certbot renew --dry-run
```

```bash
curl -I https://www.tmpizza.net/
curl -I https://www.tmpizza.net/wp-sitemap.xml
```

---

## Tulajdon és felhasználás

Ez a projekt a **TM Pizza** saját weboldalához készült, és elsődlegesen belső használatra szolgál.

A kód másolása, terjesztése vagy más projekthez történő felhasználása csak a projekt tulajdonosának engedélyével történhet.

---

## Záró megjegyzés

A TM Pizza weboldala saját infrastruktúrára, saját WordPress-témára és saját fejlesztési munkára épül.

Nem weboldalépítő szolgáltatás generálta, nem előfizetéses sablon, és nem egy kész téma egyszerű átszínezése. A projekt célja az volt, hogy a TM Pizza kapjon egy olyan weboldalt, amely technikailag és vizuálisan is tényleg a közösséghez tartozik.

**TM Pizza — játékok, filmek és kreatív projektek egy közösségben.**

# Wellbeeing webshop

Een statische Nederlandse webshop met negen producten. Geen framework of buildstap; de browser gebruikt native JavaScript-modules.

## Starten

Gebruik Node.js 24 of nieuwer:

```sh
npm ci
npm run dev
```

Open [de lokale winkel](http://127.0.0.1:5500). De server is alleen lokaal bereikbaar. Hij serveert `index.html`, `src/`, `assets/` en `html/`; archief, tooling en verborgen bestanden zijn uitgesloten. Open de pagina via deze server, niet rechtstreeks als `file://`.

## Structuur

```text
index.html          Hoofdpagina
assets/
  images/           Alleen gebruikte afbeeldingen
  styles/           Leesbare CSS per paginaonderdeel
src/
  main.js           Opstarten
  data/             Productcatalogus
  domain/           Winkelregels en opslag, onafhankelijk van de DOM
  features/         Interactie tussen winkelregels en pagina
  ui/               HTML-weergave, opmaak en meldingen
html/               Compatibiliteit voor oude adressen
scripts/            Ontwikkelserver
tests/              Automatische tests
docs/               Bestandscontrole en ontwerpkeuzes
legacy/             Ongebruikt historisch bronmateriaal; niet publiceren
```

Zie [de bestandscontrole](docs/file-audit.md) voor welke bestanden nodig zijn, wat verplaatst is en waarom.

## Onderhoud

- Producten, prijzen en categorieën: `src/data/products.js`. Prijzen staan in **gehele eurocenten**.
- Merkidentiteit: origineel logo in `assets/images/wellbeeing-logo.png`; geel `#FFC72C` en zwart `#111111`. Centrale kleurvariabelen staan in `assets/styles/base.css`.
- Vormgeving: `assets/styles/`; de importvolgorde staat in `main.css`.
- Winkelmandregels: `src/domain/cart.js`. De bestaande opslagsleutel `wellbeeing-cart` blijft behouden.
- Productdetails gebruiken `?product=ID`; de winkelmand kan direct openen met `?cart=open`.

```sh
npm run format       # Broncode opmaken
npm run check        # ESLint, tests en opmaakcontrole
```

Tests draaien zonder afzonderlijke childprocessen, zodat ze ook in een beperkte ontwikkelomgeving werken. Ze controleren zoeken/filteren, sorteren, eurocentberekeningen, aantallen, ongeldige opslag, HTML-escaping, servertoegang en ongebruikte bronbestanden/afbeeldingen.

## Publicatie en status

Publiceer uitsluitend `index.html`, `assets/`, `src/` en de compatibiliteitspagina's in `html/`. Dependencies en ontwikkelbestanden zijn niet nodig in de browser.

Dit is een **frontenddemo**. Bestellen, betalen, voorraad, accounts, verzendkosten en btw-afhandeling zijn niet aangesloten. De winkelmand werkt lokaal en blijft tijdens een paginabezoek bruikbaar als browseropslag geblokkeerd is. De oude PHP-code is niet geïntegreerd; zie `legacy/README.md`.

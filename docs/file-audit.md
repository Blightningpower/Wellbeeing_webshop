# Bestandscontrole en gemaakte keuzes

## Actieve website

| Bestand of map                     | Nodig? | Verantwoordelijkheid / wijziging                                                                             |
| ---------------------------------- | ------ | ------------------------------------------------------------------------------------------------------------ |
| `index.html`                       | Ja     | Eén hoofdpagina; semantische HTML, geen inline CSS of JavaScript.                                            |
| `src/main.js`                      | Ja     | Start alleen de onderdelen van de winkel op.                                                                 |
| `src/data/products.js`             | Ja     | De negen producten en categorienamen op één plek. Prijzen in eurocenten.                                     |
| `src/domain/catalog.js`            | Ja     | Zoeken, filteren en sorteren zonder afhankelijkheid van de browser.                                          |
| `src/domain/cart.js`               | Ja     | Aantallen, validatie, berekeningen en opslag met een vervangbare opslagadapter.                              |
| `src/features/catalog.js`          | Ja     | Koppelt cataloguslogica aan zoekveld, filters en productlijst.                                               |
| `src/features/cart.js`             | Ja     | Winkelmandweergave en gebruikersacties; behoudt toetsenbordfocus na wijzigingen.                             |
| `src/features/dialogs.js`          | Ja     | Productvensters, sluiten en browsergeschiedenis.                                                             |
| `src/ui/templates.js`              | Ja     | Gedeelde, leesbare HTML-weergave van producten en winkelmand. Producttekst wordt ge-escaped.                 |
| `src/ui/format.js`                 | Ja     | Eén valutaformatter, HTML-escaping en centrale afbeeldingspaden.                                             |
| `src/ui/notifications.js`          | Ja     | Tijdelijke statusmeldingen.                                                                                  |
| `assets/styles/main.css`           | Ja     | Laadt stijlen in een expliciete cascadevolgorde.                                                             |
| Overige `assets/styles/*.css`      | Ja     | Basis, header, introductie, catalogus, verhaal, dialogen en responsive regels. Geen geminificeerde broncode. |
| `assets/images/bijenkast.jpg`      | Ja     | Bestaande gedeelde foto voor de drie kastformaten en introductie.                                            |
| `assets/images/bloemenzaden-*.png` | Ja     | Drie productafbeeldingen.                                                                                    |
| `assets/images/honing-*.png`       | Ja     | Drie productafbeeldingen.                                                                                    |
| `assets/images/favicon-32x32.png`  | Ja     | Browsericoon.                                                                                                |

| `assets/images/wellbeeing-logo.png` | Ja | Origineel, ongewijzigd merklogo in header en footer; basis voor geel, zwart en wit. |

Automatische structuurtests controleren of alle actieve JavaScript- en CSS-bestanden bereikbaar zijn vanaf `index.html` en of alle actieve afbeeldingen daadwerkelijk worden gebruikt.

## Oude adressen

`html/productPage1.html` t/m `html/productPage9.html` bevatten alleen een doorverwijzing naar het betreffende product. Ze hebben geen eigen productdata, ontwerp of winkelgedrag. `html/shoppingCart.html` verwijst naar de nieuwe winkelmand.

`html/logIn.html` en `html/signUp.html` verwijzen naar één gedeelde uitleg in `html/unavailable.html`. Ze doen niet alsof aanmelden of inloggen werkt. `html/404.html` is een kleine terugkeerpagina. Deze bestanden zijn uitsluitend compatibiliteit voor oude adressen; de nieuwe winkel navigeert rechtstreeks naar de nieuwe onderdelen.

De al vóór deze wijziging verwijderde `html/index.html` is niet teruggezet.

## Niet nodig voor de huidige winkel: archief

Deze bestanden zijn bewaard als historisch bronmateriaal in `legacy/`. Ze worden niet door de actieve winkel geïmporteerd. De ontwikkelserver geeft deze map niet vrij en deze map hoort niet in een deployment.

| Bestanden                                                                                                                            | Bevinding                                                                                                                                                                                   |
| ------------------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `legacy/php/index.php`, `cart.php`                                                                                                   | Losse oude winkelimplementatie; verwijzingen naar ontbrekende CSS en oude hosts; overlappende functionaliteit.                                                                              |
| `legacy/php/products.php`                                                                                                            | HTML-generatie en presentatie door elkaar; verwijst naar ontbrekende CSS.                                                                                                                   |
| `legacy/php/CreateDb.php`                                                                                                            | Maakte databases/tabellen aan tijdens objectconstructie. Inloggegevens uit de bron verwijderd en vervangen door omgevingsvariabelen. Niet geschikt om ongewijzigd als backend te activeren. |
| `legacy/php/logIn.php`                                                                                                               | Geen werkende authenticatie; inloggen was een link.                                                                                                                                         |
| `legacy/php/register_script.php`                                                                                                     | Alleen een PHP-openingstag; geen registratie-implementatie.                                                                                                                                 |
| `legacy/php/thankyou.php`, `404.php`                                                                                                 | Oude zelfstandige schermen met ontbrekende of verouderde verwijzingen.                                                                                                                      |
| `legacy/html/logIn.html`, `signUp.html`, `404.html`                                                                                  | Oorspronkelijke pagina's met veel dubbele inline CSS en oude externe afbeeldingspaden.                                                                                                      |
| `legacy/images/arduino.jpg`, `flowersketch.jpg`                                                                                      | Niet gebruikt in de huidige catalogus of pagina.                                                                                                                                            |
| `legacy/images/Shoppingcart.png`, `User icon.png`, `White background.png`                                                            | Vervangen door HTML/CSS en inline iconen, of geen actuele toepassing.                                                                                                                       |
| `legacy/images/android-chrome-192x192.png`, `android-chrome-512x512.png`, `apple-touch-icon.png`, `favicon-16x16.png`, `favicon.ico` | Extra iconen waarvoor momenteel geen manifest of HTML-verwijzing bestaat.                                                                                                                   |

Let op: het verwijderen van een geheim uit een werkbestand verwijdert het niet uit de Git-geschiedenis. Als de oude databasegegevens nog geldig zijn, moeten ze bij de databasebeheerder worden vervangen.

## Ontwikkelbestanden

- `package.json` en `package-lock.json`: herhaalbare installatie en vaste ontwikkelcommando's; geen browserafhankelijkheden.
- `eslint.config.js`: JavaScript-controle.
- `.prettierrc.json` en `.prettierignore`: consistente opmaak, archief uitgesloten.
- `.gitignore`: houdt dependencies, lokale omgevingsbestanden en editorinstellingen buiten nieuwe commits.
- `scripts/serve.js`: lokale server, alleen winkelbestanden, gebonden aan `127.0.0.1`.
- `tests/*.test.js`: winkelgedrag, corrupt opgeslagen data, servergrenzen en bestandsverwijzingen.
- `.idea/`: persoonlijke IDE-instellingen; niet nodig om de winkel te draaien. Bestaande instellingen niet gewist; voortaan genegeerd voor nieuwe bestanden. Reeds gevolgde bestanden blijven door Git gevolgd.
- `node_modules/`: lokaal opnieuw te genereren met `npm ci`; niet in Git of deployment.
- `.git/`: versiegeschiedenis, geen websitebestand.

## Niet verhuld door deze opschoning

Dit blijft een frontenddemo. Er is geen aangesloten betaalprovider, bestellingenbackend, voorraadbeheer, authenticatie of btw-/verzendkostenafhandeling. De oude PHP-versie is niet getest als backend en vormt geen kant-en-klare vervanging daarvoor. De productprijzen en beschrijvingen zijn bestaande demonstratiegegevens.

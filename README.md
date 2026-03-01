# NextGantt

Een eenvoudige start voor een Nextcloud-app met een basis Gantt-overzicht.

## Features in deze versie

- Navigatie-item in Nextcloud zijbalk.
- Voorbeeldtaken vanuit de backend (`PageController`).
- Kalenderkoppeling: events uit de komende 60 dagen worden als Gantt-items getoond.
- Lichtgewicht timeline-rendering met vanilla JavaScript.
- Basis styling met Nextcloud CSS variabelen.

## Lokale ontwikkeling

1. Plaats deze map in je Nextcloud `apps/` directory als `nextgantt`.
2. Activeer de app via **Apps** in Nextcloud.
3. Open **NextGantt** vanuit het navigatiemenu.

## Hoe de kalenderkoppeling werkt

- `CalendarTaskProvider` haalt VEVENT-items op uit de agenda's van de ingelogde gebruiker.
- De app combineert handmatige voorbeeldtaken met kalenderitems in één timeline.
- Als de Calendar API niet beschikbaar is, blijft de app werken met de handmatige taken.

## Volgende stappen

- Handmatige taken opslaan in een database tabel.
- CRUD-formulieren bouwen met Vue in Nextcloud design system stijl.
- Tweeweg sync: taken terugschrijven naar agenda als events.

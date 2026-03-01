# NextGantt

A simple starting point for a Nextcloud app with a basic Gantt overview.

## Features in this version

- Navigation item in the Nextcloud sidebar.
- Example tasks provided by the backend (`PageController`).
- Calendar integration: events from the next 60 days are shown as Gantt items.
- Lightweight timeline rendering with vanilla JavaScript.
- Basic styling using Nextcloud CSS variables.

## Local development

1. Place this folder in your Nextcloud `apps/` directory as `nextgantt`.
2. Enable the app from **Apps** in Nextcloud.
3. Open **NextGantt** from the navigation menu.

## How the calendar integration works

- `CalendarTaskProvider` fetches VEVENT items from calendars of the logged-in user.
- The app combines manual example tasks with calendar items into one timeline.
- If the Calendar API is not available, the app still works with manual tasks.

## Next steps

- Store manual tasks in a database table.
- Build CRUD forms with Vue in Nextcloud design system style.
- Add two-way sync: write tasks back to calendar as events.

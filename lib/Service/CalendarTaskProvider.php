<?php

declare(strict_types=1);

namespace OCA\NextGantt\Service;

use OCP\Calendar\IManager as ICalendarManager;
use OCP\IUserSession;

class CalendarTaskProvider {
    public function __construct(
        private ICalendarManager $calendarManager,
        private IUserSession $userSession,
    ) {
    }

    /**
     * @return array<int, array{name: string, start: string, end: string, progress: int, source: string}>
     */
    public function getCalendarTasks(int $maxItems = 20): array {
        $user = $this->userSession->getUser();
        if ($user === null) {
            return [];
        }

        $calendars = $this->calendarManager->getCalendarsForPrincipal('principals/users/' . $user->getUID(), ['VEVENT']);
        if ($calendars === []) {
            return [];
        }

        $from = new \DateTimeImmutable('today 00:00:00');
        $to = $from->modify('+60 days 23:59:59');

        $tasks = [];

        foreach ($calendars as $calendar) {
            $objects = $calendar->search('', ['VEVENT'], ['timerange' => ['start' => $from, 'end' => $to]]);
            foreach ($objects as $object) {
                $vObject = $object->getVObject();
                if (!isset($vObject->VEVENT)) {
                    continue;
                }

                foreach ($vObject->VEVENT as $event) {
                    $start = new \DateTimeImmutable((string) $event->DTSTART);
                    $end = isset($event->DTEND)
                        ? new \DateTimeImmutable((string) $event->DTEND)
                        : $start->modify('+1 day');

                    $tasks[] = [
                        'name' => isset($event->SUMMARY) ? (string) $event->SUMMARY : 'Calendar event',
                        'start' => $start->format('Y-m-d'),
                        'end' => $end->format('Y-m-d'),
                        'progress' => 0,
                        'source' => 'calendar',
                    ];
                }
            }
        }

        usort($tasks, static fn (array $a, array $b): int => strcmp($a['start'], $b['start']));

        return array_slice($tasks, 0, $maxItems);
    }
}

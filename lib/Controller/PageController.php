<?php

declare(strict_types=1);

namespace OCA\NextGantt\Controller;

use OCA\NextGantt\Service\CalendarTaskProvider;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\IRequest;

class PageController extends Controller {
    public function __construct(
        string $appName,
        IRequest $request,
        private CalendarTaskProvider $calendarTaskProvider,
    ) {
        parent::__construct($appName, $request);
    }

    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     */
    public function index(): TemplateResponse {
        $manualTasks = [
            ['name' => 'Project kickoff', 'start' => '2026-03-03', 'end' => '2026-03-07', 'progress' => 100, 'source' => 'manual'],
            ['name' => 'Requirements', 'start' => '2026-03-08', 'end' => '2026-03-15', 'progress' => 75, 'source' => 'manual'],
            ['name' => 'Development', 'start' => '2026-03-16', 'end' => '2026-04-10', 'progress' => 40, 'source' => 'manual'],
            ['name' => 'Review', 'start' => '2026-04-11', 'end' => '2026-04-17', 'progress' => 0, 'source' => 'manual'],
        ];

        $calendarTasks = [];
        try {
            $calendarTasks = $this->calendarTaskProvider->getCalendarTasks();
        } catch (\Throwable) {
            $calendarTasks = [];
        }

        return new TemplateResponse('nextgantt', 'main', [
            'manualTasks' => $manualTasks,
            'calendarTasks' => $calendarTasks,
        ]);
    }
}

<?php

declare(strict_types=1);

namespace OCA\NextGantt\Controller;

use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\IRequest;

class PageController extends Controller {
    public function __construct(string $appName, IRequest $request) {
        parent::__construct($appName, $request);
    }

    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     */
    public function index(): TemplateResponse {
        $tasks = [
            ['name' => 'Project kickoff', 'start' => '2026-03-03', 'end' => '2026-03-07', 'progress' => 100],
            ['name' => 'Requirements', 'start' => '2026-03-08', 'end' => '2026-03-15', 'progress' => 75],
            ['name' => 'Development', 'start' => '2026-03-16', 'end' => '2026-04-10', 'progress' => 40],
            ['name' => 'Review', 'start' => '2026-04-11', 'end' => '2026-04-17', 'progress' => 0],
        ];

        return new TemplateResponse('nextgantt', 'main', [
            'tasks' => $tasks,
        ]);
    }
}

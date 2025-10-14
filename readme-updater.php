<?php

/**
 * README Auto-Update Helper
 * 
 * Helper ini akan otomatis update README.md setiap kali ada perubahan
 * pada struktur aplikasi Laravel.
 */

class ReadmeUpdater
{
    private string $readmePath;
    private array $projectStructure;

    public function __construct(string $basePath)
    {
        $this->readmePath = $basePath . '/README.md';
        $this->projectStructure = $this->scanProjectStructure($basePath);
    }

    /**
     * Scan struktur project untuk update otomatis
     */
    private function scanProjectStructure(string $basePath): array
    {
        $structure = [
            'routes' => $this->scanRoutes($basePath . '/routes/web.php'),
            'controllers' => $this->scanControllers($basePath . '/app/Http/Controllers'),
            'models' => $this->scanModels($basePath . '/app/Models'),
            'views' => $this->scanViews($basePath . '/resources/views'),
            'migrations' => $this->scanMigrations($basePath . '/database/migrations'),
            'features' => $this->detectFeatures($basePath),
        ];

        return $structure;
    }

    /**
     * Scan routes yang tersedia
     */
    private function scanRoutes(string $routesFile): array
    {
        if (!file_exists($routesFile)) {
            return [];
        }

        $content = file_get_contents($routesFile);
        $routes = [];

        // Pattern untuk mendeteksi routes
        preg_match_all('/Route::(get|post|put|delete|patch)\([\'"]([^\'"]+)[\'"]/', $content, $matches);

        for ($i = 0; $i < count($matches[0]); $i++) {
            $routes[] = [
                'method' => strtoupper($matches[1][$i]),
                'uri' => $matches[2][$i],
                'type' => 'Closure' // Default, bisa dideteksi lebih detail
            ];
        }

        return $routes;
    }

    /**
     * Scan controllers yang ada
     */
    private function scanControllers(string $controllersDir): array
    {
        if (!is_dir($controllersDir)) {
            return [];
        }

        $controllers = [];
        $files = glob($controllersDir . '/*.php');

        foreach ($files as $file) {
            $className = basename($file, '.php');
            $controllers[] = $className;
        }

        return $controllers;
    }

    /**
     * Scan models yang ada
     */
    private function scanModels(string $modelsDir): array
    {
        if (!is_dir($modelsDir)) {
            return [];
        }

        $models = [];
        $files = glob($modelsDir . '/*.php');

        foreach ($files as $file) {
            $className = basename($file, '.php');
            $models[] = $className;
        }

        return $models;
    }

    /**
     * Scan views yang ada
     */
    private function scanViews(string $viewsDir): array
    {
        if (!is_dir($viewsDir)) {
            return [];
        }

        $views = [];
        $files = glob($viewsDir . '/*.blade.php');

        foreach ($files as $file) {
            $viewName = basename($file, '.blade.php');
            $views[] = $viewName;
        }

        return $views;
    }

    /**
     * Scan migrations
     */
    private function scanMigrations(string $migrationsDir): array
    {
        if (!is_dir($migrationsDir)) {
            return [];
        }

        $migrations = [];
        $files = glob($migrationsDir . '/*.php');

        foreach ($files as $file) {
            $migrationName = basename($file, '.php');
            $migrations[] = $migrationName;
        }

        return $migrations;
    }

    /**
     * Deteksi fitur yang sudah diimplementasikan
     */
    private function detectFeatures(string $basePath): array
    {
        $features = [
            'routing' => !empty($this->projectStructure['routes'] ?? []),
            'controllers' => !empty($this->projectStructure['controllers'] ?? []),
            'models' => !empty($this->projectStructure['models'] ?? []),
            'blade_templates' => !empty($this->projectStructure['views'] ?? []),
            'database' => !empty($this->projectStructure['migrations'] ?? []),
            'authentication' => file_exists($basePath . '/routes/auth.php'),
            'api' => file_exists($basePath . '/routes/api.php'),
            'testing' => file_exists($basePath . '/tests'),
        ];

        return $features;
    }

    /**
     * Update README dengan struktur terbaru
     */
    public function updateReadme(): bool
    {
        if (!file_exists($this->readmePath)) {
            return false;
        }

        $content = file_get_contents($this->readmePath);

        // Update routes table
        $content = $this->updateRoutesSection($content);

        // Update features checklist
        $content = $this->updateFeaturesSection($content);

        // Update timestamp
        $content = $this->updateTimestamp($content);

        return file_put_contents($this->readmePath, $content) !== false;
    }

    /**
     * Update section routes di README
     */
    private function updateRoutesSection(string $content): string
    {
        $routesTable = "| Method | URI | Action | Description |\n";
        $routesTable .= "|--------|-----|--------|-------------|\n";

        foreach ($this->projectStructure['routes'] as $route) {
            $description = $this->generateRouteDescription($route);
            $routesTable .= "| {$route['method']} | `{$route['uri']}` | {$route['type']} | {$description} |\n";
        }

        // Replace existing routes table
        $pattern = '/\|\s*Method\s*\|\s*URI\s*\|\s*Action\s*\|\s*Description\s*\|.*?\n(?:\|[^\n]*\|\n)*/s';
        $content = preg_replace($pattern, $routesTable, $content);

        return $content;
    }

    /**
     * Generate deskripsi untuk route
     */
    private function generateRouteDescription(array $route): string
    {
        switch ($route['uri']) {
            case '/':
                return 'Home page dengan dashboard overview';
            case '/dashboard':
                return 'Dashboard dengan statistik cards';
            default:
                return 'Route ' . $route['uri'];
        }
    }

    /**
     * Update checklist fitur yang sudah diimplementasikan
     */
    private function updateFeaturesSection(string $content): string
    {
        $features = $this->projectStructure['features'];

        $checklistMap = [
            'routing' => 'Basic Routing',
            'controllers' => 'Controllers',
            'models' => 'Database Models',
            'blade_templates' => 'Blade Templates',
            'database' => 'Database Setup',
            'authentication' => 'Authentication',
            'api' => 'API Routes',
            'testing' => 'Testing Setup',
        ];

        foreach ($checklistMap as $key => $label) {
            $status = $features[$key] ? '[x]' : '[ ]';
            $pattern = '/- \[[ x]\] \*\*' . preg_quote($label, '/') . '\*\*/';
            $replacement = "- {$status} **{$label}**";
            $content = preg_replace($pattern, $replacement, $content);
        }

        return $content;
    }

    /**
     * Update timestamp di README
     */
    private function updateTimestamp(string $content): string
    {
        $date = date('d F Y');
        $pattern = '/- \*\*\d{1,2} \w+ \d{4}\*\*: (.+)/';
        $replacement = "- **{$date}**: $1";

        return preg_replace($pattern, $replacement, $content);
    }

    /**
     * Static method untuk quick update
     */
    public static function quickUpdate(string $basePath = __DIR__): bool
    {
        $updater = new self($basePath);
        return $updater->updateReadme();
    }
}

// Auto-run jika file ini dijalankan langsung
if (basename($_SERVER['PHP_SELF']) === basename(__FILE__)) {
    $result = ReadmeUpdater::quickUpdate();
    echo $result ? "✅ README updated successfully!\n" : "❌ Failed to update README.\n";
}

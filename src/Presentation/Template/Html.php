<?php declare(strict_types=1);

namespace Room11\Platter\Presentation\Template;

use CodeCollab\Template\Html as Template;

class Html extends Template
{
    protected $templateDirectory;

    public function __construct(string $templateDirectory, string $basePage)
    {
        $this->templateDirectory = $templateDirectory;

        parent::__construct($this->templateDirectory . $basePage);
    }

    public function render(string $template, array $data = []): string
    {
        return parent::render($this->templateDirectory . $template, $data);
    }

    public function renderPage(string $template, array $data = []): string
    {
        return parent::renderPage($template, $data);
    }
}

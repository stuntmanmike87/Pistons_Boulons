<?php

declare(strict_types=1);

namespace App\Controller;

use Pontedilana\PhpWeasyPrint\Pdf;
use Pontedilana\WeasyprintBundle\WeasyPrint\Response\PdfResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Environment;

final class PdfController extends AbstractController
{
    public function __construct(
        private readonly Environment $twig,
        private readonly Pdf $weasyPrint,
    ) {
    }

    #[Route('/pdf', name: 'pdf')]
    public function pdf(): Response
    {
        $html = $this->twig->render('base.html.twig');
        $pdfContent = $this->weasyPrint->getOutputFromHtml($html);

        return new PdfResponse(
            content: $pdfContent,
            fileName: 'file.pdf',
            contentType: 'application/pdf',
            contentDisposition: ResponseHeaderBag::DISPOSITION_INLINE,
            // or download the file instead of displaying it in the browser with
            // contentDisposition: ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            status: 200,
            headers: []
        );
    }
}

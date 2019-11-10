<?php


namespace App\Controller;


use App\Repository\UrlRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ShortUrlRedirectController extends AbstractController
{
    /**
     * @Route("/{shortenedUrl}", methods={"GET"}, name="short_url_redirect")
     */
    public function redirectTo(
        $shortenedUrl,
        UrlRepository $urlRepository
    ) {
        $url = $urlRepository->findOneBy([
            'shortenedUrl' => $shortenedUrl,
        ]);

        $originalUrl = $url->getOriginalUrl();

        return $this->redirect($originalUrl);
    }
}
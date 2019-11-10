<?php

namespace App\Controller;

use App\Entity\Url;
use App\Form\UrlType;
use App\Service\UrlGeneratorService;
use App\Repository\UrlRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepage(Request $request
    , EntityManagerInterface $em
    , UrlGeneratorService $urlGenerator
    , UrlRepository $urlRepository)
    {
        $url = new Url();
        $form = $this->createForm(UrlType::class, $url);

        $form->handleRequest($request);

        $errors = $form->getErrors(true);

        if ($form->isSubmitted() && $form->isValid()) {
            $originalUrl = $form->get('originalUrl')->getData();
            $shortenedUrl = $urlGenerator->getRandomUrl();
            $url->addUrl($originalUrl, $shortenedUrl);
            $em->persist($url);
            $em->flush();

            return $this->render('short_url.html.twig', [
                'base_url' => $request->getSchemeAndHttpHost(),
                'urls' => $urlRepository->findBy(array(), array('id' => 'DESC'))
            ]);
        }

        return $this->render('index.html.twig', array(
            'form' => $form->createView(),
            'errors' => $errors,
        ));
    }
}
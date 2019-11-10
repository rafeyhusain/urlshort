<?php


namespace App\Service;


use App\Repository\UrlRepository;
use Exception;

class UrlGeneratorService
{

    private $urlRepository;

    public function __construct(UrlRepository $urlRepository)
    {
        $this->urlRepository = $urlRepository;
    }

    // Following is a simple algorithm. But there could be algorithms 
    // which addresses scaliability. For example, 
    //
    // 1) A separate process could be developed which generates and store random bytes 
    // in sharded database. 
    //
    // 2) Number of random bytes determine maximum number of urls that
    // this system could serve.
    //
    // 3) Another process pulls few million in Redis cache from those 
    // sharded databases hence making random url generation process really
    // fast. 
    //
    // 4) Also this generation process could be hosted as a load balanced
    // cluster of servers to make process further fast.
    // 
    // 5) Most frequently accessed urls could be cached at Redis level
    // to quickly return full url to redirect to
    //
    public function getRandomUrl()
    {
        do {
            try {
                $bytes = random_bytes(5);
            } catch (Exception $e) {
                $this->get('session')->setFlash('error', "Url generator failed. Try again!");
            }
            $random = bin2hex($bytes);

            if (strlen($random) > 5) {
                $url = substr($random, 0, 5);
            }
            $urlInDatabase = $this->urlRepository->findOneBy([
                'shortenedUrl' => $url,
            ]);

        } while ($urlInDatabase);

        return $url;
    }
}
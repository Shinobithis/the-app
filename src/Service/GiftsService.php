<?php

namespace App\Service;

use Psr\Log\LoggerInterface;

class GiftsService {

    public  function __construct(LoggerInterface $logger) {
        $this->logger = $logger;
    }
    private array $gifts = ['PC', 'Pixel 10 pro', 'Pixel 9 pro', 'Iphone 17', 'Samsung 25+ Ultra', 'ryzen 7 735 HS'];

    public function getGifts()
    {
        $localGifts = $this->gifts;
        shuffle($localGifts);
        $this->logger->info("Gift gived successfully");
        return $localGifts;
    }
}

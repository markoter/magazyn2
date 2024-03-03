<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MyTest extends AbstractController
{
    #[Route('lucky/test')]
    public function someTest():Response
    {
        $ktore = random_int(0,3);
        $odpowiedzi = ['pierwsza', "druga", 'trzecia', 'czwarta'];
        return new Response(
            '<html><body> Wybrano odpowiedź: ' .$odpowiedzi[$ktore]. '</body></html>'
        );
    }
}
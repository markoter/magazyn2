<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MyTest extends AbstractController
{
    #[Route('lucky/myTest')]
    public function someTest():Response
    {
        $ktore = random_int(0,3);
        $odpowiedzi = ['pierwszy', "drugi", 'trzeci', 'czwarty'];
        $wybor = $odpowiedzi[$ktore];
        // return new Response(
        //     '<html><body> Wybrano odpowiedź: ' .$odpowiedzi[$ktore]. '</body></html>'
        // );
        return $this->render('lucky/myTest.html.twig', [
            'wybor' => $wybor,
        ]);
    }
}
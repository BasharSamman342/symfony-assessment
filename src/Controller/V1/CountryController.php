<?php
declare(strict_types=1);

namespace App\Controller\V1;

use App\Service\CountryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('countries')]
class CountryController extends AbstractController
{
    protected $countryService;
    public function __construct()
    {
        $this->countryService = new CountryService();
    }
    
    #[Route('/{country}', methods: ['GET'])]
    public function getCountry(): JsonResponse
    {
        $res = $this->countryService->fetchCountries();
        // return $this->success($res, $trans->trans("symfony_title"));
        return $this->json([
            "data"=>$res
        ]);
    }

    #[Route('/list', methods: ['GET'])]
    public function getCountries(): JsonResponse
    {
        // TODO
        $res = $this->countryService->fetchCountries();
        // return $this->success($res, $trans->trans("symfony_title"));
        return $this->json([
            "data"=>$res
        ]);
    }

    #[Route('/', methods: ['POST'])]
    public function addCountry(): void
    {
        // TODO
    }

    #[Route('/{country}', methods: ['PATCH'])]
    public function updateCountry(): void
    {
        // TODO
    }

    #[Route('/{country}', methods: ['DELETE'])]
    public function deleteCountry(): void
    {
        // TODO
    }
}
<?php
declare(strict_types=1);

namespace App\Controller\V1;

use App\Controller\BaseController;
use App\Service\CountryService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route('countries')]
class CountryController extends BaseController
{
    protected $countryService;
    public function __construct()
    {
        $this->countryService = new CountryService();
    }
    
    #[Route('/{country}', methods: ['GET'])]
    public function getCountry(TranslatorInterface $trans): JsonResponse
    {
        $res = $this->countryService->fetchCountries();
        // return $this->success($res, $trans->trans("symfony_title"));
        return $this->success($res, $trans->trans("record_details"));
    }

    #[Route('/list', methods: ['GET'])]
    public function getCountries(TranslatorInterface $trans): JsonResponse
    {
        // TODO
        $res = $this->countryService->fetchCountries();
        return $this->success($res,$trans->trans("record_list"));
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
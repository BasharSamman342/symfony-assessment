<?php
declare(strict_types=1);

namespace App\Controller\V1;

use App\Controller\BaseController;
use App\Entity\Country;
use App\Requests\CountryRequest;
use App\Service\CountryService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route('countries')]
class CountryController extends BaseController
{
    protected $countryService;
    protected $model;
    public function __construct()
    {
        $this->countryService = new CountryService();
        $this->model = new Country();

    }

    #[Route('/list', methods: ['GET'])]
    public function getCountries(TranslatorInterface $trans,EntityManagerInterface $em): JsonResponse
    {
        $repository = $em->getRepository(Country::class);
        $countries = $repository->getAllCountries();
        return $this->success($countries, $trans->trans("record_listing"));
    }
    
    #[Route('/{id}', methods: ['GET'])]
    public function getCountry(string $id,TranslatorInterface $trans,EntityManagerInterface $em): JsonResponse
    {
        $repository = $em->getRepository(Country::class);
        $country = $repository->findOneById($id);
        return $this->success($country, $trans->trans("record_details"));
    }

    #[Route('/', methods: ['POST'])]
    public function addCountry(EntityManagerInterface $em,#[MapRequestPayload] CountryRequest $request,TranslatorInterface $trans)
    {
        $this->model->setName($request->name);
        $this->model->setRegion($request->region);
        $this->model->setSubRegion($request->subRegion);
        $this->model->setPopulation($request->population);
        $this->model->setIndependant($request->independent);
        $this->model->setFlag($request->flag);
        $this->model->setDemonym($request->demonym);
        $this->model->setCurrency(
            ['name'=>$request->currency['name'],'symbol'=>$request->currency['symbol']]
        );
        try {
            $em->persist($this->model);
            $res = $em->flush();
            return $this->success($res,$trans->trans("record_created"));
        } catch (\Throwable $th) {
            return $this->failure($th->getMessage());
        }
    }

    #[Route('/{country}', methods: ['PATCH'])]
    public function updateCountry(string $country,EntityManagerInterface $em,#[MapRequestPayload] CountryRequest $request,TranslatorInterface $transObj)
    {
        $repository = $em->getRepository(Country::class);
        $country = $repository->findOneById($country);
        $country->setName($request->name);
        $country->setRegion($request->region);
        $country->setSubRegion($request->subRegion);
        $country->setPopulation($request->population);
        $country->setIndependant($request->independent);
        $country->setFlag($request->flag);
        $country->setDemonym($request->demonym);
        $country->setCurrency(
            ['name'=>$request->currency['name'],'symbol'=>$request->currency['symbol']]
        );
        try {
            $em->flush();
            return $this->success($country,$transObj->trans("record_updated"));
        } catch (\Throwable $th) {
            return $this->failure($th->getMessage());
        }
        
    }

    #[Route('/{country}', methods: ['DELETE'])]
    public function deleteCountry(string $country,EntityManagerInterface $em,TranslatorInterface $transObj): JsonResponse
    {
        $repository = $em->getRepository(Country::class);
        $country = $repository->findOneById($country);
        $em->remove($country);
        try {
            $res = $em->flush();
            return $this->success($res,$transObj->trans("record_deleted")); 
        } catch (\Throwable $th) {
            return $this->failure($th->getMessage());
        }
    }
}
<?php

namespace App\Repository;

use App\Entity\Country;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Country>
 */
class CountryRepository extends ServiceEntityRepository
{
    
    private $doctrine;
    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
        parent::__construct($doctrine, Country::class);
    }


    public function getAllCountries()
    {
        $countries =  $this->doctrine->getRepository(Country::class)->findAll();
        return $countries;
    }

    public function findOneById($value,$trans): ?Country
    {
        $country =  $this->doctrine->getRepository(Country::class)->find($value);
        if (!$country) {
            throw $this->createNotFoundException($trans->trans('record_not_found'));
        }
        return $country;
    }
}

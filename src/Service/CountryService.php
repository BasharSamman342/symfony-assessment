<?php

namespace App\Service;

use App\Entity\Country;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpClient\HttpClient;

class CountryService 
{
    protected $client;
    public function __construct() {
        $this->client = HttpClient::create()->withOptions([
            "base_uri"=>"https://restcountries.com/v3.1/"
        ]);
    }

    public function fetchCountries()
    {
        $response = $this->client->request("GET","all");
        return $response->toArray();
    }

    /**
     * this method is emptying the countries table and readding the entries from the api base on the batchSize
     */
    public function syncData($entityManager)
    {
        $data = $this->fetchCountries();
        $qb = $entityManager->createQueryBuilder();
        $qb->delete(Country::class, 'e');
        $query = $qb->getQuery();
        $query->execute();
        $entityManager->getConnection()->beginTransaction(); 
        try {
            $batchSize = 20;
            for ($i = 0; $i <= count($data)-1; ++$i) {
                $country = new Country();
                $country->setName($data[$i]['name']['official']);
                $country->setRegion($data[$i]['region']);
                $country->setSubRegion($data[$i]['subregion']??null);
                $country->setPopulation($data[$i]['population']);
                // $country->setIndependant($data[$i]['independent']);
                $country->setFlag($data[$i]['flags']['png']);
                // $country->setDemonym($data[$i]['demonyms']['eng']['m']);
                $country->setDemonym(
                    array_key_exists("demonyms",$data[$i])==true?
                    $data[$i]['demonyms']['eng']['m']
                    :null
                );
                // array_keys((array)$data[$i])[0];
                $country->setCurrency(
                    array_key_exists("currencies",$data[$i])==true?
                    ['name'=>$data[$i]['currencies'][array_keys((array)$data[$i]['currencies'])[0]]['name'],'symbol'=>$data[$i]['currencies'][array_keys((array)$data[$i]['currencies'])[0]]['symbol']]
                    :null
                );
                $entityManager->persist($country);
                if (($i % $batchSize) === 0) {
                    $entityManager->flush();
                    $entityManager->clear();
                }
            }
            $entityManager->flush(); 
            $entityManager->clear();
            $entityManager->getConnection()->commit();
            return true;
        } catch (Exception $e) {
            $entityManager->getConnection()->rollBack();
            throw $e;
            return false;
        }
    }
}

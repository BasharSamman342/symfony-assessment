<?php
declare(strict_types=1);

namespace App\Command;

use App\Service\CountryService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\Persistence\ManagerRegistry;

class CountrySyncCommand extends Command
{
    private $doctrine;
    protected $countryService;
    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
        $this->countryService = new CountryService();
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setName('countries:sync');
        $this->setDescription('Synchronize the countries');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $entityManager = $this->doctrine->getManager();
        $result = $this->countryService->syncData($entityManager);
        
        $result==true?
        $output->writeln([
            '',
            'Countries from rest countries api synced successfully into DB',
            '',
        ]):
        $output->writeln([
            '',
            'Oops! something went wrong',
            '',
        ]);
        return $result==true?COMMAND::SUCCESS:COMMAND::FAILURE;
    }
}
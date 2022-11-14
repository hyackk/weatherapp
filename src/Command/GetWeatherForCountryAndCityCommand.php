<?php

namespace App\Command;

use App\Entity\Weather;
use App\Service\WeatherUtil;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

#[AsCommand(
    name: 'getWeatherForCountryAndCity:command',
    description: 'Add a short description for your command',
)]
class GetWeatherForCountryAndCityCommand extends Command
{

    protected function configure(): void
    {
        $this->addArgument('country', InputArgument::REQUIRED, 'Country');
        $this->addArgument('city', InputArgument::REQUIRED, 'City');

    }

    public function __construct(WeatherUtil $wt)
    {
        $this->wt = $wt;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $encoders = [new JsonEncoder()];
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return $object->getLocation();
            },
        ];
        $normalizer = [new ObjectNormalizer(null, null, null, null, null, null, $defaultContext)];
        $serializer = new Serializer($normalizer, $encoders);

        $city=$input->getArgument('city');
        $country=$input->getArgument('country');

        $text='Weather for '.$country.' '.$city;

        if($city && $country){
            $out= $this->wt->getWeatherForCountryAndCity($country, $city);

            $jsonContent = $serializer->serialize($out, 'json');

            $text.=' Output: '.$jsonContent;
            $output->writeln($text);
            return Command::SUCCESS;
        }

        return Command::FAILURE;
    }
}

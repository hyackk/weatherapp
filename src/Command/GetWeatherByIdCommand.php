<?php

namespace App\Command;

use App\Service\WeatherUtil;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use App\Entity\Location;

#[AsCommand(
    name: 'getWeatherById:command',
    description: 'Add a short description for your command',
)]
class GetWeatherByIdCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->addArgument('locationId',
                InputArgument::REQUIRED,
                "We've been trying to reach you concerning your vehicle's extended warranty.")
        ;
    }

    public function __construct(WeatherUtil $wt)
    {
        $this->wt = $wt;
        parent::__construct();
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $loc_id=$input->getArgument('locationId');
        //$loc_id=$input->getArgument('locationId');

        $text='Passed '.$input->getArgument('locationId');

        if($input->getArgument('locationId')){
            $out= $this->wt->getWeatherForLocation($loc_id);
            $text.="\nOutput:\n";
            foreach ($out as &$single_weather) {
                $text.="ID: ".$single_weather->getId();
                $text.="\nDate: ".$single_weather->getTime()->format("d-m-Y");
                $text.="\nPressure: ".$single_weather->getPressure();
                $text.="\nVisibility: ".$single_weather->getVisibility();
                $text.="\nWind speed: ".$single_weather->getWindSpeed();
                $text.="\nWind degrees: ".$single_weather->getWindDeg();
                $text.="\nClouds: ".$single_weather->getClouds();
                $text.="\nHumidity: ".$single_weather->getHumidity();
                $text.="\nMax temperature: ".$single_weather->getTempMax();
                $text.="\nMin temperature: ".$single_weather->getTempMin();
                $text.="\nAverage temperature: ".$single_weather->getTempAvg();
                $text.="\nWeather description: ".$single_weather->getWeatherDescription();
                $text.="\nWeather name: ".$single_weather->getWeatherName();
                $text.="\nTime Zone: ".$single_weather->getTimezone();
                $text.="\nLocation: ".$single_weather->getLocation()."\n\n";
            }
            $output->writeln($text);
            return Command::SUCCESS;
        }

        return Command::FAILURE;
    }
}

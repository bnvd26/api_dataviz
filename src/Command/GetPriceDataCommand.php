<?php


namespace App\Command;

use App\Repository\ParisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Goutte\Client;

class GetPriceDataCommand extends Command
{

    protected static $defaultName = 'app:getData';

    protected $em;

    protected $repository;

    public function __construct(EntityManagerInterface $em, ParisRepository $repository)
    {
        $this->em = $em;
        $this->repository = $repository;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Get cost of life (appartement and food) per borough in Paris')
            ->setHelp('This command allow you to get the needed data')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = new Client();
        // execution de la requete pour chaque arrondissement (BOOKING)
        for ($i = 1; $i <= 20; $i++) {
            // l'url de booking, l'arguement dest_id est celui a changer pour modifier l'arrondissement
            $url = 'https://www.booking.com/searchresults.fr.html?label=gen173nr-1FCAcoTUIVcGFyaXNfbG91dnJlLWNoYXRlbGV0SA1YBGhNiAEBmAENuAEHyAEM2AEB6AEB-AECiAIBqAIDuAL8yKjxBcACAQ&lang=fr&sid=b8474ce588f66a667360d904304722f0&sb=1&sb_lp=1&src=district&src_elem=sb&error_url=https%3A%2F%2Fwww.booking.com%2Fdistrict%2Ffr%2Fparis%2Flouvre-chatelet.fr.html%3Flabel%3Dgen173nr-1FCAcoTUIVcGFyaXNfbG91dnJlLWNoYXRlbGV0SA1YBGhNiAEBmAENuAEHyAEM2AEB6AEB-AECiAIBqAIDuAL8yKjxBcACAQ%3Bsid%3Db8474ce588f66a667360d904304722f0%3Binac%3D0%26%3B&sr_autoscroll=1&ss=1er+arr.&is_ski_area=0&ssne=1er+arr.&ssne_untouched=1er+arr.&dest_id=' . $i . '&dest_type=district&checkin_year=2020&checkin_month=7&checkin_monthday=28&checkout_year=2020&checkout_month=7&checkout_monthday=29&group_adults=1&group_children=0&no_rooms=1&b_h4u_keep_filters=&from_sf=1#frm';
            $crawler =  $client->request('GET', $url);
            // $total est le cumul des prix
            $total = 0;
            // $prices est le nombre de prix qu'il y a sur la page
            $prices = 0;

            // On récupère prix par prix pour ensuite faire une moyenne
            foreach ($crawler->filter('.bui-price-display__value') as $price) {
                $prices++;
                $price = $price->nodeValue;
                $price = \substr($price, 6);
                $price = \rtrim($price);
                if (\is_numeric($price)) {
                    $total += $price;
                }
            }
            $current = $this->repository->findByDistrict(75000+$i);
            $current->setAverageHotelPrice($total/$prices);
            $current->setCostPerDay($total/$prices);
        }

        // Récupération des prix des restos
        for ($i = 1; $i <= 20; $i++) {
            $url = $i < 10 ? 'http://www.restovisio.com/search?sq=&location=7500' . $i : 'http://www.restovisio.com/search?sq=&location=750' . $i;
            $crawler = $client->request('GET', $url);
            $total = 0;
            $prices = 0;
            foreach ($crawler->filter('.etb_price_range') as $range) {
                $prices++;
                $range = $range->nodeValue;
                // on transforme la fourchette de prix en un prix fixe pour permettre de faire une moyenne
                switch ($range){
                    case 'De 20 à 40€':
                        $price = 30;
                        break;
                    case 'Plus de 100€':
                        $price = 100;
                        break;
                    case 'Moins de 20€':
                        $price = 20;
                        break;
                    case 'Plus de 500€':
                        $price = 500;
                        break;
                    case 'De 300 à 400€':
                        $price = 350;
                        break;
                    case 'De 40 à 60€':
                        $price = 50;
                        break;
                    case 'De 80 à 100€':
                        $price = 90;
                        break;
                    case 'De 60 à 80€':
                        $price = 70;
                        break;
                    default:
                        $price = 0;
                        $prices--;
                        break;
                }
                $total += $price;
            }
            $current = $this->repository->findByDistrict(75000+$i);
            $current->setAverageRestaurantPrice($total/$prices);
            $cost = $current->getCostPerDay();
            $current->setCostPerDay($cost + $total/$prices * 2);
        }

        // nombre de stations de métro par arrondissement
        for ($i = 1; $i <= 20; $i++) {
            $url = $i == 1 ? 'https://fr.wikipedia.org/wiki/Cat%C3%A9gorie:Station_de_m%C3%A9tro_dans_le_1er_arrondissement_de_Paris' : 'https://fr.wikipedia.org/wiki/Cat%C3%A9gorie:Station_de_m%C3%A9tro_dans_le_' . $i . 'e_arrondissement_de_Paris';
            $crawler = $client->request('GET', $url);

            // le nombre de stations de métro dans un arrondissement
            $stations = \count($crawler->filter('.mw-category-group > ul > li'));
            $current = $this->repository->findByDistrict(75000+$i);
            $current->setSubwayStationsNumber($stations);
        }

        $this->em->flush();
        $output->writeln('Les données ont été ajoutées !');
        return 0;
    }

}
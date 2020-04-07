<?php


namespace App\DataFixtures;


use App\Entity\Infrastructure;
use App\Entity\Paris;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ParisFixtures extends Fixture
{

    // @ TODO fixtures for polygon (longitude et latitude)

    public function load(ObjectManager $em)
    {
        {
            $paris = new Paris();
            $paris->setDistrict('Paris 01');
            $paris->setBorough('75001');
            $em->persist($paris);
        }
        {
            $paris = new Paris();
            $paris->setDistrict('Paris 02');
            $paris->setBorough('75002');
            $em->persist($paris);
        }
        {
            $paris = new Paris();
            $paris->setDistrict('Paris 03');
            $paris->setBorough('75003');
            $em->persist($paris);
        }
        {
            $paris = new Paris();
            $paris->setDistrict('Paris 04');
            $paris->setBorough('75004');
            $em->persist($paris);
        }
        {
            $paris = new Paris();
            $paris->setDistrict('Paris 05');
            $paris->setBorough('75005');
            $em->persist($paris);
        }
        {
            $paris = new Paris();
            $paris->setDistrict('Paris 06');
            $paris->setBorough('75006');
            $em->persist($paris);
        }
        {
            $paris = new Paris();
            $paris->setDistrict('Paris 07');
            $paris->setBorough('75007');

            $infrastructure = new Infrastructure();
            $infrastructure->setPlace($paris);
            $infrastructure->setSports(['Natation en eau libre', 'Triathlon', 'Beach Volley']);
            $infrastructure->setSite('Tour Eiffel');

            $infrastructure1 = new Infrastructure();
            $infrastructure1->setPlace($paris);
            $infrastructure1->setSports(['Tir a l\'arc', 'Volley', 'Badminton', 'Tir']);
            $infrastructure1->setSite('Esplanade des Invalides');

            $em->persist($paris);
            $em->persist($infrastructure);
            $em->persist($infrastructure1);
        }
        {
            $paris = new Paris();
            $paris->setDistrict('Paris 08');
            $paris->setBorough('75008');

            $infrastructure = new Infrastructure();
            $infrastructure->setPlace($paris);
            $infrastructure->setSports(['Cyclisme sur route']);
            $infrastructure->setSite('Champs-Elysées');

            $infrastructure1 = new Infrastructure();
            $infrastructure1->setPlace($paris);
            $infrastructure1->setSports(['Escrime', 'Taekwondo']);
            $infrastructure1->setSite('Grand Palais');

            $em->persist($paris);
            $em->persist($infrastructure);
            $em->persist($infrastructure1);
        }
        {
            $paris = new Paris();
            $paris->setDistrict('Paris 09');
            $paris->setBorough('75009');
            $em->persist($paris);
        }
        {
            $paris = new Paris();
            $paris->setDistrict('Paris 10');
            $paris->setBorough('75010');
            $em->persist($paris);
        }
        {
            $paris = new Paris();
            $paris->setDistrict('Paris 11');
            $paris->setBorough('75011');
            $em->persist($paris);
        }
        {
            $paris = new Paris();
            $paris->setDistrict('Paris 12');
            $paris->setBorough('75012');

            $infrastructure = new Infrastructure();
            $infrastructure->setPlace($paris);
            $infrastructure->setSports(['Basket', 'Judo']);
            $infrastructure->setSite('Bercy - Accor Hotels Arena');

            $em->persist($paris);
            $em->persist($infrastructure);
        }
        {
            $paris = new Paris();
            $paris->setDistrict('Paris 13');
            $paris->setBorough('75013');
            $em->persist($paris);
        }
        {
            $paris = new Paris();
            $paris->setDistrict('Paris 14');
            $paris->setBorough('75014');
            $em->persist($paris);
        }
        {
            $paris = new Paris();
            $paris->setDistrict('Paris 15');
            $paris->setBorough('75015');

            $infrastructure = new Infrastructure();
            $infrastructure->setPlace($paris);
            $infrastructure->setSports(['Handball', 'Tennis de table']);
            $infrastructure->setSite('Parc des expositions de la porte de Versailles');

            $em->persist($paris);
            $em->persist($infrastructure);
        }
        {
            $paris = new Paris();
            $paris->setDistrict('Paris 16');
            $paris->setBorough('75016');

            $infrastructure = new Infrastructure();
            $infrastructure->setPlace($paris);
            $infrastructure->setSports(['Football']);
            $infrastructure->setSite('Parc des princes');

            $infrastructure1 = new Infrastructure();
            $infrastructure1->setPlace($paris);
            $infrastructure1->setSports(['Rugby à VII']);
            $infrastructure1->setSite('Stade Jean Bouin');

            $infrastructure2 = new Infrastructure();
            $infrastructure2->setPlace($paris);
            $infrastructure2->setSports(['Tennis']);
            $infrastructure2->setSite('Rolland-Garros');

            $em->persist($paris);
            $em->persist($infrastructure);
            $em->persist($infrastructure1);
            $em->persist($infrastructure2);
        }
        {
            $paris = new Paris();
            $paris->setDistrict('Paris 17');
            $paris->setBorough('75017');
            $em->persist($paris);
        }
        {
            $paris = new Paris();
            $paris->setDistrict('Paris 18');
            $paris->setBorough('75018');

            $infrastructure = new Infrastructure();
            $infrastructure->setPlace($paris);
            $infrastructure->setSports(['Lutte', 'Basket']);
            $infrastructure->setSite('Arena II Bercy');

            $em->persist($paris);
            $em->persist($infrastructure);
        }
        {
            $paris = new Paris();
            $paris->setDistrict('Paris 19');
            $paris->setBorough('75019');

            $infrastructure = new Infrastructure();
            $infrastructure->setPlace($paris);
            $infrastructure->setSports(['Haltérophilie']);
            $infrastructure->setSite('Zenith de Paris');

            $em->persist($paris);
            $em->persist($infrastructure);
        }
        {
            $paris = new Paris();
            $paris->setDistrict('Paris 20');
            $paris->setBorough('75020');
            $em->persist($paris);
        }

        $em->flush();
    }
}
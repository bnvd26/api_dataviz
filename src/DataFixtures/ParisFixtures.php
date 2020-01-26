<?php


namespace App\DataFixtures;


use App\Entity\Infrastructure;
use App\Entity\Paris;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ParisFixtures extends Fixture
{
    public function load(ObjectManager $em)
    {
        {
            $paris = new Paris();
            $paris->setDistrict('Paris 01');
            $paris->setCountHotel('77');
            $paris->setBorough('75001');
            $paris->setLatitude('48.8625627018');
            $paris->setLongitude('2.33644336205');
            $em->persist($paris);
        }
        {
            $paris = new Paris();
            $paris->setDistrict('Paris 02');
            $paris->setCountHotel('40');
            $paris->setBorough('75002');
            $paris->setLatitude('48.8682792225');
            $paris->setLongitude('2.34280254689');
            $em->persist($paris);
        }
        {
            $paris = new Paris();
            $paris->setDistrict('Paris 03');
            $paris->setCountHotel('22');
            $paris->setBorough('75003');
            $paris->setLatitude('48.86287238');
            $paris->setLongitude('2.3600009859');
            $em->persist($paris);
        }
        {
            $paris = new Paris();
            $paris->setDistrict('Paris 04');
            $paris->setCountHotel('25');
            $paris->setBorough('75004');
            $paris->setLatitude('48.8543414263');
            $paris->setLongitude('2.35762962032');
            $em->persist($paris);
        }
        {
            $paris = new Paris();
            $paris->setDistrict('Paris 05');
            $paris->setCountHotel('63');
            $paris->setBorough('75005');
            $paris->setLatitude('48.8444431505');
            $paris->setLongitude('2.35071460958');
            $em->persist($paris);
        }
        {
            $paris = new Paris();
            $paris->setDistrict('Paris 06');
            $paris->setCountHotel('76');
            $paris->setBorough('75006');
            $paris->setLatitude('48.8491303586');
            $paris->setLongitude('2.33289799905');
            $em->persist($paris);
        }
        {
            $paris = new Paris();
            $paris->setDistrict('Paris 07');
            $paris->setCountHotel('50');
            $paris->setBorough('75007');
            $paris->setLatitude('48.8561744288');
            $paris->setLongitude('2.31218769148');

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
            $paris->setCountHotel('143');
            $paris->setBorough('75008');
            $paris->setLatitude('48.8727208374');
            $paris->setLongitude('2.3125540224');

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
            $paris->setCountHotel('157');
            $paris->setBorough('75009');
            $paris->setLatitude('48.8771635173');
            $paris->setLongitude('2.33745754348');
            $em->persist($paris);
        }
        {
            $paris = new Paris();
            $paris->setDistrict('Paris 10');
            $paris->setCountHotel('100');
            $paris->setBorough('75010');
            $paris->setLatitude('48.8761300365');
            $paris->setLongitude('2.36072848785');
            $em->persist($paris);
        }
        {
            $paris = new Paris();
            $paris->setDistrict('Paris 11');
            $paris->setCountHotel('62');
            $paris->setBorough('75011');
            $paris->setLatitude('48.8590592213');
            $paris->setLongitude('2.3800583082');
            $em->persist($paris);
        }
        {
            $paris = new Paris();
            $paris->setDistrict('Paris 12');
            $paris->setCountHotel('70');
            $paris->setBorough('75012');
            $paris->setLatitude('48.8349743815');
            $paris->setLongitude('2.42132490078');

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
            $paris->setCountHotel('43');
            $paris->setBorough('75013');
            $paris->setLatitude('48.8283880317');
            $paris->setLongitude('2.36227244042');
            $em->persist($paris);
        }
        {
            $paris = new Paris();
            $paris->setDistrict('Paris 14');
            $paris->setCountHotel('85');
            $paris->setBorough('75014');
            $paris->setLatitude('48.8292445005');
            $paris->setLongitude('2.3265420442');
            $em->persist($paris);
        }
        {
            $paris = new Paris();
            $paris->setDistrict('Paris 15');
            $paris->setCountHotel('89');
            $paris->setBorough('75015');
            $paris->setLatitude('48.8400853759');
            $paris->setLongitude('2.29282582242');

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
            $paris->setCountHotel('66');
            $paris->setBorough('75016');
            $paris->setLatitude('48.8603921054');
            $paris->setLongitude('2.26197078836');

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
            $paris->setCountHotel('115');
            $paris->setBorough('75017');
            $paris->setLatitude('48.887326522');
            $paris->setLongitude('2.30677699057');
            $em->persist($paris);
        }
        {
            $paris = new Paris();
            $paris->setDistrict('Paris 18');
            $paris->setCountHotel('59');
            $paris->setBorough('75018');
            $paris->setLatitude('48.892569268');
            $paris->setLongitude('2.34816051956');

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
            $paris->setCountHotel('25');
            $paris->setBorough('75019');
            $paris->setLatitude('48.8870759966');
            $paris->setLongitude('2.38482096015');

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
            $paris->setCountHotel('25');
            $paris->setBorough('75020');
            $paris->setLatitude('48.8634605789');
            $paris->setLongitude('2.40118812928');
            $em->persist($paris);
        }

        $em->flush();
    }
}
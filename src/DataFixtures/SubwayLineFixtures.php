<?php

namespace App\DataFixtures;

use App\Repository\ParisRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\SubwayLine;

class SubwayLineFixtures extends Fixture
{

    /* @var ParisRepository $parisRepository*/
    private $parisRepository;

    public function __construct(ParisRepository $parisRepository)
    {
        $this->parisRepository = $parisRepository;
    }

    public function load(ObjectManager $em)
    {
        $repo = $this->parisRepository;

        $line = new SubwayLine();
        $line->setName('A');
        $boroughs = [75001,75008,75009,75011];
        foreach ($boroughs as $borough) {
            $line->addBorough($repo->findByDistrict($borough));
        }
        $em->persist($line);

        $line = new SubwayLine();
        $line->setName('B');
        $boroughs = [75001,75005,75010,75018];
        foreach ($boroughs as $borough) {
            $line->addBorough($repo->findByDistrict($borough));
        }
        $em->persist($line);

        $line = new SubwayLine();
        $line->setName('C');
        $boroughs = [75005,75007,75013,75015,75016];
        foreach ($boroughs as $borough) {
            $line->addBorough($repo->findByDistrict($borough));
        }
        $em->persist($line);

        $line = new SubwayLine();
        $line->setName('D');
        $boroughs = [75001,75010,75012,75018];
        foreach ($boroughs as $borough) {
            $line->addBorough($repo->findByDistrict($borough));
        }
        $em->persist($line);

        $line = new SubwayLine();
        $line->setName('E');
        $boroughs = [75008,75009,75010,75018];
        foreach ($boroughs as $borough) {
            $line->addBorough($repo->findByDistrict($borough));
        }
        $em->persist($line);

        $line = new SubwayLine();
        $line->setName('1');
        $boroughs = [75001,75004,75008,75011,75012,75016,75017,75020];
        foreach ($boroughs as $borough) {
            $line->addBorough($repo->findByDistrict($borough));
        }
        $em->persist($line);

        $line = new SubwayLine();
        $line->setName('2');
        $boroughs = [75008,75009,75010,75011,75012,75016,75017,75018,75019,75020];
        foreach ($boroughs as $borough) {
            $line->addBorough($repo->findByDistrict($borough));
        }
        $em->persist($line);

        $line = new SubwayLine();
        $line->setName('3');
        $boroughs = [75002,75003,75008,75009,75010,75011,75017,75020];
        foreach ($boroughs as $borough) {
            $line->addBorough($repo->findByDistrict($borough));
        }
        $em->persist($line);

        $line = new SubwayLine();
        $line->setName('3bis');
        $boroughs = [75019,75020];
        foreach ($boroughs as $borough) {
            $line->addBorough($repo->findByDistrict($borough));
        }
        $em->persist($line);

        $line = new SubwayLine();
        $line->setName('4');
        $boroughs = [75001,75002,75003,75004,75005,75006,75009,75010,75014,75015,75018];
        foreach ($boroughs as $borough) {
            $line->addBorough($repo->findByDistrict($borough));
        }
        $em->persist($line);

        $line = new SubwayLine();
        $line->setName('5');
        $boroughs = [75003,75004,75005,75010,75011,75012,75013,75019];
        foreach ($boroughs as $borough) {
            $line->addBorough($repo->findByDistrict($borough));
        }
        $em->persist($line);

        $line = new SubwayLine();
        $line->setName('6');
        $boroughs = [75007,75008,75011,75012,75013,75014,75015,75016,75017];
        foreach ($boroughs as $borough) {
            $line->addBorough($repo->findByDistrict($borough));
        }
        $em->persist($line);

        $line = new SubwayLine();
        $line->setName('7');
        $boroughs = [75001,75002,75004,75005,75009,75010,75013,75019];
        foreach ($boroughs as $borough) {
            $line->addBorough($repo->findByDistrict($borough));
        }
        $em->persist($line);

        $line = new SubwayLine();
        $line->setName('7bis');
        $boroughs = [75010,75019];
        foreach ($boroughs as $borough) {
            $line->addBorough($repo->findByDistrict($borough));
        }
        $em->persist($line);

        $line = new SubwayLine();
        $line->setName('8');
        $boroughs = [75001,75002,75003,75004,75007,75008,75009,75010,75011,75012,75015];
        foreach ($boroughs as $borough) {
            $line->addBorough($repo->findByDistrict($borough));
        }
        $em->persist($line);

        $line = new SubwayLine();
        $line->setName('9');
        $boroughs = [75002,75003,75008,75009,75010,75011,75012,75016,75020];
        foreach ($boroughs as $borough) {
            $line->addBorough($repo->findByDistrict($borough));
        }

        $em->persist($line);
        $line = new SubwayLine();
        $line->setName('10');
        $boroughs = [75005,75006,75007,75013,75015,75016];
        foreach ($boroughs as $borough) {
            $line->addBorough($repo->findByDistrict($borough));
        }
        $em->persist($line);

        $em->persist($line);
        $line = new SubwayLine();
        $line->setName('11');
        $boroughs = [75001,75003,75004,75010,75011,75019,75020];
        foreach ($boroughs as $borough) {
            $line->addBorough($repo->findByDistrict($borough));
        }
        $em->persist($line);

        $em->persist($line);
        $line = new SubwayLine();
        $line->setName('12');
        $boroughs = [75006,75007,75008,75009,75014,75015,75018];
        foreach ($boroughs as $borough) {
            $line->addBorough($repo->findByDistrict($borough));
        }
        $em->persist($line);

        $em->persist($line);
        $line = new SubwayLine();
        $line->setName('13');
        $boroughs = [75006,75007,75008,75009,75014,75015,75017,75018];
        foreach ($boroughs as $borough) {
            $line->addBorough($repo->findByDistrict($borough));
        }
        $em->persist($line);

        $em->persist($line);
        $line = new SubwayLine();
        $line->setName('14');
        $boroughs = [75001,75004,75008,75009,75012,75013];
        foreach ($boroughs as $borough) {
            $line->addBorough($repo->findByDistrict($borough));
        }
        $em->persist($line);

        $em->flush();
    }
}
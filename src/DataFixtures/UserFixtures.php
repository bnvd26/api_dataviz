<?php
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $em)
    {
        {
            $user = new User();
            $user->setUsername('parisgo');
            $user->setPassword('$2y$10$Da7vONvaoTAI8cNDjmRjrOW4DMJuV.HOkiE2tA5tu24YHJaXFEp7O');
            $user->setRoles(['ROLE_ADMIN']);
            $em->persist($user);
        }
        $em->flush();
    }
}
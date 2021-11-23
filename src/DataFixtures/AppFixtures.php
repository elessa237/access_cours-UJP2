<?php

namespace App\DataFixtures;

use App\Entity\Utilisateur\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hashPassword;

    public function __construct(UserPasswordHasherInterface $hashPassword)
    {
        $this->hashPassword = $hashPassword;
    }


    public function load(ObjectManager $manager): void
    {
        $administrateur = new Utilisateur();
        $password = $this->hashPassword->hashPassword($administrateur, 'demo');

        $administrateur->setNom('Elessa')
            ->setPrenom('Charles')
            ->setEmail('elessa@demo.com')
            ->setNumeroTelephone('659019493')
            ->setPassword($password)
            ->setRoles(["ROLE_ADMIN"])
            ->setPoste('RECTEUR');

        $manager->persist($administrateur);

        $manager->flush();
    }
}

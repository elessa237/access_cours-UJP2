<?php


namespace App\Service;


use App\Entity\Utilisateur\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UtilisateurService
{
    private EntityManagerInterface $manager;
    private UserPasswordHasherInterface $hasher;

    public function __construct(EntityManagerInterface $manager, UserPasswordHasherInterface $hasher)
    {
        $this->manager = $manager;
        $this->hasher = $hasher;
    }

    /**
     * @param Utilisateur $enseignant
     * @param $form
     * @return void
     */
    public function createTeacher(Utilisateur $enseignant, $form) : void
    {
        $enseignant->setRoles(["ROLE_ENSEIGNANT"])
            ->setPoste("ENSEIGNANT")
            ->setPassword(
                $this->hasher->hashPassword(
                    $enseignant,
                    $form->get('password')->getData()
                )
            );
        $this->manager->persist($enseignant);
        $this->manager->flush();
    }

    /**
     * @param Utilisateur $enseignant
     * @return void
     */
    public function removeTeacher(Utilisateur $enseignant) : void
    {
        $this->manager->remove($enseignant);
        $this->manager->flush();
    }
}
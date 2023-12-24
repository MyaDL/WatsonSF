<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsersFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager): void
    {

        $admin = new User();
        $admin->setEmail('admin@admin.fr');
        $admin->setRoles(['ROLE_ADMIN']);

        $encodedPassword = $this->passwordEncoder->encodePassword($admin, 'admin123');
        $admin->setPassword($encodedPassword);

        $manager->persist($admin);

        $user = new User();
        $user->setEmail('user@user.fr');
        $user->setRoles(['ROLE_USER']);

        $encodedPassword = $this->passwordEncoder->encodePassword($user, 'user123');
        $user->setPassword($encodedPassword);
        
        $manager->persist($user);

        $manager->flush();
    }
}

<?php

namespace App\DataFixtures;


use Faker\Factory;
use App\Entity\User;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    const DEFAULT_USER = ["email" => "romeorazaf@gmail.com", "password" => "admin", "username" => "Romy"];
    protected $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        $defaultUser = new User();
        $passHash = $this->encoder->encodePassword($defaultUser, self::DEFAULT_USER["password"]);

        $defaultUser->setEmail(self::DEFAULT_USER["email"])
                    ->setPassword($passHash)
                    ->setUsername(self::DEFAULT_USER["username"]);

        $manager->persist($defaultUser);

        for ($u=0; $u < 10; $u++) { 
            $user = new User;

            $passHash = $this->encoder->encodePassword($user, "password");

            $user->setEmail($faker->email)
                ->setPassword($passHash)
                ->setUsername($faker->name());

            if ($u % 3 === 0) {
                $user->setStatus(false)
                    ->setAge(23);
            }

            $manager->persist($user);

            for ($a=0; $a < random_int(5,15); $a++) { 
                $product = (new Product())->setAuthor($user)
                                        ->setDescription($faker->text(300))
                                        ->setTitle($faker->text(50))
                                        ->setPrice($faker->randomFloat(50, 100000))
                                        ->setQuantity(random_int(1,1000));
                
                $manager->persist($product);
            }
        }

        $manager->flush();
    }
}

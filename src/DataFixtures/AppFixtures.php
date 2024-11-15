<?php

namespace App\DataFixtures;

use App\Entity\Voiture;
use App\Entity\Images;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 5; $i++) {
            $voiture = new Voiture();
            $voiture->setMarque($faker->company);
            $voiture->setModele($faker->word);
            $voiture->setImage($faker->imageUrl(640, 480, 'cars', true));
            $voiture->setKm($faker->numberBetween(10000, 200000));
            $voiture->setPrix($faker->randomFloat(2, 5000, 50000));
            $voiture->setNombreProprietaires($faker->numberBetween(1, 3));
            $voiture->setCylindree($faker->randomElement(['1.2L', '1.6L', '2.0L']));
            $voiture->setPuissance($faker->numberBetween(100, 300) . 'hp');
            $voiture->setCarburant($faker->randomElement(['Essence', 'Diesel', 'Hybride', 'Électrique']));
            $voiture->setAnneeMiseEnCirculation($faker->year);
            $voiture->setTransmission($faker->randomElement(['Automatique', 'Manuelle']));
            $voiture->setDescription($faker->paragraph);
            $voiture->setOptions($faker->text);

            // Ajouter des images associées à chaque voiture
            for ($j = 0; $j < 3; $j++) {
                $image = new Images();
                $image->setPath($faker->imageUrl(640, 480, 'cars', true));
                $image->setVoiture($voiture);
                $manager->persist($image);
            }

            $manager->persist($voiture);
        }

        $manager->flush();
    }
}
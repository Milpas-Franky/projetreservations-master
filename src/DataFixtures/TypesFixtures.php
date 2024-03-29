<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Types;
class TypesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
           $types = [
            ['type'=>'comédien'],
            ['type'=>'scénographe'],
            ['type'=>'auteur'],
        ];
        
        foreach ($types as $record) {
            $type = new Types();
            $type->setType($record['type']);
            
            $manager->persist($type);
			$this->addReference($record['type'],$type);
        }

        $manager->flush();
    }
}

<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Roles;
class RolesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
                 $roles = [
            ['role'=>'admin'],
            ['role'=>'member'],
            ['role'=>'affiliate'],
        ];
        
        foreach ($roles as $record) {
            $role = new Roles();
            $role->setRole($record['role']);
            
            $manager->persist($role);
			$this->addReference($record['role'],$role);
        }

        $manager->flush();
    }
}

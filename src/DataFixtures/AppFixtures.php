<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $victor = new Author();
        $victor->setName('Victor Hugo');
        $manager->persist($victor);

        $book = new Book();
        $book->setTitle('Les Misérables');
        $book->setAuthor($victor);
        $manager->persist($book);

        $book = new Book();
        $book->setTitle('Les Travailleurs de la mer');
        $book->setAuthor($victor);
        $manager->persist($book);

        $book = new Book();
        $book->setTitle('Notre-Dame de Paris');
        $book->setAuthor($victor);
        $manager->persist($book);

        $charles = new Author();
        $charles->setName('Charles Baudelaire');
        $manager->persist($charles);

        $book = new Book();
        $book->setTitle('Les Fleurs du mal');
        $book->setAuthor($charles);
        $manager->persist($book);

        $book = new Book();
        $book->setTitle('Les Paradis artificiels');
        $book->setAuthor($charles);
        $manager->persist($book);

        $book = new Book();
        $book->setTitle('Le Spleen de Paris');
        $book->setAuthor($charles);
        $manager->persist($book);

        $manager->flush();
    }
}

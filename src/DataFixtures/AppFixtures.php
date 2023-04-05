<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Plat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $categorie1 = new Categorie();
        $categorie1->setLibelle('Pizza')
                   ->setImage('pizza_cat.jpg')
                   ->setActive('Yes');
        $manager->persist($categorie1);

        $categorie2 = new Categorie();
        $categorie2->setLibelle('Burger')
                   ->setImage('burger_cat.jpg')
                   ->setActive('Yes');
        $manager->persist($categorie2);

        $categorie3 = new Categorie();
        $categorie3->setLibelle('Wraps')
                   ->setImage('wrap_cat.jpg')
                   ->setActive('Yes');
        $manager->persist($categorie3);

        $categorie4 = new Categorie();
        $categorie4->setLibelle('Pasta')
                   ->setImage('pasta_cat.jpg')
                   ->setActive('Yes');
        $manager->persist($categorie4);

        $categorie5 = new Categorie();
        $categorie5->setLibelle('Sandwich')
                   ->setImage('sandwich_cat.jpg')
                   ->setActive('Yes');
        $manager->persist($categorie5);

        $categorie6 = new Categorie();
        $categorie6->setLibelle('Asian Food')
                   ->setImage('asian_food_cat.jpg')
                   ->setActive('No');
        $manager->persist($categorie6);

        $categorie7 = new Categorie();
        $categorie7->setLibelle('Salade')
                   ->setImage('salade_cat.jpg')
                   ->setActive('Yes');
        $manager->persist($categorie7);

        $categorie8 = new Categorie();
        $categorie8->setLibelle('Veggie')
                   ->setImage('veggie_cat.jpg')
                   ->setActive('Yes');
        $manager->persist($categorie8);

        $plat1 = new Plat();
        $plat1->setLibelle('District Burger')
              ->setDescription('Burger composé d’un bun’s du boulanger, deux steaks de 80g (origine française), de deux tranches poitrine de porc fumée, de deux tranches cheddar affiné, salade et oignons confits.')
              ->setPrix(8)
              ->setImage('hamburger.jpg')
              ->setCategorie($categorie2)
              ->setActive('Yes');
        $manager->persist($plat1);

        $plat2 = new Plat();
        $plat2->setLibelle('Pizza Bianca')
              ->setDescription('Une pizza fine et croustillante garnie de crème mascarpone légèrement citronnée et de tranches de saumon fumé, le tout relevé de baies roses et de basilic frais.')
              ->setPrix(14)
              ->setimage('pizza-salmon.png')
              ->setCategorie($categorie1)
              ->setActive('Yes');
        $manager->persist($plat2);

        $plat3 = new Plat();
        $plat3->setLibelle('Buffalo Chicken Wrap')
              ->setDescription('Du bon filet de poulet mariné dans notre spécialité sucrée & épicée, enveloppé dans une tortilla blanche douce faite maison.')
              ->setPrix(5)
              ->setimage('buffalo-chicken.webp')
              ->setCategorie($categorie3)
              ->setActive('Yes');
        $manager->persist($plat3);

        $plat4 = new Plat();
        $plat4->setLibelle('Cheeseburger')
              ->setDescription('Burger composé d’un bun’s du boulanger, de salade, oignons rouges, pickles, oignon confit, tomate, d’un steak d’origine Française, d’une tranche de cheddar affiné, et de notre sauce maison.')
              ->setPrix(8)
              ->setimage('cheesburger.jpg')
              ->setCategorie($categorie2)
              ->setActive('Yes');
        $manager->persist($plat4);

        $plat5 = new Plat();
        $plat5->setLibelle('Spaghetti aux légumes')
              ->setDescription('Un plat de spaghetti au pesto de basilic et légumes poêlés, très parfumé et rapide.')
              ->setPrix(10)
              ->setimage('spaghetti-legumes.jpg')
              ->setCategorie($categorie4)
              ->setActive('Yes');
        $manager->persist($plat5);

        $plat6 = new Plat();
        $plat6->setLibelle('Salade César')
              ->setDescription('Une délicieuse salade Caesar (César) composée de filets de poulet grillés, de feuilles croquantes de salade romaine, de croutons à l\'ail, de tomates cerise et surtout de sa fameuse sauce Caesar. Le tout agrémenté de copeaux de parmesan.')
              ->setPrix(7)
              ->setimage('cesar_salad.jpg')
              ->setCategorie($categorie7)
              ->setActive('Yes');
        $manager->persist($plat6);

        $plat7 = new Plat();
        $plat7->setLibelle('Pizza Margherita')
              ->setDescription('Une authentique pizza margarita, un classique de la cuisine italienne! Une pâte faite maison, une sauce tomate fraîche, de la mozzarella Fior di latte, du basilic, origan, ail, sucre, sel & poivre...')
              ->setPrix(14)
              ->setimage('pizza-margherita.jpg')
              ->setCategorie($categorie1)
              ->setActive('Yes');
        $manager->persist($plat7);

        $plat8 = new Plat();
        $plat8->setLibelle('Courgettes farcies au quinoa et duxelles de champignons')
              ->setDescription('Voici une recette équilibrée à base de courgettes, quinoa et champignons, 100% vegan et sans gluten!')
              ->setPrix(8)
              ->setimage('courgettes_farcies.jpg')
              ->setCategorie($categorie8)
              ->setActive('Yes');
        $manager->persist($plat8);

        $plat9 = new Plat();
        $plat9->setLibelle('Lasagnes')
              ->setDescription('Découvrez notre recette des lasagnes, l\'une des spécialités italiennes que tout le monde aime avec sa viande hachée et gratinée à l\'emmental. Et bien sûr, une inoubliable béchamel à la noix de muscade.')
              ->setPrix(12)
              ->setimage('lasagnes_viande.jpg')
              ->setCategorie($categorie4)
              ->setActive('Yes');
        $manager->persist($plat9);

        $plat10 = new Plat();
        $plat10->setLibelle('Tagliatelles au saumon')
              ->setDescription('Découvrez notre recette délicieuse de tagliatelles au saumon frais et à la crème qui qui vous assure un véritable régal!')
              ->setPrix(12)
              ->setimage('tagliatelles_saumon.webp')
              ->setCategorie($categorie4)
              ->setActive('Yes');
        $manager->persist($plat10);

        
        $manager->flush();
    }
}

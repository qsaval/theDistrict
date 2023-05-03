<?php

namespace App\DataFixtures;

use App\Entity\Plat;
use App\Entity\User;
use App\Entity\Detail;
use App\Entity\Commande;
use App\Entity\Categorie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
      public function load(ObjectManager $manager): void
      {
            $categorie1 = new Categorie();
            $categorie1->setLibelle('Pizza')
                  ->setImage('pizza_cat.jpg')
                  ->setActive(true);
            $manager->persist($categorie1);

            $categorie2 = new Categorie();
            $categorie2->setLibelle('Burger')
                  ->setImage('burger_cat.jpg')
                  ->setActive(true);
            $manager->persist($categorie2);

            $categorie3 = new Categorie();
            $categorie3->setLibelle('Wraps')
                  ->setImage('wrap_cat.jpg')
                  ->setActive(true);
            $manager->persist($categorie3);

            $categorie4 = new Categorie();
            $categorie4->setLibelle('Pasta')
                  ->setImage('pasta_cat.jpg')
                  ->setActive(true);
            $manager->persist($categorie4);

            $categorie5 = new Categorie();
            $categorie5->setLibelle('Sandwich')
                  ->setImage('sandwich_cat.jpg')
                  ->setActive(true);
            $manager->persist($categorie5);

            $categorie6 = new Categorie();
            $categorie6->setLibelle('Asian Food')
                  ->setImage('asian_food_cat.jpg')
                  ->setActive(false);
            $manager->persist($categorie6);

            $categorie7 = new Categorie();
            $categorie7->setLibelle('Salade')
                  ->setImage('salade_cat.jpg')
                  ->setActive(true);
            $manager->persist($categorie7);

            $categorie8 = new Categorie();
            $categorie8->setLibelle('Veggie')
                  ->setImage('veggie_cat.jpg')
                  ->setActive(true);
            $manager->persist($categorie8);

            $plat1 = new Plat();
            $plat1->setLibelle('District Burger')
                  ->setDescription('Burger composé d’un bun’s du boulanger, deux steaks de 80g (origine française), de deux tranches poitrine de porc fumée, de deux tranches cheddar affiné, salade et oignons confits.')
                  ->setPrix(8)
                  ->setImage('hamburger.jpg')
                  ->setCategorie($categorie2)
                  ->setActive(true);
            $manager->persist($plat1);

            $plat2 = new Plat();
            $plat2->setLibelle('Pizza Bianca')
                  ->setDescription('Une pizza fine et croustillante garnie de crème mascarpone légèrement citronnée et de tranches de saumon fumé, le tout relevé de baies roses et de basilic frais.')
                  ->setPrix(14)
                  ->setimage('pizza-salmon.png')
                  ->setCategorie($categorie1)
                  ->setActive(true);
            $manager->persist($plat2);

            $plat3 = new Plat();
            $plat3->setLibelle('Buffalo Chicken Wrap')
                  ->setDescription('Du bon filet de poulet mariné dans notre spécialité sucrée & épicée, enveloppé dans une tortilla blanche douce faite maison.')
                  ->setPrix(5)
                  ->setimage('buffalo-chicken.jpg')
                  ->setCategorie($categorie3)
                  ->setActive(true);
            $manager->persist($plat3);

            $plat4 = new Plat();
            $plat4->setLibelle('Cheeseburger')
                  ->setDescription('Burger composé d’un bun’s du boulanger, de salade, oignons rouges, pickles, oignon confit, tomate, d’un steak d’origine Française, d’une tranche de cheddar affiné, et de notre sauce maison.')
                  ->setPrix(8)
                  ->setimage('cheesburger.jpg')
                  ->setCategorie($categorie2)
                  ->setActive(true);
            $manager->persist($plat4);

            $plat5 = new Plat();
            $plat5->setLibelle('Spaghetti aux légumes')
                  ->setDescription('Un plat de spaghetti au pesto de basilic et légumes poêlés, très parfumé et rapide.')
                  ->setPrix(10)
                  ->setimage('spaghetti-legumes.jpg')
                  ->setCategorie($categorie4)
                  ->setActive(true);
            $manager->persist($plat5);

            $plat6 = new Plat();
            $plat6->setLibelle('Salade César')
                  ->setDescription('Une délicieuse salade Caesar (César) composée de filets de poulet grillés, de feuilles croquantes de salade romaine, de croutons à l\'ail, de tomates cerise et surtout de sa fameuse sauce Caesar. Le tout agrémenté de copeaux de parmesan.')
                  ->setPrix(7)
                  ->setimage('cesar_salad.jpg')
                  ->setCategorie($categorie7)
                  ->setActive(true);
            $manager->persist($plat6);

            $plat7 = new Plat();
            $plat7->setLibelle('Pizza Margherita')
                  ->setDescription('Une authentique pizza margarita, un classique de la cuisine italienne! Une pâte faite maison, une sauce tomate fraîche, de la mozzarella Fior di latte, du basilic, origan, ail, sucre, sel & poivre...')
                  ->setPrix(14)
                  ->setimage('pizza-margherita.jpg')
                  ->setCategorie($categorie1)
                  ->setActive(true);
            $manager->persist($plat7);

            $plat8 = new Plat();
            $plat8->setLibelle('Courgettes farcies au quinoa et duxelles de champignons')
                  ->setDescription('Voici une recette équilibrée à base de courgettes, quinoa et champignons, 100% vegan et sans gluten!')
                  ->setPrix(8)
                  ->setimage('courgettes_farcies.jpg')
                  ->setCategorie($categorie8)
                  ->setActive(true);
            $manager->persist($plat8);

            $plat9 = new Plat();
            $plat9->setLibelle('Lasagnes')
                  ->setDescription('Découvrez notre recette des lasagnes, l\'une des spécialités italiennes que tout le monde aime avec sa viande hachée et gratinée à l\'emmental. Et bien sûr, une inoubliable béchamel à la noix de muscade.')
                  ->setPrix(12)
                  ->setimage('lasagnes_viande.jpg')
                  ->setCategorie($categorie4)
                  ->setActive(true);
            $manager->persist($plat9);

            $plat10 = new Plat();
            $plat10->setLibelle('Tagliatelles au saumon')
                  ->setDescription('Découvrez notre recette délicieuse de tagliatelles au saumon frais et à la crème qui qui vous assure un véritable régal!')
                  ->setPrix(12)
                  ->setimage('tagliatelles-saumon.webp')
                  ->setCategorie($categorie4)
                  ->setActive(true);
            $manager->persist($plat10);

            $detail1 = new Detail();
            $detail1->setQuantite(4)
                  ->setPlat($plat1);
            $manager->persist($detail1);

            $detail2 = new Detail();
            $detail2->setQuantite(2)
                  ->setPlat($plat2);
            $manager->persist($detail2);

            $detail3 = new Detail();
            $detail3->setQuantite(1)
                  ->setPlat($plat2);
            $manager->persist($detail3);

            $detail4 = new Detail();
            $detail4->setQuantite(1);
            $detail4->setPlat($plat3);
            $manager->persist($detail4);

            $detail5 = new Detail();
            $detail5->setQuantite(2)
                  ->setPlat($plat4);
            $manager->persist($detail5);

            $detail6 = new Detail();
            $detail6->setQuantite(1)
                  ->setPlat($plat7);
            $manager->persist($detail6);

            $detail7 = new Detail();
            $detail7->setQuantite(4)
                  ->setPlat($plat3);
            $manager->persist($detail7);

            $detail8 = new Detail();
            $detail8->setQuantite(1)
                  ->setPlat($plat9);
            $manager->persist($detail8);

            $commande1 = new Commande();
            $commande1->setDateCommande(new \DateTimeImmutable('2020-11-30 03:52:43'))
                  ->setTotal(16)
                  ->setEtat(3)
                  ->addDetail($detail1);
            $manager->persist($commande1);

            $commande2 = new Commande();
            $commande2->setDateCommande(new \DateTimeImmutable('2020-11-30 04:07:17'))
                  ->setTotal(20)
                  ->setEtat(3)
                  ->addDetail($detail2);
            $manager->persist($commande2);

            $commande3 = new Commande();
            $commande3->setDateCommande(new \DateTimeImmutable('2021-05-04 01:35:34'))
                  ->setTotal(10)
                  ->setEtat(3)
                  ->addDetail($detail3);
            $manager->persist($commande3);

            $commande4 = new Commande();
            $commande4->setDateCommande(new \DateTimeImmutable('2021-07-20 06:10:37'))
                  ->setTotal(7)
                  ->setEtat(3)
                  ->addDetail($detail4);
            $manager->persist($commande4);

            $commande5 = new Commande();
            $commande5->setDateCommande(new \DateTimeImmutable('2021-07-20 06:40:21'))
                  ->setTotal(8)
                  ->setEtat(2)
                  ->addDetail($detail5);
            $manager->persist($commande5);

            $commande6 = new Commande();
            $commande6->setDateCommande(new \DateTimeImmutable('2021-07-20 06:40:57'))
                  ->setTotal(6)
                  ->setEtat(1)
                  ->addDetail($detail6);
            $manager->persist($commande6);

            $commande7 = new Commande();
            $commande7->setDateCommande(new \DateTimeImmutable('2021-07-20 07:06:06'))
                  ->setTotal(20)
                  ->setEtat(4)
                  ->addDetail($detail7);
            $manager->persist($commande7);

            $commande8 = new Commande();
            $commande8->setDateCommande(new \DateTimeImmutable('2021-07-20 07:11:06'))
                  ->setTotal(12)
                  ->setEtat(3)
                  ->addDetail($detail8);
            $manager->persist($commande8);

            $user = new User();
            $user->setPrenom('Administrateur')
                  ->setNom('theDistrict')
                  ->setEmail('admin@thedistrict.com')
                  ->setTelephone('404')
                  ->setPassword(password_hash('password', PASSWORD_DEFAULT))
                  ->setRoles(['ROLE_ADMIN','ROLE_USER'])
                  ->setAdresse('non donnee')
                  ->setCp('404')
                  ->setVille('non donnee');
            $manager->persist($user);

            $user1 = new User();
            $user1->setPrenom('Kelly')
                  ->setNom('Dillard')
                  ->setEmail('kelly@gmail.com')
                  ->setTelephone('7896547800')
                  ->addCommande($commande1)
                  ->setPassword(password_hash('password', PASSWORD_DEFAULT))
                  ->setRoles(['ROLE_USER'])
                  ->setAdresse('308 Post Avenue')
                  ->setCp('69000')
                  ->setVille('Lugdunum');
            $manager->persist($user1);

            $user2 = new User();
            $user2->setPrenom('Thomas')
                  ->setNom('Gilchrist')
                  ->setEmail('thom@gmail.com')
                  ->setTelephone('7410001450')
                  ->addCommande($commande2)
                  ->setPassword(password_hash('password', PASSWORD_DEFAULT))
                  ->setRoles(['ROLE_USER'])
                  ->setAdresse('1277 Sunburst Drive')
                  ->setCp('69000')
                  ->setVille('Lugdunum');
            $manager->persist($user2);

            $user3 = new User();
            $user3->setPrenom('Martha')
                  ->setNom('Woods')
                  ->setEmail('martha@gmail.com')
                  ->setTelephone('78540001200')
                  ->addCommande($commande3)
                  ->setPassword(password_hash('password', PASSWORD_DEFAULT))
                  ->setRoles(['ROLE_USER'])
                  ->setAdresse('478 Avenue Street')
                  ->setCp('13000')
                  ->setVille('Massalia');
            $manager->persist($user3);

            $user4 = new User();
            $user4->setPrenom('Charlie')
                  ->setNom('Dupont')
                  ->setEmail('charlie@gmail.com')
                  ->setTelephone('7458965550')
                  ->addCommande($commande4)
                  ->setPassword(password_hash('password', PASSWORD_DEFAULT))
                  ->setRoles(['ROLE_USER'])
                  ->setAdresse('3140 Bartlett Avenue')
                  ->setCp('75000')
                  ->setVille('Lutetia');
            $manager->persist($user4);

            $user5 = new User();
            $user5->setPrenom('Claudia')
                  ->setNom('Hedley')
                  ->setEmail('hedley@gmail.com')
                  ->setTelephone('7451114400')
                  ->addCommande($commande5)
                  ->setPassword(password_hash('password', PASSWORD_DEFAULT))
                  ->setRoles(['ROLE_USER'])
                  ->setAdresse('1119 Kinney Street')
                  ->setCp('80000')
                  ->setVille('Samarobriva');
            $manager->persist($user5);

            $user6 = new User();
            $user6->setPrenom('Vernon')
                  ->setNom('Vargas')
                  ->setEmail('vonno@gmail.com')
                  ->setTelephone('7414744440')
                  ->addCommande($commande6)
                  ->setPassword(password_hash('password', PASSWORD_DEFAULT))
                  ->setRoles(['ROLE_USER'])
                  ->setAdresse('1234 Hazelwood Avenue')
                  ->setCp('75000')
                  ->setVille('Lutetia');
            $manager->persist($user6);

            $user7 = new User();
            $user7->setPrenom('Carlos')
                  ->setNom('Grayson')
                  ->setEmail('carlos@gmail.com')
                  ->setTelephone('7401456980')
                  ->addCommande($commande7)
                  ->setPassword(password_hash('password', PASSWORD_DEFAULT))
                  ->setRoles(['ROLE_USER'])
                  ->setAdresse('2969 Hartland Avenue')
                  ->setCp('13000')
                  ->setVille('Massalia');
            $manager->persist($user7);

            $user8 = new User();
            $user8->setPrenom('Jonathan')
                  ->setNom('Caudill')
                  ->setEmail('jonathan@gmail.com')
                  ->setTelephone('7410256996')
                  ->addCommande($commande8)
                  ->setPassword(password_hash('password', PASSWORD_DEFAULT))
                  ->setRoles(['ROLE_USER'])
                  ->setAdresse('1959 Limer Street')
                  ->setCp('80000')
                  ->setVille('Samarobriva');
            $manager->persist($user8);

            $manager->flush();
      }
}

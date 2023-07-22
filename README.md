# Snowtricks
[![Codacy Badge](https://app.codacy.com/project/badge/Grade/eb4971b6d9f84f128c90482a803b4fd0)](https://app.codacy.com/gh/zaynakaadan/SnowTricks/dashboard?utm_source=gh&utm_medium=referral&utm_content=&utm_campaign=Badge_grade)
_Projet OpenClassrooms "PHP/Symfony app developper" _

## Description

Site permettant de gerer un annuaire de tricks de snowboard avec aspect communautaire (échange de commentaire)

## Installation

1. Git clone the project:

    `https://github.com/zaynakaadan/SnowTricks.git`

2. Install libraries:

        `symfony console composer install`

3. Create database:

    a. Update DATABASE_URL .env file with your database configuration.

                    `DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name`
        
    b. Create database:

                    `symfony console doctrine:database:create`

    c. Create database structure:

                    `symfony console make:migration`

    d. Insert fictive data (optional):
    
                    `symfony console doctrine:fixtures:load`

4. Configure MAILER_DSN of Symfony mailer in .env file                                            

## Générer des fausses données

 Vous pouvez générer des fausses données grâce la fixture présente dans le projet avec la commande suivante :
```
symfony console doctrine:fixtures:load        
```        
    
## License

Projet étudiant OC
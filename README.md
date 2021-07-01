# Pistons et Boulons

-----------------

## Table des matières
1.[Environnement](#environnement)

2.[Installation du projet](#installation)

-----------------

## Environnement

***
Informations sur l'environnement du site


_php_ : 7.4

_sqlite_ : 3

_apache_ : 2.4.29

-----------------

## Installation

***
Explication sur l'installation du site par ligne de commande

Emlpacement où mettre le site :
```
$ cd var/www/html/
```

Pour l'installation de git et du clonage du site :
```
$ apt install git-all
$ git clone https://github.com/nmiton/PistonsEtBoulons.git .
```

Faire une copie du .env dans le dossier du site qui s'appellera env.local et modifier le fichier, il faut que ce soit sur sqlite et non sur le postgresql (mettre un # devant la ligne postgresql et enlever le # devant la ligne sqlite) :

DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"

"#"DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7"

"#"DATABASE_URL="postgresql://db_user:db_password@127.0.0.1:5432/db_name?serverVersion=13&charset=utf8"

Mise à jour de l'environnement du site :
```
$ apt update && apt install vim && apt install php7.4-sqlite3
```

Edition du fichier ci-dessous pour lancer le site directement sur la page accueil:
```
$ vim /etc/apache2/sites-available/000-default.conf
```
*edit du fichier ci-dessus * Sur la ligne de Document Root ajouter /public a la fin
```
$ service apache2 reload
```

Pour faire la mise à jour du gestionnaire de dépendance :
```
$ composer self-update
```

Installer les dépendances sur le projet :
```
$ composer install
$ composer req orm-fixtures
```

Mise en place la base de données :
```
$ php bin/console make:migration
$ php bin/console doctrine:migrations:migrate
$ php bin/console doctrine:fixtures:load
```

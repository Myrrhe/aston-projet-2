# aston-projet-2

===========================================================================

## Technologies

Front : React Native

Back : PHP (Symfony)


===========================================================================

## Liens utiles

Documentation Symfony : https://symfony.com/doc/current/index.html

Documentation React : https://reactjs.org/docs/getting-started.html

Diagramme MPD : https://drive.google.com/file/d/1ZfeC3_J-XiF8bzV4XNEwf8T55o4LGtk7/view?usp=sharing

Dossier du projet sur Google Drive : https://drive.google.com/drive/folders/1Egee6zZRN1qUwsUR6z857goBIh14Gv6Q?usp=sharing

Documentation du back-end : 


===========================================================================

## Installation

### WAMP/XAMP :

WAMP (ou XAMP si vous n'êtes pas sous Windows) permettra d'utiliser une base de donnée, ainsi que le PHP.


### Composer

(Cette partie est optionnelle mais recommandée)

Vous avez deux manières d'installer Composer (a priori, la première est préférable) :

1) Aller sur https://getcomposer.org/download/, télécharger et exécuter le fichier d'installation

2) Placez vous dans le répertoire où vous souhaitez installer Composer, puis entrez les commandes suivantes dans un PowerShell :

`php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"`

`php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"`

`php composer-setup.php`

`php -r "unlink('composer-setup.php');"`

Un fichier *composer.phar* va être crée. Ajouter le (ou le dossier dans lequel il se trouve) à votre variable d'environnement PATH.

> Note : Il se peut que vous ayez à ajouter la ligne `extension=pdo_sqlite` dans le fichier php.ini de votre installation PHP

> Note 2 : Il est souvent nécessaire de redémarrer votre ordi (ou le CMD) pour que les variables d'environnement soient prises en compte

Vous aurez besoin d'ajouter l'extension .PHAR dans la variable d'environnement PATHEXT (en dessous de Path).


### Scoop

Il est nécessaire d'installer Scoop pour pouvoir installer Symfony. Entrez la commande suivante dans un PowerShell :

`Set-ExecutionPolicy RemoteSigned -Scope CurrentUser`

`irm get.scoop.sh | iex`

> Note : Si vous êtes en mode administrateur, les commandes à entrer peuvent être différentes.


### Symfony

Dans une console ou un PowerShell, entrez :

`scoop install symfony-cli`


### Doctrine

Allez dans le répertoire *symfony* du projet, puis, dans une console ou un PowerShell, entrez :

`composer require symfony/orm-pack`

`composer require --dev symfony/maker-bundle`

(Vous pouvez aussi tout simplement entrer `composer require`)


### Fichier d'environnement

Vous aurez besoin d'un fichier d'environnement *.env* pour faire fonctionner le projet. Ce fichier n'est pas inclut dans les fichiers Github. Contactez quelqu'un qui le possède, et copiez le à la racine du dossier *symfony*.


### Database

Allez dans le fichier de configuration de votre installation de PHP, **php.ini**, vous aurez besoin d'ajouter les lignes suivantes :

- `extension=mysqli`
- `extension=pdo_mysql`
- `extension=pdo_sqlite`

Puis dans une console, entrez :

`php symfony/bin/console doctrine:database:create`

Cela créera la base de donnée d'après les settings contenus dans *symfony/.env* (DATABASE_URL), et dans *symfony/config/packages/doctrine.yaml* (dbal).

> Par exemple, mettez `DATABASE_URL="mysql://root:@127.0.0.1:3306/aston-project-2?serverVersion=8&charset=utf8mb4"` dans votre *symfony/.env* pour créer une base de donnée avec le nom **aston-project-2**.

(Vous pouvez également changer le port de la base de donnée, si celui-ci est déjà occupé par exemple).


===========================================================================

## Fichiers de migrations

Quand on créera de nouveaux modèles (classes, entités, etc.), on pourra créer automatiquement des fichiers qui indiqueront à la base de données de créer des tables analogues à nos classes en Symfoni.

Ces fichiers sont les fichiers de migrations, et ils seront crées grâce à la commande suivante :

`php symfony/bin/console make:migration`

Une fois que ces fichiers seront crées, vous pourrez effectuez les migrations via la commande suivante :

`php symfony/bin/console doctrine:migrations:migrate`


## Lancement

Pour lancer le serveur, allez dans le dossier *symfony*, puis entrez `symfony server:start`

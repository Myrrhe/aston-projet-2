# aston-projet-2

===========================================================================

## Technologies

Front : React Native

Back : PHP (Symfony)


===========================================================================

## Liens utiles

Documentation Symfony : https://symfony.com/doc/current/index.html

Documentation React : https://reactjs.org/docs/getting-started.html

Dossier du projet sur Google Drive : https://drive.google.com/drive/folders/1Egee6zZRN1qUwsUR6z857goBIh14Gv6Q?usp=sharing

Documentation du back-end : 


===========================================================================

## Installation

### WAMP/XAMP :

WAMP (ou XAMP si vous n'êtes pas sous Windows) permettra d'utiliser une base de donnée, ainsi que le PHP.


### Composer

(Cette partie est optionnelle mais recommandée)

Placez vous dans le répertoire où vous souhaitez installer Composer, puis entrez les commandes suivantes dans un PowerShell :

`php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"`

`php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"`

`php composer-setup.php`

`php -r "unlink('composer-setup.php');"`

Un fichier *composer.phar* va être créer. Ajouter le (ou le dossier dans lequel il se trouve) à votre variable d'environnement PATH.

> Note : Il se peut que vous ayez à ajouter la ligne `extension=pdo_sqlite` dans le fichier php.ini de votre installation PHP

> Note 2 : Il est souvent nécessaire de redémarrer votre ordi pour que les variablrs d'environnement soient prises en compte


### Scoop

Il est nécessaire d'installer Scoop pour pouvoir installer Symfony. Entrez la commande suivante dans un PowerShell :

`Set-ExecutionPolicy RemoteSigned -Scope CurrentUser`

`irm get.scoop.sh | iex`

> Note : Si vous êtes en mode administrateur, les commandes à entrer peuvent être différentes.

### Symfony

Dans une console ou un PowerShell, entrez :

`scoop install symfony-cli`

### Database

Allez dans le fichier de configuration de votre installation de PHP, **php.ini**, vous aurez besoin d'ajouter les lignes suivantes :

- `extension=mysqli`
- `extension=pdo_mysql`
- `extension=pdo_sqlite`

Puis dans une console, entrez :

`php src/bin/console doctrine:database:create`

Cela créera la base de donnée d'après les settings contenus dans *src/.env* (DATABASE_URL), et dans *src/bin/packages/doctrine.yaml* (dbal).


===========================================================================

## Lancement

Pour lancer le serveur, allez dans le dossier *src*, puis entrez `symfony server:start`

## Fichiers de migrations

Quand on créera de nouveaux modèles (classes, entités, etc.), on pourra créer automatiquement des fichiers qui indiqueront à la base de données de créer des tables analogues à nos classes en Symfoni.

Ces fichiers sont les fichiers de migrations, et ils seront crées grâce à la commande suivante :

`php src/bin/console make:migration`

Une fois que ces fichiers seront crées, vous pourrez effectuez les migrations via la commande suivante :

`php src/bin/console doctrine:migrations:migrate`

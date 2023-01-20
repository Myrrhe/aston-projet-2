# aston-projet-2

================================================================================

## Technologies

Front : React Native

Back : PHP (Symfony)


================================================================================

## Liens utiles

Documentation Symfony : https://symfony.com/doc/current/index.html

Documentation React : https://reactjs.org/docs/getting-started.html

Dossier du projet sur Google Drive : https://drive.google.com/drive/folders/1Egee6zZRN1qUwsUR6z857goBIh14Gv6Q?usp=sharing

Documentation du back-end : 


================================================================================

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


### Scoop

Il est nécessaire d'installer Scoop pour pouvoir installer Symfoni. Entrez la commande suivante dans un PowerShell :

`Set-ExecutionPolicy RemoteSigned -Scope CurrentUser`

`irm get.scoop.sh | iex`

> Note : Si vous êtes en mode administrateur, les commandes à entrer peuvent être différentes.

### Symfoni

Dans une console ou un PowerShell, entrez :

`scoop install symfony-cli`

================================================================================

## Lancement

Pour lancer le serveur, allez dans le dossier *src*, puis entrez `symfony server:start`

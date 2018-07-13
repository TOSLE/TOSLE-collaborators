# Projet étudiant - TOSLE
Projet étudiant

Afin de rapidement cloner notre CMS axé pour les développeurs, n'hésitez pas à utiliser cette commande
> git clone --recurse-submodules https://github.com/TOSLE/TOSLE-collaborators.git

A la racine du repo
> npm install chart.js --save

> npm install node-sass

Avant de démarrer, il faut s'assurer avoir les bons droits sur le répertoire Static
> chmod 777 -R Tosle/
> chmod 777 -R App/


# Installation de votre machine sous Linux, Debian 7
## Prérequis :
Il faut avoir :
* La version PHP 5.6 ou supérieur
* MySQL version 5.6 ou supérieur
* Avoir d'installé, GMP (PHP)


## Installation

### Configuration de PHP
Sur le serveur, vous devrez définir votre 'timezone'. Pour ce faire, rendez-vous dans :
`nano /etc/php5/cli/php.ini`

Avec nano, vous pouvez utiliser la commande de recherche suivante 'CTRL + W' : `date.`

L'élément à remplacer est fait ainsi par défaut :

<pre>
[Date]
; Defines the default timezone used by the date functions
; http://php.net/manual/en/datetime.configuration.php#ini.date.timezone
;date.timezone =
</pre>

Dans notre cas, nous sommes sur Paris, alors notre fichier ressemblera à ceci : 
<pre>
[Date]
; Defines the default timezone used by the date functions
; http://php.net/manual/en/datetime.configuration.php#ini.date.timezone
date.timezone = 'Europe/Paris'
</pre>

Enfin, si vous ne choisissez pas la même valeur que nous, n'oubliez pas de modifier la ligne correspondante, dans le
fichier `index.php` :
<pre>
date_default_timezone_set('Europe/Paris');
</pre>

### Installation de GMP

Sur votre serveur Debian, tapez la commande suivante : 
<pre>
apt-get install php5-gmp
service apache2 restart
</pre>

### Configuration de l'éditeur

Le CMS TOSLE utilise **CKEDITOR** et la version **KCFINDER** pour apporter un éditeur de texte riche en option.

Néanmoins, il est nécessaire d'apporter une modification de droit pour un fichier :
<pre>
cd Public/Libraries/ckeditor/kcfinder
</pre>

A partir de la, il y a deux possibilités, le dossier `upload` n'existe pas ou il existe. S'il existe, 
n'effectuez pas la première commande.

<pre>
mkdir upload
chmod 0777 -R upload/
</pre>

Le README sera ridigé d'ici peu de temps :)
__________________________

# Student Project - TOSLE
Student project

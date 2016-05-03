# BDD
## Ordre des Actions
### Première action
La première chose qui se passe est de lancer le fichier Create-DB.php qui va se charger de créer la DATABASE et de créer les tables que nous aurons besoins.

### Deuxième action
Ensuite nous avons besoin de remplir nos tables, nous parsons donc avec notre fichier parser.php qui va se charger de décompenser les fichiers XML et de les rentrer par des QUERY dans notre Base de donnée.

## Fichiers
fichiers 		|Explication
--------------	|------------------
Create-DB.php 	|Crée la DBB
parser.php 		|Parse dans la BDD

## Base de donnée
### Etablissement
Etablissement
-------------------
ID | Nom | Rue | Numéro | CodePostal | Localité | Long | Lat | Tel | WebLink | type

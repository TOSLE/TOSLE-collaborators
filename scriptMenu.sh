#!/usr/bin/env bash
clear
while :
    do
        echo 'Menu'
        echo '[1] Affichage repertoire courant'
        echo '[2] Liste des fichiers du repertoire'
        echo '[3] Changement de repertoire'
        echo '[4] Realiser une indexation de un ou plusieurs fichiers'
        echo '[5] Realiser un commit :'
        echo '[0] Fin ou "q"'
        echo 'Faites votre selection :'
        read ch
    case $ch in
        0) exit 0
        ;;
        q) exit 0
        ;;
        1) pwd
        ;;
        2) ls -al
        ;;
        3) echo -n 'Chemin ou nom du repertoire a atteindre :' ; read rep ; cd $rep
        ;;
        4) echo -n 'Sur quoi voulez-vous realiser votre "git add" ? :' ; read optionAdd
        git add $optionAdd
        ;;
        5) echo -n 'Entrez votre message de commit :' ; read messageCommit
        git commit -m "$messageCommit"
        ;;
        *) echo 'Le choix selectionner ne fonctionne pas'
    esac
done

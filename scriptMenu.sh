#!/usr/bin/env bash
clear
while :
    do
        echo 'Menu'
        echo '[1] Affichage repertoire courant'
        echo '[2] Liste des fichiers du repertoire'
        echo '[3] Changement de repertoire'
        echo '[git] Commandes GIT'
        echo '[0/q] Fin de votre operation'
        echo 'Choix :'
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
        git) clear
            echo 'Bienvenue dans le menu de commande GIT, si vous avez des doutes, merci de ne pas utiliser ce menu !'
            echo 'En effet, ce menu executera les commandes automatiquements, il est peut-etre donc necessaire de connaitre son fonctionnement'
            while :
                do
                    echo 'Menu GIT'
                    echo '[1] Indexation de un ou plusieurs fichiers (git add)'
                    echo '[2] Realiser une sauvegarde (commit)'
                    echo '[3] Realiser un push sur la branche distance'
                    read git
                    case $git in
                        1) echo -n 'Sur quoi voulez-vous realiser votre "git add" ? :' ; read optionAdd
                        git add $optionAdd
                        ;;
                        2) echo -n 'Il est necessaire de faire une indexation avant de continuer cette operation, continuer ? [o/n]' ; read confirm
                        case $confirm in
                            o) echo -n 'Entrez votre message de commit :' ; read messageCommit
                            git commit -m "$messageCommit"
                            ;;
                            *) echo 'Fin de votre operation'
                            return 0
                        esac
                        ;;
                        3) BRANCH=$(git symbolic-ref HEAD --short 2> /dev/null)
                        echo "La branche courante est la suivante : $BRANCH"
                        echo -n "Voulez-vous poursuivre votre operation ?" ; read confirmPush
                            case $confirmPush in
                                o) echo "Push sur la branche : $BRANCH"
                                echo 'Veuillez renseigner le remote parmis cette liste :'
                                echo ''
                                git remote -v
                                echo -n 'Votre choix :' ; read remote
                                git push $remote $BRANCH
                                ;;
                                *) echo 'Fin de votre operation'
                                return 0
                            esac
                        ;;
                        *) return 0
                    esac
            done
        ;;
        *) echo 'Le choix selectionner ne fonctionne pas'
    esac
done
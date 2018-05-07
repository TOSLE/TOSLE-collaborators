#!/usr/bin/env bash
while :
    do
        clear
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
            echo ''
            echo 'Bienvenue dans le menu de commande GIT, si vous avez des doutes, merci de ne pas utiliser ce menu !'
            echo 'En effet, ce menu executera les commandes automatiquements, il est peut-etre donc necessaire de connaitre son fonctionnement'
            echo 'Le menu GIT ne pourra pas vous permettre de changer de branche, ni de merge.'
            while :
                do
                    BRANCH=$(git symbolic-ref HEAD --short 2> /dev/null)
                    echo ''
                    echo "Menu GIT -> Branche courante : $BRANCH"
                    echo '[status] Voir le status de la branche courante'
                    echo '[add] Indexation de un ou plusieurs fichiers (git add)'
                    echo '[commit] Realiser une sauvegarde (commit)'
                    echo '[push] Realiser un push sur la branche distance'
                    echo '[pull] Realiser un pull sur la branche distance'
                    echo '[rebase] Effectuer un rebase de preproduction-master'
                    echo 'Ecrire un caractere au hasard pour quitter ce menu'
                    echo -n 'Selection : ' ; read git
                    case $git in
                        status) git status
                        ;;
                        add) echo -n 'Sur quoi voulez-vous realiser votre "git add" ? :' ; read optionAdd
                        git add $optionAdd
                        ;;
                        commit) echo -n 'Il est necessaire de faire une indexation avant de poursuivre cette operation, continuer ? [o/n]' ; read confirm
                        case $confirm in
                            o) echo -n 'Entrez votre message de commit :' ; read messageCommit
                            git commit -m "$messageCommit"
                            ;;
                            *) echo 'Fin de votre operation'
                            break
                        esac
                        ;;
                        push)
                        echo '' ; echo '******** IMPORTANT ********'
                        echo "La branche courante est la suivante : $BRANCH"
                        echo -n "Voulez-vous poursuivre votre operation ? [o/n]" ; read confirmPush
                            case $confirmPush in
                                o) echo "Push sur la branche : $BRANCH"
                                echo 'Veuillez renseigner le remote parmis cette liste...'
                                git remote -v
                                echo -n 'Votre choix : ' ; read remote
                                git push $remote $BRANCH
                                ;;
                                *) echo 'Fin de votre operation'
                                break
                            esac
                        ;;
                        pull) echo 'Pull en cours'
                        echo 'Veuillez renseigner le remote parmis cette liste...'
                        git remote -v
                        echo -n 'Votre choix : ' ; read remote
                        git pull $remote $BRANCH
                        ;;
                        rebase) git rebase preproduction-master
                        ;;
                        *) break
                    esac
            done
        ;;
        *) echo 'Le choix selectionner ne fonctionne pas'
    esac
done
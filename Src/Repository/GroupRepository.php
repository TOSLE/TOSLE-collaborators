<?php

/**
 * Created by PhpStorm.
 * User: Mehdi
 * Date: 28/06/2018
 * Time: 23:22
 */
class GroupRepository extends Group
{

    /**
     * @return array
     * Retourne le tableau SELECT pour les configForm
     */
    public function configFormGroup()
    {
        $option = [];
        foreach ($this->getGroup() as $group) {
            $option[$group->getId()] = $group->getName();
        }
        return [
            "group_select" => [
                "label" => "Selection des groupes",
                "description" => "Vous avez le droit à plusieurs choix (\"CTRL + Clic\" pour réaliser un choix multiple)",
                "multiple" => true,
                "options" => $option
            ]
        ];
    }

    /**
     * @return array
     * Retourne la liste des groupes
     */
    public function getGroup()
    {
        $target = [
            "id",
            "name",
            "fileid"
        ];
        return $this->getData($target);
    }
}
<?php
class Route
{
    private $Routes = [
                [
                    "slug" => "nomroute",
                    "controller" => "controller",
                    "action" => "action",
                    "security" => "true/false"
                ]
            ];

    public function getRoute($slug)
    {
        foreach ($Routes as $route){
            if($route["slug"]==$slug){
                return $route;
            }
        }
        return "routepardefault";
    }
}

<?php
class Access
{
    private $access = [];
    public function __construct()
    {
        $this->access = [
            "default" => [ // Redirect 404
                    "slug" => "404",
                    "controller" => "index",
                    "action" => "index",
                    "security" => false
                ],
            "homepage" => [ // TOSLE Homepage
                "slug" => "index",
                "controller" => "class",
                "action" => "index",
                "security" => false
            ],
            "homeblog" => [ // Blog  homepage
                "slug" => "blog",
                "controller" => "blog",
                "action" => "index",
                "security" => false
            ],
            "chathome" => [ // Chat  homepage
                "slug" => "chat",
                "controller" => "chat",
                "action" => "index",
                "security" => "false"
            ],
            [ // Profile  homepage
                "slug" => "profile",
                "controller" => "profile",
                "action" => "index",
                "security" => "false"
            ],
            [ // Sign in
                "slug" => "sign-in",
                "controller" => "user",
                "action" => "connect",
                "security" => "false"
            ]
        ];
    }

    public function getRoute($slug)
    {
        foreach ($this->access as $route){
            if($route["slug"]==$slug){
                return $route;
            }
        }
        return $this->access["default"];
    }

    public function getSlug($key)
    {
        if($this->access[$key]){
            return $this->access[$key];
        } else {
            return $this->access["default"];
        }
    }
}

<?php
class Access
{
    private $access = [
        "default" => [ // Redirect 404
            "slug" => "404",
            "controller" => "index",
            "action" => "index",
            "security" => false
        ],
        "homepage" => [ // TOSLE Homepage
            "slug" => "",
            "controller" => "class",
            "action" => "index",
            "security" => false
        ],
        "bloghome" => [ // Blog  homepage
            "slug" => "blog",
            "controller" => "blog",
            "action" => "index",
            "security" => false
        ],
        "chathome" => [ // Chat  homepage
            "slug" => "chat",
            "controller" => "chat",
            "action" => "index",
            "security" => false
        ],
        "profilehome" => [ // Profile  homepage
            "slug" => "profile",
            "controller" => "profile",
            "action" => "index",
            "security" => false
        ],
        "signin" => [ // Sign in
            "slug" => "sign-in",
            "controller" => "user",
            "action" => "connect",
            "security" => false
        ],
        "signout" => [ // Sign out
            "slug" => "sign-out",
            "controller" => "user",
            "action" => "disconnect",
            "security" => false
        ],
        "dashboardhome" => [ // Dashboard homepage
            "slug" => "admin",
            "controller" => "dashboard",
            "action" => "index",
            "security" => false
        ],
        "dashboard_blog" => [ // Dashboard blog homepage
            "slug" => "blog-dashboard",
            "controller" => "dashboard",
            "action" => "blog",
            "security" => 2
        ],
        "blog_status" => [ // change status blog
            "slug" => "blog-status",
            "controller" => "blog",
            "action" => "status",
            "security" => 2
        ],
        "add_user" => [ // change status blog
            "slug" => "add-user",
            "controller" => "user",
            "action" => "add",
            "security" => false
        ]
    ];

    public function getRoute($slug)
    {
        foreach ($this->access as $route){
            if($route["slug"]==$slug){
                return $route;
            }
        }
        return $this->access["default"];
    }

    public function getSlug($id)
    {
        foreach ($this->access as $key => $params){
            if($key==$id){
                return $params;
            }
        }
        return $this->access["default"];
    }
    public function getSlugs($language)
    {
        $data = [];
        foreach ($this->access as $key => $value){
            $data[$key] = "".DIRNAME.substr($language,0,2)."/".$value["slug"];
        }
        return $data;
    }

    public function getSecurity($slug)
    {
        $route = $this->getRoute($slug);
        return $route["security"];
    }
}

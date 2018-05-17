<?php
class Access
{
    private $access = [
        "default" => [ // Redirect 404
            "slug" => "404",
            "controller" => "index",
            "action" => "notfound",
            "security" => false
        ],
        "homepage" => [ // TOSLE Homepage
            "slug" => "",
            "controller" => "class",
            "action" => "index",
            "security" => false
        ],
        "bloghome" => [ // Blog  homepage
            "slug" => "blog-homepage",
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
        "signup" => [ // Sign up
            "slug" => "sign-up",
            "controller" => "user",
            "action" => "register",
            "security" => false
        ],
        "verify" => [ // Verify user
            "slug" => "user-verify",
            "controller" => "user",
            "action" => "verify",
            "security" => false
        ],
        "signout" => [ // Sign out
            "slug" => "sign-out",
            "controller" => "user",
            "action" => "disconnect",
            "security" => false
        ],
        "dashboardhome" => [ // Dashboard homepage
            "slug" => "dashboard-homepage",
            "controller" => "dashboard",
            "action" => "index",
            "security" => 2
        ],
        "dashboard_blog" => [ // Dashboard blog homepage
            "slug" => "dashboard-blog",
            "controller" => "dashboard",
            "action" => "blog",
            "security" => 2
        ],
        "add_user" => [ // change status blog
            "slug" => "add-user",
            "controller" => "user",
            "action" => "add",
            "security" => false
        ],
        "view_blog_article" => [ // change status blog
            "slug" => "view-blog-article",
            "controller" => "blog",
            "action" => "view",
            "security" => false
        ]
    ];

    private $backOffice = [
        "blog/status" => 2,
        "blog/add" => 2,
        "blog/edit" => 2
    ];

    public function getRoute($slug = false)
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
    public function getSlugs()
    {
        global $language;
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

    public function getBackOfficeRoute($route)
    {
        if(isset($this->backOffice[$route])){
            return $this->backOffice[$route];
        }
        return -1;
    }
    public function getPathBackOffice()
    {
        global $language;
        $data = [];
        foreach ($this->backOffice as $key => $value){
            $data[$key] = "".DIRNAME.substr($language,0,2)."/".$key;
        }
        return $data;
    }
}

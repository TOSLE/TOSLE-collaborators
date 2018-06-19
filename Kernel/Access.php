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
        "classhome" => [ // Blog  homepage
            "slug" => "class-homepage",
            "controller" => "class",
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
            "slug" => "view-article",
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

    /**
     * @param string|bool $slug
     * @return array
     * Retourne le tableau correspondant au slug fournit en paramètre
     */
    public function getRoute($slug = false)
    {
        foreach ($this->access as $route){
            if($route["slug"]==$slug){
                return $route;
            }
        }
        return $this->access["default"];
    }

    /**
     * @param string $id
     * @return array
     * Retourne le slug correspond à l'id de celui-ci
     */
    public function getSlug($id)
    {
        foreach ($this->access as $key => $params){
            if($key==$id){
                return $params;
            }
        }
        return $this->access["default"];
    }

    /**
     * @return array
     * Retourne le tableau des slugs
     */
    public function getAccess()
    {
        return $this->access;
    }

    /**
     * @return array
     * Retourne le tableau des slugs du backoffice
     */
    public function getBackoffice()
    {
        return $this->backOffice;
    }

    /**
     * @param $route
     * @return int|mixed
     * Permet de savoir si la route fournit existe, sinon on renvoit un -1
     */
    public function getBackOfficeRoute($route)
    {
        if(isset($this->backOffice[$route])){
            return $this->backOffice[$route];
        }
        return -1;
    }

    /**
     * @return array
     * Retourne un tableau comprenant toutes les routes du Backoffice et et du front office sous la forme
     * key => chemin
     */
    public static function getSlugsById()
    {
        global $language;
        $Acces = new Access();
        $data = [];
        foreach ($Acces->getAccess() as $key => $value){
            $data[$key] = "".DIRNAME.substr($language,0,2)."/".$value["slug"];
        }
        foreach ($Acces->getBackoffice() as $key => $value){
            $data[$key] = "".DIRNAME.substr($language,0,2)."/".$key;
        }
        return $data;
    }

    /**
     * @param string $string
     * @return string
     * Permet de retourner une chaine de caractere sous le format URL
     */
    public static function constructUrl($string = "url to encode")
    {
        $search = array('à', 'ä', 'â', 'é', 'è', 'ë', 'ê', 'ï', 'ì', 'î', 'ù', 'û', 'ü', 'ô', 'ö', '&', ' ', '?', '!', 'ç', ';', '/');
        $replace = array('a', 'a', 'a', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'u', 'u', 'u', 'o', 'o', '', '-', '', '', 'c', '', '-');

        return urlencode(str_replace($search, $replace, strtolower($string)));
    }
}

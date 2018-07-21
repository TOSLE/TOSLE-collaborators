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
        "dashboard_lesson" => [ // Dashboard blog homepage
            "slug" => "dashboard-lesson",
            "controller" => "dashboard",
            "action" => "lessons",
            "security" => 2
        ],
        "dashboard_chapter" => [ // Dashboard blog homepage
            "slug" => "dashboard-chapter",
            "controller" => "dashboard",
            "action" => "chapter",
            "security" => 2
        ],

        "dashboard_portfolio" => [ // Dashboard blog homepage
            "slug" => "dashboard-portfolio",
            "controller" => "dashboard",
            "action" => "portfolio",
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
        ],
        "Portfolio" => [
            "slug" => "portfolio-view",
            "controller" => "portfolio",
            "action" => "index",
            "security" => false
        ],
        "view_portfolio_article" => [ // change status blog
            "slug" => "view-article",
            "controller" => "portfolio",
            "action" => "view",
            "security" => false
        ],


       "portfoliohome" => [ // portfolio homemepage
            "slug" => "portfolio-homepage",
            "controller" => "portfolio",
            "action" => "index",
            "security" => false
        ],
       "portfolio_add" => [ // change status blog
            "slug" => "portfolio-view-add",
            "controller" => "portfolio",
            "action" => "add",
            "security" => false
        ],

        "dashboard_portfolio" => [ // Dashboard blog homepage
            "slug" => "dashboard-portfolio",
            "controller" => "portfolio",
            "action" => "",
            "security" => 2
        ],

        "view_lesson" => [ // change status blog
            "slug" => "lesson",
            "controller" => "class",
            "action" => "view",
            "security" => false
        ],

        "edit_profile" => [
            "slug" => "edit-profile",
            "controller" => "profile",
            "action" => "edit",
            "security" => false
        ],

        "subscribe_lesson" => [
            "slug" => "subscribe-lesson",
            "controller" => "class",
            "action" => "subscribe",
            "security" => false
        ],
    ];

    private $backOffice = [
        "blog/status" => 2,
        "blog/add" => 2,
        "blog/edit" => 2,
        "class/add" => 2,
        "class/edit" => 2,
        "class/status" => 2,
        "chapter/add" => 2,
        "chapter/edit" => 2,
        "chapter/status" => 2,
        "chapter/order" => 2,
        "portfolio/add "=>2,
        "portfolio/edit"=>2,
        "index/config" => false,

    ];

    private $urlFixe = [
        'rss_blog' => 'Tosle/Static/xml/blogfeed.xml',
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
     * Retourne les urls fixes de notre CMS
     */
    public function getUrlFixe()
    {
        return $this->urlFixe;
    }

    /**
     * @return array
     * Retourne un tableau comprenant toutes les routes du Backoffice et et du front office sous la forme
     * key => chemin
     */
    public static function getSlugsById()
    {
        global $language;
        if(empty($language)){
            $language = "en-EN";
        }
        $Acces = new Access();
        $data = [];
        foreach ($Acces->getAccess() as $key => $value){
            $data[$key] = "".DIRNAME.substr($language,0,2)."/".$value["slug"];
        }
        foreach ($Acces->getBackoffice() as $key => $value){
            $data[$key] = "".DIRNAME.substr($language,0,2)."/".$key;
        }
        foreach ($Acces->getUrlFixe() as $key => $value){
            $data[$key] = $value;
        }
        return $data;
    }

    public static function getPublicSlugs()
    {
        global $language;
        if(empty($language)){
            $language = "en-EN";
        }
        $Acces = new Access();
        $data = [];
        foreach ($Acces->getAccess() as $key => $value){
            $data[$key] = "".DIRNAME.substr($language,0,2)."/".$value["slug"];
        }
        foreach ($Acces->getUrlFixe() as $key => $value){
            $data[$key] = "".DIRNAME.$value;
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
        $search = array('à', 'ä', 'â', 'é', 'è', 'ë', 'ê', 'ï', 'ì', 'î', 'ù', 'û', 'ü', 'ô', 'ö', '&', ' ', '?', '!', 'ç', ';', '/', '.', ',', ':', '(', ')', '=', '\'');
        $replace = array('a', 'a', 'a', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'u', 'u', 'u', 'o', 'o', '', '-', '', '', 'c', '', '-', '', '', '', '', '', '', '-');

        return urlencode(trim(str_ireplace($search, $replace, strtolower((trim($string)))),'-'));
    }
}

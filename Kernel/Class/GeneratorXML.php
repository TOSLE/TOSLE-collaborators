<?php
/**
 * Created by PhpStorm.
 * User: jdomange
 * Date: 26/06/2018
 * Time: 14:37
 */

class GeneratorXML
{
    private $dirPath;
    private $fileName;
    private $xmlDoc;
    private $channel;
    private $rss;
    private $routes;
    private $atom;

    /**
     * GeneratorXML constructor.
     * @param string $fileName
     * @param string $dirPath
     */
    public function __construct($fileName, $dirPath = "xml")
    {
        $this->routes = Access::getSlugsById();
        $this->fileName = $fileName.'.xml';
        $this->dirPath = CoreFile::testStaticDirectory($dirPath);
        $this->xmlDoc = new DOMDocument('1.0', 'utf-8');
    }

    /**
     * Cette fonction génére le sitemap
     */
    public function setSitemap()
    {
        $Lesson = new LessonRepository();
        $Blog = new BlogRepository();
        $urlset = $this->xmlDoc->createElement('urlset');
        $urlset->setAttribute('xmlns', "http://www.google.com/schemas/sitemap/0.84");
        $Routes = Access::getPublicSlugs();
        foreach($Routes as $id => $route){
            if($id != "default"){
                $url = $this->xmlDoc->createElement('url');
                $loc = $this->xmlDoc->createElement('loc', Installer::url().$route);
                $priority = $this->xmlDoc->createElement('priority', "0.5");
                $url->appendChild($loc);
                $url->appendChild($priority);
                $urlset->appendChild($url);
            }
        }
        $lessons = $Lesson->getLessons(null);
        foreach ($lessons as $lesson){
            foreach ($lesson->getChapter() as $chapter){
                $url = $this->xmlDoc->createElement('url');
                $loc = $this->xmlDoc->createElement('loc', Installer::url().'/'.$lesson->getUrl().'/'.$chapter->getUrl());
                $priority = $this->xmlDoc->createElement('priority', "1");
                $url->appendChild($loc);
                $url->appendChild($priority);
                $urlset->appendChild($url);
            }
        }

        $blogs = $Blog->getAllArticleByStatus(1);
        foreach($blogs as $blog){
            $url = $this->xmlDoc->createElement('url');
            $loc = $this->xmlDoc->createElement('loc', Installer::url().'/'.$blog->getUrl());
            $priority = $this->xmlDoc->createElement('priority', "0.8");
            $url->appendChild($loc);
            $url->appendChild($priority);
            $urlset->appendChild($url);
        }
        $this->xmlDoc->appendChild($urlset);

    }

    /**
     * Initialise les données du site internet en cours
     */
    public function getWebSiteData($key_link = null)
    {
        $this->rss = $this->xmlDoc->createElement('rss');
        $this->rss->setAttribute('xmlns:atom', 'http://www.w3.org/2005/Atom');
        $this->rss->setAttribute('version', '2.0');

        $this->atom = $this->xmlDoc->createElement('atom:link');
        $this->atom->setAttribute('type', 'application/rss+xml');
        if(isset($key_link)){
            $this->atom->setAttribute('href', Installer::url().'/'.$this->routes[$key_link]);
        }
        $this->atom->setAttribute('rel', 'self');
        $this->channel = $this->xmlDoc->createElement('channel');
        $title = $this->xmlDoc->createElement('title', 'Le site de tosle');
        $link = $this->xmlDoc->createElement('link', $_SERVER['SERVER_NAME']);
        $description = $this->xmlDoc->createElement('description', 'Description of Website');
        $webMaster = $this->xmlDoc->createElement('webMaster', 'contact.tosle@gmail.com');
        $language = $this->xmlDoc->createElement('language', 'fr');
        $copyright = $this->xmlDoc->createElement('copyright', 'TOSLE');
        $generator = $this->xmlDoc->createElement('generator', 'TOSLE');
        $lastBuildDate = $this->xmlDoc->createElement('lastBuildDate', date('c'));
        $this->channel->appendChild($this->atom);
        $this->channel->appendChild($title);
        $this->channel->appendChild($link);
        $this->channel->appendChild($description);
        $this->channel->appendChild($webMaster);
        $this->channel->appendChild($language);
        $this->channel->appendChild($copyright);
        $this->channel->appendChild($generator);
        $this->channel->appendChild($lastBuildDate);
    }

    /**
     * @param $string
     * @return string
     * convert string to available XML String
     */
    public function convertStringToXml($string)
    {
        return html_entity_decode($string);
    }

    /**
     * @param array Blog $content
     * Générateur du fichier XML pour le contenu des Blogs
     */
    public function setBlogFeed($content)
    {
        $this->getWebSiteData('rss_blog');
        $BlogRepository = new BlogRepository();
        if(isset($content) && !empty($content)){
            foreach($content as $blog){
                $item = $this->xmlDoc->createElement('item');
                $title = $this->xmlDoc->createElement('title', $blog->getTitle());
                $description = $this->xmlDoc->createElement('description', $this->convertStringToXml($BlogRepository->getResumeContent($blog->getContent())));
                $datePub = $this->xmlDoc->createElement('pubDate', $blog->getDatecreate());
                $link = $this->xmlDoc->createElement('link', $_SERVER['SERVER_NAME'].$this->routes['view_blog_article'].'/'.$blog->getUrl());
                $item->appendChild($title);
                $item->appendChild($description);
                $item->appendChild($datePub);
                $item->appendChild($link);
                $this->channel->appendChild($item);
            }
        } else {
            $item = $this->xmlDoc->createElement('item');
            $title = $this->xmlDoc->createElement('title', 'Aucun article publié pour le moment');
            $description = $this->xmlDoc->createElement('description', 'Aucun article publié pour le moment');
            $item->appendChild($title);
            $item->appendChild($description);
            $this->channel->appendChild($item);
        }
        $this->rss->appendChild($this->channel);
        $this->xmlDoc->appendChild($this->rss);
    }

    /**
     * @param array Blog $content
     * Générateur du fichier XML pour le contenu des cours
     */
    public function setLessonFeed($content)
    {
        $this->getWebSiteData('rss_lesson');
        if(isset($content) && !empty($content)){
            foreach($content as $lesson){
                if(!empty($lesson->getChapter())){
                    $item = $this->xmlDoc->createElement('item');
                    $title = $this->xmlDoc->createElement('title', $lesson->getTitle());
                    $description = $this->xmlDoc->createElement('description', $this->convertStringToXml($lesson->getDescription()));
                    $datePub = $this->xmlDoc->createElement('pubDate', $lesson->getDatecreate());
                    $link = $this->xmlDoc->createElement('link', $_SERVER['SERVER_NAME'].$this->routes['view_blog_article'].'/'.$lesson->getUrl());
                    $chapter = $this->xmlDoc->createElement('numberChapter', sizeof($lesson->getChapter()));
                    $item->appendChild($chapter);
                    $item->appendChild($title);
                    $item->appendChild($description);
                    $item->appendChild($datePub);
                    $item->appendChild($link);
                    $this->channel->appendChild($item);
                }
            }
        } else {
            $item = $this->xmlDoc->createElement('item');
            $title = $this->xmlDoc->createElement('title', 'Aucun cours publié pour le moment');
            $description = $this->xmlDoc->createElement('description', 'Aucun cours publié pour le moment');
            $item->appendChild($title);
            $item->appendChild($description);
            $this->channel->appendChild($item);
        }
        $this->rss->appendChild($this->channel);
        $this->xmlDoc->appendChild($this->rss);
    }

    /**
     * Lorsqu'on a terminé avec notre objet, on save le XML
     */
    public function __destruct()
    {
        $this->xmlDoc->save($this->dirPath['SERVER_PATH'].$this->fileName);
    }
}
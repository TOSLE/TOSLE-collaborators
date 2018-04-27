<?php
/**
 * Created by PhpStorm.
 * User: Mehdi
 * Date: 06/04/2018
 * Time: 00:12
 */

class Blog extends CoreSql {

    protected $id;
    protected $title;
    protected $type;
    protected $content;
    protected $datecreate;
    protected $status;
    protected $fileid;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getDatecreate()
    {
        return $this->datecreate;
    }

    /**
     * @param mixed $datecreate
     */
    public function setDatecreate($datecreate)
    {
        $this->datecreate = $datecreate;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getFileid()
    {
        return $this->fileid;
    }

    /**
     * @param mixed $fileid
     */
    public function setFileid($fileid)
    {
        $this->fileid = $fileid;
    }

    public function configFormAdd()
    {
    }

    public function dashboardBlocLastPosts($arrays)
    {
        $data = [];
        foreach ($this->createDataForDashboardBloc($arrays) as $array){
            $tmpData = [];
            foreach($array as $key => $value){
                if($key == "datecreate"){
                    $tmpData["data_post_date"] = $value;
                }
                if($key == "title"){
                    $tmpData["data_title"] = $value;
                }
                if($key == "status"){
                    $tmpData["data_status"] = $value;
                }
                if($key == "id"){
                    $tmpData["data_id"] = $value;
                }
            }
            $data[] = $tmpData;
        }
        return [
            "global" => [
                "title" => "Dernières publications",
                "icon_header" => [
                    //"modal" => [
                    //    "target" => "idtarget"
                    //],
                    "href" => [
                        "location" => "#"
                    ],
                ],
                "col" => 6,
                "table_header" => [
                    "Titre",
                    "Date de publication",
                    "Action"
                ],
                "table_body_class" => [
                    1 => "td-content-text",
                    2 => "td-content-date",
                    3 => "td-content-action"
                ]
            ],
            "data" => $data
        ];
    }
}
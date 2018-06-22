<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 07/06/2018
 * Time: 00:14
 */

class FileRepository extends File
{

    /**
     * @param $_file
     * @param $_configForm
     * @param $_destination
     * @param $_comment
     * @return array|int
     */
    public function addFile($_file, $_configForm, $_destination, $_comment)
    {
        if(SYSTEM == "LINUX") {
            $directoryDestination = getcwd() . DIRNAME . 'Tosle/' . ucfirst(strtolower($_destination)) . '/';
        } else {
            $directoryDestination = '../..' . DIRNAME . 'Tosle/' . ucfirst(strtolower($_destination)) . '/';
        }

        $pathDirectory = DIRNAME . 'Tosle/' . ucfirst(strtolower($_destination)) . '/';

        foreach($_configForm as $type => $arrayType) {
            if($type == "input")
                foreach($arrayType as $arrayData){
                    if($arrayData["type"] == "file")
                        $tmpAuthorisedFormat[] = $arrayData['format'];
                }
        }
        if(empty($tmpAuthorisedFormat)){
            return 0;
        }
        foreach($tmpAuthorisedFormat as $value) {
            $value = strtoupper($value) . " " . strtolower($value);
            $authorisedFormat = explode(' ', $value);
        }

        $_tmpArrayContainer = [];
        $_tmpArrayContainerByInput = [];
        foreach($_file as $inputName => $content){
            foreach($content as $type => $arraysValue)
                foreach($arraysValue as $key => $value)
                    $_tmpArrayContainer[$key][] = [
                        $type => $value
                    ];
            $_tmpArrayContainerByInput[$inputName] = $_tmpArrayContainer;
        }

        $_tmpArrayFormated = [];
        $arrayFiles = [];
        foreach($_tmpArrayContainerByInput as $inputName => $content)
            foreach ($content as $row) {
                foreach ($row as $arrayData)
                    foreach ($arrayData as $type => $value)
                        $_tmpArrayFormated[$type] = $value;
                $arrayFiles[$inputName][] = $_tmpArrayFormated;
            }

        $arrayObject = [];
        foreach($arrayFiles as $inputName => $files){
            foreach($files as $file){
                if(!is_uploaded_file($file["tmp_name"]) ){
                    return [
                        "CODE_ERROR" => 1,
                        "MESSAGE" => "TMP_FILE_IS_NOT_FOUND",
                        "FILE_AFTER_PROCESS" => $files,
                        "FILE_SEND" =>$_file
                    ];
                }
                $fileExtension = strtolower(substr(strrchr($file['name'], '.'),1));
                $fileName = uniqid('file_', false)."_".date("Y-m-d").".".$fileExtension;
                if (in_array($fileExtension, $authorisedFormat) ) {
                    if(!file_exists($directoryDestination)){
                        mkdir($directoryDestination, 0777, true);
                    }
                    if(!move_uploaded_file($file["tmp_name"], $directoryDestination.$fileName) ){
                        return [
                            "CODE_ERROR" => 3,
                            "MESSAGE" => "ERROR_UPLOAD_FILE_IN_FOLDER : ".$directoryDestination,
                            "FILE_AFTER_PROCESS" => $files,
                            "FILE_SEND" => $_file
                        ];
                    }
                    $file = new File();
                    $file->setType(1);
                    $file->setPath($pathDirectory);
                    $file->setName($fileName);
                    $file->setComment($_comment);
                    $file->setTag();
                    $file->save();
                    $arrayObject[] = $file;
                } else {
                    return [
                        'CODE_ERROR' => 2,
                        'MESSAGE' => 'FORBIDEN FORMAT, detected : '.$fileExtension.', expected :'.implode(', ',$authorisedFormat),
                        'FILE_AFTER_PROCESS' => $files,
                        'FILE_SEND' => $_file
                    ];
                }

            }
        }

        $returnArrayObject = [];
        foreach($arrayObject as $file){
            $returnArrayObject[] = $this->getFileByTag($file->getTag());
        }
        return $returnArrayObject;
    }

    public function getFileByTag($_tag)
    {
        $target = [
            "id"
        ];
        $parameter = [
            "LIKE" => [
                "tag" => $_tag
            ]
        ];

        $this->setWhereParameter($parameter);
        $this->getOneData($target);
        return $this->getId();
    }

    public function getFileById($_id)
    {
        $target = [
            "id",
            "path",
            "name",
            "comment",
            "tag",
            "type"
        ];
        $parameter = [
            "LIKE" => [
                "id" => $_id
            ]
        ];

        $this->setWhereParameter($parameter);
        $this->getOneData($target);
        return $this;
    }
}
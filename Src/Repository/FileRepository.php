<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 07/06/2018
 * Time: 00:14
 */

class FileRepository extends File
{
    public function addFile($_file, $_configForm, $_destination, $_comment)
    {
        $directoryDestination = '../..'.DIRNAME.'Tosle/'.ucfirst(strtolower($_destination)).'/';

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

        $returnArrayObject = [];
        foreach($arrayFiles as $inputName => $files){
            foreach($files as $file){
                if(!is_uploaded_file($file["tmp_name"]) ){
                    return $errorMessage["ERROR_UPLOAD"] = [
                        "TMP FILE IS NOT FOUND",
                        $files,
                        $file
                    ];
                }
                $fileExtension = strtolower(substr(strrchr($file['name'], '.'),1));
                $fileName = uniqid('file_', false)."_".date("Y-m-d").".".$fileExtension;
                if (in_array($fileExtension, $authorisedFormat) ) {
                    if(!move_uploaded_file($file["tmp_name"], $directoryDestination.$fileName) ){
                        return $errorMessage["ERROR_UPLOAD"] = [
                            "ERROR UPLOAD FILE IN FOLDER : ".$directoryDestination,
                            $files,
                            $file
                        ];
                    }
                    $file = new File();
                    $file->setType(1);
                    $file->setPath($directoryDestination);
                    $file->setName($fileName);
                    $file->setComment($_comment);
                    $file->setTag();
                    $file->save();
                    $returnArrayObject[] = $file;
                }
            }
        }

        return $returnArrayObject;
    }
}
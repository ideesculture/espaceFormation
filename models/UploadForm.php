<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;
use Yii;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $pdfFile;
    public $uploadedCV;
    public $planFormation;
    public $listeDiplome;


    public function rules()
    {
        return [
            [['pdfFile', 'uploadedCV', 'planFormation'], 'file', 'skipOnEmpty' => true, 'extensions' => ['pdf', 'png', 'jpeg', 'jpg', 'bmp', 'tiff']],
            [['listeDiplome'], 'file', 'skipOnEmpty' => true, 'extensions' => ['pdf', 'png', 'jpeg', 'jpg', 'bmp', 'tiff'], 'maxFiles' => 6, 'maxSize' => 1024 * 1024 * 3],
        ];
    }

    public function upload($folderPath)
    {
        if ($this->validate()) {
            // $timestamp = time();
            // $shortTimestamp = substr($timestamp, -6); // 6 derniers chiffres du timestamp

            if ($this->listeDiplome !== null) {
                foreach ($this->listeDiplome as $file) {
                    $randomPart = substr(uniqid(), -6); // 6 derniers caractères de uniqid()
                    $filePath = $folderPath . '/diplomes/' . $file->baseName . '_' . $randomPart . '.' . $file->extension;
                    $file->saveAs($filePath);
                }
            }

            if ($this->pdfFile !== null) {
                $randomPart = substr(uniqid(), -6);
                $filePath = $folderPath . '/' . $this->pdfFile->baseName . '_' . $randomPart . '.' . $this->pdfFile->extension;
                $this->pdfFile->saveAs($filePath);
            }

            if ($this->uploadedCV !== null) {
                $randomPart = substr(uniqid(), -6);
                $filePath = $folderPath . '/' . $this->uploadedCV->baseName . '_' . $randomPart . '.' . $this->uploadedCV->extension;
                $this->uploadedCV->saveAs($filePath);
            }

            if ($this->planFormation !== null) {
                $randomPart = substr(uniqid(), -6);
                $filePath = $folderPath . '/' . $this->planFormation->baseName . '_' . $randomPart . '.' . $this->planFormation->extension;
                $this->planFormation->saveAs($filePath);
            }
            return true;
        } else {
            return false;
        }
    }
}

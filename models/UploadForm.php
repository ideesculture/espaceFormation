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

            if ($this->listeDiplome !== null) {
                foreach ($this->listeDiplome as $file) {
                    $filePath = $folderPath . '/diplomes/' . $file->baseName . '.' . $file->extension;
                    $file->saveAs($filePath);
                }
            }

            if ($this->pdfFile !== null) {
                $filePath = $folderPath . '/' . $this->pdfFile->baseName . '.' . $this->pdfFile->extension;
                $this->pdfFile->saveAs($filePath);
            }

            if ($this->uploadedCV !== null) {
                $filePath = $folderPath . '/' . $this->uploadedCV->baseName . '.' . $this->uploadedCV->extension;
                $this->uploadedCV->saveAs($filePath);
            }

            if ($this->planFormation !== null) {
                $filePath = $folderPath . '/' . $this->planFormation->baseName . '.' . $this->planFormation->extension;
                $this->planFormation->saveAs($filePath);
            }
            return true;
        } else {
            return false;
        }
    }
}

<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $pdfFile;
    public $uploadedCV;

    public function rules()
    {
        return [
            [['pdfFile', 'uploadedCV'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf'],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $uploadPath = 'uploads/';

            if ($this->pdfFile !== null) {
                $pdfFileName = $this->pdfFile->baseName . '.' . $this->pdfFile->extension;
                $pdfFilePath = $uploadPath . $pdfFileName;
                move_uploaded_file($this->pdfFile->tempName, $pdfFilePath);
            }

            if ($this->uploadedCV !== null) {
                $cvFileName = $this->uploadedCV->baseName . '.' . $this->uploadedCV->extension;
                $cvFilePath = $uploadPath . $cvFileName;
                move_uploaded_file($this->uploadedCV->tempName, $cvFilePath);
            }

            return true;
        } else {
            return false;
        }
    }
}

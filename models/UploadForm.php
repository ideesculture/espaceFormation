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

    public function rules()
    {
        return [
            [['pdfFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'pdf'],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $this->pdfFile->saveAs('uploads/' . $this->pdfFile->baseName . '.' . $this->pdfFile->extension);
            return true;
        } else {
            return false;
        }
    }

    // public function upload()
    // {
    //     if ($this->validate()) {
    //         $pdfFileName = 'pdf_' . time() . '.' . $this->pdfFile->extension;
    //         $pdfFilePath = 'uploads/' . $pdfFileName;

    //         if ($this->pdfFile->saveAs($pdfFilePath)) {
    //             return $pdfFilePath; 
    //         } else {
    //             return false;
    //         }
    //     } else {
    //         return false;
    //     }
    // }
}
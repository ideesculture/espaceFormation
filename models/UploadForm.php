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

    public function rules()
    {
        return [
            [['pdfFile', 'uploadedCV'], 'file', 'skipOnEmpty' => true, 'extensions' => ['pdf', 'png', 'jpeg', 'jpg', 'bmp', 'tiff']],
        ];
    }
    
    public function upload()
    {
            if ($this->validate()) {
                if ($this->pdfFile !== null) {
                    $this->pdfFile->saveAs('uploads/formateurs/' . $this->pdfFile->baseName . '.' . $this->pdfFile->extension);
                }
    
                if ($this->uploadedCV !== null) {
                    $this->uploadedCV->saveAs('uploads/formateurs/' . $this->uploadedCV->baseName . '.' . $this->uploadedCV->extension);
                }
                return true;
            } else {
                return false;
            }
    }
}
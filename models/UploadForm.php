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
            [['listeDiplome'], 'file', 'skipOnEmpty' => true, 'extensions' => ['pdf', 'png', 'jpeg', 'jpg', 'bmp', 'tiff'], 'maxFiles' => 5],
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
                    $this->pdfFile->saveAs($folderPath .'/' . $this->pdfFile->baseName . '.' . $this->pdfFile->extension);
                }
    
                if ($this->uploadedCV !== null) {
                    $this->uploadedCV->saveAs( $folderPath .'/' . $this->uploadedCV->baseName . '.' . $this->uploadedCV->extension);
                }

                if ($this->planFormation !== null) {
                    $this->planFormation->saveAs($folderPath . '/' . $this->planFormation->baseName . '.' . $this->planFormation->extension);
                }
                return true;
            } else {
                return false;
            }
    }
}
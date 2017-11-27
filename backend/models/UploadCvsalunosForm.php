<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;
use app\models\ParserCSV;

class UploadCvsalunosForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $csvAlunosFile;

    public function rules()
    {
        return [
            [['csvAlunosFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'csv', 'checkExtensionByMimeType' => false,
],
        ];
    }

	public function upload()
  {
    if ($this->validate()) {
      $nomeArquivo = 'uploads/alunosCsv.' . $this->csvAlunosFile->extension;
      $this->csvAlunosFile->saveAs($nomeArquivo);
    } else {
      return false;
    }
    return true;
  }

}

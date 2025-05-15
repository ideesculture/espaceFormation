<?php
use yii\widgets\ActiveForm;

 $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'pdfFile')->fileInput() ?>
    <?= $form->field($model, 'uploadedCV')->fileInput() ?>
    <button>Submit</button>

<?php ActiveForm::end() ?>
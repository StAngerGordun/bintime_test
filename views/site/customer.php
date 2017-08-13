<?php
/**
 * Created by PhpStorm.
 * User: ANDREW
 * Date: 09.08.2017
 * Time: 16:41
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Create user';
?>
<?php $form = ActiveForm::begin(array('options' => ['method' => 'post'])); ?>
<?= $form->field($model, 'login') ?>

<?= $form->field($model, 'password')->passwordInput() ?>
<?= $form->field($model, 'name') ?>
<?= $form->field($model, 'surname') ?>
<div class="dropdown">
    <?= $form->field($model, 'gender')->dropDownList(array(1 => "men", 2 => 'woman')) ?>
</div>
<div class="location">
    <h1>Add address</h1>
    <?= $form->field($model, 'geocomplete')->textInput(['class' => 'geocomplete form-control geo', 'placeholder' => 'Type in an address']) ?>
    <fieldset class="details">
        <?= $form->field($model, 'country[]')->
                textInput(['placeholder' => 'Country', 'data-geo' => 'country', 'aria-required' => "true", "aria-invalid" => "false"]) ?>
        <?= $form->field($model, 'country_short[]')->
                textInput(['placeholder' => 'Country code', 'data-geo' => 'country_short', 'aria-required' => "true", "aria-invalid" => "false"]) ?>
        <?= $form->field($model, 'locality[]')->
                textInput(['placeholder' => 'Locality', 'data-geo' => 'locality', 'aria-required' => "true", "aria-invalid" => "false"]) ?>
        <?= $form->field($model, 'street[]')->
                textInput(['placeholder' => 'Street', 'data-geo' => 'route', 'aria-required' => "true", "aria-invalid" => "false"]) ?>
        <?= $form->field($model, 'street_number[]')->
                textInput(['placeholder' => 'Street number', 'data-geo' => 'street_number', 'aria-required' => "true", "aria-invalid" => "false"]) ?>
        <?= $form->field($model, 'office_number[]')->
                textInput(['placeholder' => 'Office number'])?>
        <?= $form->field($model, 'postal_code[]')->
                textInput(['placeholder' => 'Postal code', 'data-geo' => 'postal_code', 'aria-required' => "true", "aria-invalid" => "false"]) ?>
    </fieldset>
</div>
<button type="button" id="new-addr" class="btn btn-link pull-right new-addr">Add another address<span
            class="caret"></span></button>

<div class="form-group">
    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
</div>


<?php ActiveForm::end(); ?>


<?php

use awesome\backend\widgets\AwsBaseHtml;
use yii\widgets\ActiveForm;
use backend\models\Menu;
use kartik\select2\Select2;
use mdm\admin\AutocompleteAsset;
use yii\helpers\Json;
use yii\web\JsExpression;
use yii\web\View;
use kartik\datetime\DateTimePicker;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use xj\uploadify\Uploadify;
use yii\helpers\Url;
use backend\models\Category;

/* @var $this yii\web\View */
/* @var $model backend\models\Menu */
/* @var $title string */
/* @var $form AwsActiveForm */

$menuIcons = Yii::$app->params['menu-icon'];
$dataIcon = [];
foreach ($menuIcons as $icon) {
    $dataIcon[$icon] = $icon;
}
$categoryData = Category::getAllCategory();
$category = $model->getCategory();
//var_dump($categoryData);
//var_dump($category);
//die;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<div class="portlet light portlet-fit portlet-form bordered menu-form">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-paper-plane "></i>
<!--                <span class="caption-subject sbold uppercase">
                </span>-->
        </div>

    </div>
    <div class="portlet-body">
        <div class="form-body">
            <?= $form->field($model, 'NAME')->textInput(['maxlength' => 50]) ?>            
            <?= $form->field($model, 'CODE')->textInput(['maxlength' => 50]) ?>   
            <?= $form->field($model, 'IS_HOT')->checkbox()?>
            <?= $form->field($model, 'PRICE')->textInput(['maxlength' => 50]) ?>            
            <?= $form->field($model, 'MAIN_PRICE')->textInput(['maxlength' => 50]) ?>            
            <?= $form->field($model, 'ADD_DAY')->textInput(['maxlength' => 50]) ?>            
            <?= $form->field($model, 'SHOT_DESCRIPTION')->textInput(['maxlength' => 255]) ?>  
            
            <?= Html::img($model['IMAGE_PATH'], ['width' => '60px']); ?>
            <?= $form->field($model, 'IMAGE_PATH')->fileInput()?> 
            
            <?= Html::img($model['BANNER_PATH'], ['width' => '60px']); ?>
            <?= $form->field($model, 'BANNER_PATH')->fileInput()?> 
            
            
            <?= $form->field($model, 'DESCRIPTION')->widget(CKEditor::className(), [
                    'options' => ['rows' => 10],
                    'preset' => 'basic'
                ]) ?>  
            <?= $form->field($model, 'USE_GUIDELINE')->widget(CKEditor::className(), [
                    'options' => ['rows' => 10],
                    'preset' => 'basic'
                ]) ?>
            <?= $form->field($model, 'STATUS')->dropDownList($model->isNewRecord ? 
                    [
                        0 => "Hủy",
                        1 => "Kích hoạt",
                    ]:
                    [
                        0 => "Hủy",
                        1 => "Kích hoạt",
                        2 => "Đã xử lý",
                    ]
                    )?>      
            <?= $form->field($model, 'END_TIME')->widget(DateTimePicker::classname(), [
        'language' => 'vi',
//        'datetime' => 'dd-MM-yyyy h:i:s',
    ]) ?>      
            <?= $form->field($model, 'NO_MIN_REG') ?>      
            <?= $form->field($model, 'SERVICE_ID') ->dropDownList(\backend\models\Services::getAllService())?>      
            <?= $form->field($model, 'TYPE')->dropDownList(
                    [                       
                        1 => "Dịch vụ",
                        2 => "Item",
                    ])?>      
            <?= $form->field($model, 'IS_RENEW')->checkbox()?>      
            <?= $form->field($model, 'PERIOD')->dropDownList(
                    [                       
                        'ngay' => "Ngày",
                        'tuan' => "Tuần",
                        'thang' => "Tháng",
                    ])?>      
            <?= $form->field($model, 'VAS_SERVICE_ID')->dropDownList(                    
                        $model->getVasService()                   
            ) ?>      
            <?= $form->field($model, 'INVITE_CONTENT')?>      
            <div id="frm_upload_video" class="form-group field-vtvideo-genreTags">
            <div class="row">
                <div class="col-lg-5">
                    Chọn thể loại:
                    <select style="width: 100%" size="15" multiple id="list-avaliable">
                        <?php                        
                        
                        foreach ($categoryData as $id => $item) {
                            if ($category) {                                
                                    if (!$category[$id]) {
                                        echo "<option value='".$id."'>".$item."</option>";
                                        break;
                                    }
                                
                            } else {
                                echo "<option value='".$id."'>".$item."</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-lg-1">
                    <br><br>
                    <a href="javascript:void(0)" id="btn-add-upload-video" class="btn btn-success">&gt;&gt;</a><br>
                    <a href="javascript:void(0)" id="btn-remove-upload-video" class="btn btn-danger">&lt;&lt;</a>
                </div>
                <div class="col-lg-5">
                    Thể loại được chọn: 
                    <select id="list-assigned" multiple size="15" style="width: 100%" name="<?php echo $model->formName(); ?>[CATEGORY][]">
                        <?php
                        foreach ($category as $k=>$item) {
                            $nameGenre = Html::encode($item);
                            echo "<option value='".$k."'>$nameGenre</option>";
                        }
                        ?>
                    </select>
                    <div class="help-block"></div>
                </div>
            </div>            
        </div>  
        </div>
    </div>
    <div class="portlet-title">
        <div class="actions">
            <?= AwsBaseHtml::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => 'btn btn-info  btn-outline btn-circle btn-sm','id' => 'frm-btn-submit']) ?>
            <button type="button" name="back" class="btn btn-transparent black btn-outline btn-circle btn-sm"
                    onclick="history.back(-1);">
                <i class="fa fa-angle-left"></i> Quay lại
            </button>
        </div>
    </div>

</div>

<?php ActiveForm::end(); ?>

<?php
//AutocompleteAsset::register($this);
//$options1 = Json::htmlEncode([
//    'source' => Menu::find()->select(['name'])->column()
//]);
//$this->registerJs("$('#parent_name').autocomplete($options1);");
//
//$options2 = Json::htmlEncode([
//    'source' => Menu::getSavedRoutes()
//]);
//$this->registerJs("$('#route').autocomplete($options2);");
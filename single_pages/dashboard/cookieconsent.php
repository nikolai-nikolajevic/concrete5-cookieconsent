<?php 

use Loader;
use Page;

$app = Concrete\Core\Support\Facade\Application::getFacadeApplication();

$pageSelector = $app->make('helper/form/page_selector');
$color = $app->make('helper/form/color');


defined('C5_EXECUTE') or die("Access Denied.");

// This is the view in the Dashboard

?>

<form method="post" action="<?= $view->action('save'); ?>">
    <?= $token->output('cookieconsent'); ?>
    <div class="row">
        <div class="form-group col-sm-6 col-md-4 col-lg-3">
            <div>
                <?= $form->label('popup-color', t('Popup Color')); ?>
            </div>
            <div>
                <?php $color->output('popup-color', Config::get('cookieconsent.popup-color')); ?>
            </div>
        </div>
        <div class="form-group col-sm-6 col-md-4 col-lg-3">
            <div>
                <?= $form->label('button-color', t('Button Color')); ?>
            </div>
            <div>
                <?php $color->output('button-color', Config::get('cookieconsent.button-color')); ?>
            </div>
        </div>
        <div class="form-group col-sm-6 col-md-4 col-lg-3">
            <?= $form->label('layout', t('Layout')); ?>
            <?= $form->select('layout', array(
                'block' => 'Block', 
                'classic' => 'Classic', 
                'edgeless' => 'Edgeless', 
                'wire' => 'Wire'), 
                Config::get('cookieconsent.layout')); 
            ?>
        </div>
        <div class="form-group col-sm-6 col-md-6 col-lg-3">
            <?= $form->label('position', t('Position')); ?>
            <?= $form->select('position', array(
                'bottom' => 'Banner bottom', 
                'top' => 'Banner Top', 
                'top-static' => 'Banner top (pushdown)', 
                'bottom-left' => 'Floating left', 
                'bottom-right' => 'Floating right'), 
                Config::get('cookieconsent.position')); 
            ?>
        </div>
        <div class="form-group col-sm-6 col-md-6 col-lg-3">
            <?= $form->label('button-text', t('Button Text')); ?>
            <?= $form->text('button-text', Config::get('cookieconsent.button-text')); ?>
        </div>
        <div class="form-group col-sm-6 col-md-6 col-lg-3">
            <?= $form->label('link-text', t('Link Text')); ?>
            <?= $form->text('link-text', Config::get('cookieconsent.link-text')); ?>
        </div>
        <div class="form-group col-sm-6 col-md-6 col-lg-3">
            <?= $form->label('href', t('URL')); ?>
            <?php echo $pageSelector->selectPage('pageID', Config::get('cookieconsent.pageID') )?>
            <?php $form->hidden('href', Config::get('cookieconsent.href')) ?>

        </div>
        <div class="form-group col-sm-12">
            <?= $form->label('text', t('Text')); ?>
            <?= $form->text('text', Config::get('cookieconsent.text')); ?>
        </div>
    </div>
    <div class="ccm-dashboard-form-actions-wrapper">
        <div class="ccm-dashboard-form-actions">
            <?php if(isset($_COOKIE['cookieconsent_status'])): ?>
                <button class="pull-left btn btn-info delete-cookie"><?= t('Delete cookie and show consent'); ?></button>
            <?php endif; ?>
            <button class="pull-right btn btn-success" type="submit"><?= t('Save Settings'); ?></button>
        </div>
    </div>
</form>

<script>
    $('.delete-cookie').click(function (e) {
        e.preventDefault();
        $.cookie("cookieconsent_status", null, { path: '/' });
        location.reload();
    })
</script>
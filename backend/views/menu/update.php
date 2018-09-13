<?php

use yii\helpers\Html;
use \common\models\MenuItem;

/* @var $this yii\web\View */
/* @var $menu common\models\Menu */
/* @var $newItem MenuItem */
/* @var $editItem MenuItem */

\backend\assets\MenuAsset::register($this);
$this->registerJs('Menu.id = ' . $menu->id . ';');

$this->title = 'Изменить меню: ' . ' ' . $menu->name;
$this->params['breadcrumbs'][] = ['label' => 'Меню', 'url' => ['index']];
$this->params['breadcrumbs'][] = $menu->name;

/**
 * @param MenuItem $menuItem
 */
$renderMenuItem = function (MenuItem $menuItem) use (&$renderMenuItem) { ?>
    <li id="menuItem_<?= $menuItem->id; ?>">
        <div <?php if (!$menuItem->active): ?> class="inactive_menu_item"<?php endif; ?>>
            <span class="glyphicon glyphicon-chevron-right"></span>
            <?= $menuItem->title; ?>
            <button class="pull-right glyphicon glyphicon-remove" onclick="Menu.deleteItem(<?= $menuItem->id; ?>);"></button>
            <button class="pull-right glyphicon glyphicon-pencil" data-id="<?= $menuItem->id; ?>" data-title="<?= $menuItem->title; ?>" data-webpage="<?= $menuItem->webpage_id; ?>" data-url="<?= $menuItem->url; ?>" data-active="<?= $menuItem->active; ?>" data-attr="<?= $menuItem->attr; ?>" onclick="Menu.editItem(this);"></button>
        </div>
        <?php if ($menuItem->menuItems): ?>
            <ol>
                <?php foreach ($menuItem->menuItems as $subItem) echo $renderMenuItem($subItem); ?>
            </ol>
        <?php endif; ?>
    </li>
<?php } ?>
<div class="menu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'menu' => $menu,
    ]) ?>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="well">
                <ol class="menu_items">
                    <?php foreach ($menu->menuItems as $menuItem) if (!$menuItem->parent_id) $renderMenuItem($menuItem); ?>
                </ol>
                <hr>
                <button class="btn btn-info" onclick="$('#new_element_form').removeClass('hidden'); $(this).hide();">Добавить новый элемент</button>
                <fieldset <?php if ($newItem->isNewRecord): ?>class="hidden"<?php endif; ?> id="new_element_form">
                    <legend>Добавить новый элемент</legend>
                    <?= $this->render('/menu_item/_form', [
                        'model' => $newItem,
                        'config' => ['action' => '/menu/add-item'],
                    ]); ?>
                </fieldset>
            </div>
        </div>
        <div id="edit_element_form" class="col-xs-12 col-sm-12 col-md-6 <?php if (!isset($editItem)): ?> hidden<?php endif; ?>">
            <?php if (!isset($editItem)) {$editItem = new MenuItem(); $editItem->menu_id = $menu->id;} ?>
            <?= $this->render('/menu_item/_form', [
                'model' => $editItem,
                'config' => ['action' => '/menu/update-item'],
            ]); ?>
        </div>
    </div>
</div>
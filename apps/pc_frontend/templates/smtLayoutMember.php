<?php use_helper('Javascript') ?>
<?php $sf_response->removeStylesheet('/opSkinBasicPlugin/css/main.css') ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
<?php include_http_metas() ?>
<?php include_metas() ?>
<?php include_title() ?>
<?php use_stylesheet('bootstrap') ?>
<?php use_stylesheet('smt_main') ?>
<?php include_stylesheets() ?>
<?php if (Doctrine::getTable('SnsConfig')->get('customizing_css')): ?>
<link rel="stylesheet" type="text/css" href="<?php echo url_for('@customizing_css') ?>" />
<?php endif ?>
<meta name="viewport" content="width=320px,user-scalable=no" />
<?php
$json = array(
  'apiKey' => $sf_user->getMemberApiKey(),
  'apiBase' => app_url_for('api', 'homepage'),
);

echo javascript_tag('
var openpne = '.json_encode($json, defined('JSON_PRETTY_PRINT') ? JSON_PRETTY_PRINT : 0).';
')
?>
<?php use_javascript('jquery.min.js') ?>
<?php use_javascript('jquery.tmpl.min.js') ?>
<?php use_javascript('smt_main') ?>
<?php use_javascript('smt_notify') ?>
<?php use_javascript('smt_tosaka') ?>
<?php use_javascript('smt_menu') ?>
<?php include_javascripts() ?>
</head>
<body id="<?php printf('page_%s_%s', $this->getModuleName(), $this->getActionName()) ?>" class="<?php echo opToolkit::isSecurePage() ? 'secure_page' : 'insecure_page' ?>">
<?php include_partial('global/tosaka') ?>
<div id="face" class="row">
  <?php $member = $sf_response->getDisplayMember() ?>
  <?php if ($member): ?>
  <div class="span2">
    <?php echo op_image_tag_sf_image($member->getImageFileName(), array('size' => '48x48')) ?>
  </div>
  <div class="span8">
    <div class="row face-name"><?php echo $member->getName() ?></div>
    <div class="row screen-name">
      <?php $screenName = $member->getConfig('op_screen_name') ?>
      <?php if ($screenName): ?>
      <a href="#">@<?php echo $screenName ?></a>
      <?php endif ?>
    </div>
  </div>
  <div class="span2 center"><?php echo link_to(op_image_tag('HomeIcon.png', array('height' => '48')), '@homepage') ?></div>
  <?php endif ?>
</div>

<?php if ($sf_user->hasFlash('error')): ?>
<div id="global-error" class="row">
  <div class="alert alert-error">
    <?php echo __($sf_user->getFlash('error')); ?>
  </div>
</div>
<?php endif; ?>

<?php if ($sf_user->hasFlash('notice')): ?>
<div id="global-error" class="row">
  <div class="alert alert-info">
    <?php echo __($sf_user->getFlash('notice')); ?>
  </div>
</div>
<?php endif; ?>

<?php echo $sf_content ?>

<div id="smt-switch" class="row" style="display: none">
<a class="btn info"><?php echo __('View this page on regular style') ?></a>
</div>

</body>
</html>

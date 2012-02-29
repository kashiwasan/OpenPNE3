<!-- MENUFORM TMPL -->
<div class="menuform hide toggle1">
  <div class="row">
    <div class="span10 offset1 center white font14 toggle1_close">
      MENU
    </div>
    <div class="span1">
      <?php echo op_image_tag('UPARROW', array('class' => 'toggle1_close')) ?>
    </div>
  </div>

  <div class="menu-middle row">
    <div class="span11 offset1">
      <?php if ($navs): ?>
      <?php foreach ($navs as $nav): ?>
      <?php if (op_is_accessible_url($nav->uri)): ?>
      <?php echo link_to($nav->caption, $nav->uri, array('class' => 'btn', 'id' => sprintf('smtMenu_%1', op_url_to_id($nav->uri, true)))) ?>
      <?php endif ?>
      <?php endforeach ?>
      <a class="btn info"><?php echo __('View this page on regular style') ?></a>
      <?php endif ?>
    </div>
  </div>
</div>
<!-- MENUFORM TMPL -->

<?php
global $wp;
$links = $variables;
if($links): foreach($links as $link => $link_title ): ?>
<li>
    
    <a href="/<?php echo $link; ?>" class="tf-effect <?php echo ($wp->request === $link) ? 'active' : ''; ?>">
        <span class="dash-titles"><?php echo $link_title; ?></span>
    </a>
</li>
<?php endforeach; endif; ?>
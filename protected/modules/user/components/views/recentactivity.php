<section class="recent-activity">
<h3><a href="#"><?php echo UserModule::t('Recent activity'); ?>:</a></h3>
<aside class="lists">
<?php
if($activity['reply']!='')
{?>
<p><strong><a href="#"><?php echo UserModule::t('New message replies'); ?></a></strong><span>from <?php echo $activity['reply']; ?></span></p>
<?php
}else
{
?>
<p><strong><?php echo UserModule::t('No new message replies'); ?></strong></p>
<?php
}
if($activity['message']!='')
{
?><p><strong><a href="#"><?php echo UserModule::t('New messages'); ?></a></strong><span>from <?php echo $activity['message']; ?></span></p>
<?php
}else
{
?>
<p><strong><?php echo UserModule::t('No New messages'); ?></strong></p>
<?php
}
if($activity['flirt']!=''){?>
<p><strong><a href="#"><?php echo UserModule::t('New flirts'); ?></a></strong><span>from <?php echo $activity['flirt']; ?></span></p>
<?php
}else
{
?>
<p><strong><?php echo UserModule::t('No New flirts'); ?></strong></p>
<?php
}
?>
</aside>
</section>


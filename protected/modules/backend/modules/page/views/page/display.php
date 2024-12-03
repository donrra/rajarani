<?php
Yii::app()->clientScript->registerMetaTag($lo_page->meta_title, 'title');
Yii::app()->clientScript->registerMetaTag($lo_page->meta_keywords, 'keywords');
Yii::app()->clientScript->registerMetaTag($lo_page->meta_discription, 'description');
$this->pageTitle=Yii::app()->name . ' - '.$lo_page->page_title;
$this->breadcrumbs=array(
	$lo_page->page_title,
);
?>
<article class="graybox1">
<section class="graybox1top"></section>
<section class="graybox1bg">
    <div class="contents">
<h3><?php echo $lo_page->page_title?></h3>

<?php echo $lo_page->content?>
</div>
    </section>
    <section class="graybox1bottom"></section>
</article>
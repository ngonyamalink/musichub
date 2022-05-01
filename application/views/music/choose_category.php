<br/>
<?php
echo '<div align="center">
  <div class="panel-heading">Please select the music category.</div>
</div>';
?>

<div  class="container" align="center">
   
    <?php echo form_open_multipart(base_url() . 'music/get_music_by_category', 'class=""'); ?>
<?php

$music_cat = get_musiccategories();


$a_m_c = array();
foreach ($music_cat as $mc) {
    $a_m_c[$mc['musiccategory_id']] = $mc['musiccategory_name'];
}
echo "<br/>";


echo "<div class='form-group'>";
echo form_dropdown('musiccategory_id', $a_m_c, 1, "class='form-control'");

?>
    <br/>
<?php echo "<input type='submit' class='btn btn-primary' name='submit' value='Search' /> "; ?>
<?php echo "<br/>";
echo "</form>";
echo "<br/>";
echo "<br/>"; ?>
    
</div>


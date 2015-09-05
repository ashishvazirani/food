<?php 
$cuisine=Yii::app()->functions->Cuisine(false);
$city=Yii::app()->functions->getCityList();
?>

<div class="browse-wrapper">
  <div class="main">
      <h2 class="uk-h2"><i class="fa fa-bars"></i> Browse by</h2>
      
      <h3><i class="fa fa-map-marker"></i> City</h3>      
      <ul class="list-line">
      <?php if (is_array($city) && count($city)>=1):?>      
      <?php foreach ($city as $val):?>
      <li>
        <a href="<?php echo Yii::app()->request->baseUrl."/store/city/name/".$val['city']; ?>">
       <?php echo $val['city']." ".$val['state'],",".$val['country_code']?>
       </a>
      </li>
      <?php endforeach;?>
      <?php endif;?>
      <div class="clear"></div>
      </ul>
      
    <!--  <h3><i class="fa fa-cutlery"></i> Cuisine</h3>      
      <ul class="list-line">
      <?php if (is_array($cuisine) && count($cuisine)>=1):?>      
      <?php foreach ($cuisine as $val_cuisine):?>
      <li><a href="<?php echo Yii::app()->request->baseUrl."/store/cuisine/type/".$val_cuisine['cuisine_name']; ?>"><?php echo ucwords($val_cuisine['cuisine_name'])?></a></li>
      <?php endforeach;?>
      <?php endif;?>
      <div class="clear"></div>
      </ul>-->
      
  </div>
</div> <!--END browse-wrapper-->
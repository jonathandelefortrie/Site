<?php
function entete($titre,$keywords,$description){
  $conf=getconf();
  if (is_file('../skins/'.$conf["skin"].'/style.css')){
    $pre=("../");
  }else {
    $pre="";
  }
  $toscreen='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="fr" lang="fr" xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <title>';
  $toscreen.=$titre;
  $toscreen.='</title>';
  $toscreen.='<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <!--<link href="'.$pre.'skins/'.$conf["skin"].'/style.css" rel="stylesheet" type="text/css" />-->
  <link href="'.$pre.'skins/'.$conf["skin"].'/validationEngine.jquery.css" rel="stylesheet" type="text/css" />
  <link href="'.$pre.'skins/'.$conf["skin"].'/template.css" rel="stylesheet" type="text/css" />
	<meta name="identifier-url" content="'.$conf["base_url"].'">
	<meta name="robots" content="all">
	<meta name="robots" content="index,follow">
	<meta name="revisit-after" content="7 days">
	<meta name="expires" content="never">
	<meta name="document-type" content="Public">
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="cache-control" content="no-cache, must-revalidate"> 
	<META name="keywords" content="';
  $toscreen.=$keywords.'">';
	$toscreen.='<META name="description"  content="';
  $toscreen.=$description.'">';
  $toscreen.='<link rel="icon" type="image/png" href="'.$pre.'skins/'.$conf["skin"].'/favicon.png">';
  $toscreen.='<SCRIPT language="Javascript" src="'.$pre.'js/jquery.js"></Script>';
  $toscreen.='<SCRIPT language="Javascript" src="'.$pre.'js/jquery.history.js"></Script>';
  $toscreen.='<SCRIPT language="Javascript" src="'.$pre.'js/jquery.validationEngine-'.$_SESSION['dalang'].'.js"></Script>';
  $toscreen.='<SCRIPT language="Javascript" src="'.$pre.'js/jquery.validationEngine.js"></Script>';
  //$toscreen.='<SCRIPT language="Javascript" src="'.$pre.'js/simpleAutoComplete.js"></Script>';
  $toscreen.='<SCRIPT language="Javascript" src="'.$pre.'js/mykescripts.js"></Script>';
  //$toscreen.='<SCRIPT language="Javascript" src="../js/curvycorners.js"></Script>';
  //$toscreen.='<script type="text/javascript">var GB_ROOT_DIR = "../js/greybox/";</script><script type="text/javascript" src="../js/greybox/AJS.js"></script><script type="text/javascript" src="../js/greybox/AJS_fx.js"></script><script type="text/javascript" src="../js/greybox/gb_scripts.js"></script><link href="../js/greybox/gb_styles.css" rel="stylesheet" type="text/css">';
  //$toscreen.='<SCRIPT language="Javascript" src="'.$pre.'js/jquery-ui-1.8.12.custom.min.js"></Script>';
  //if ($_SESSION['dalang']=='fr') $toscreen.='<SCRIPT language="Javascript" src="'.$pre.'js/jquery.ui.datepicker-fr.js"></Script>';
  //$toscreen.='<link type="text/css" href="'.$pre.'skins/'.$conf["skin"].'/jquery-ui-1.8.12.custom.css" rel="stylesheet" />';	
  $toscreen.='</head><body id="dabody" class="mon_body">';
  echo $toscreen;
}
function o_di($id,$class="",$options=false){
  $toscreen ='<div id="';
  $toscreen .=$id;
  $toscreen .='" class="';
  $toscreen .=$class.'" ';
  if ($options) $toscreen .= $options;
  $toscreen .='>';
  echo $toscreen;
}
function c_di(){
  echo '</div>';
}
function o_a($href='',$class='',$onclick='',$id='',$options=''){
  $toscreen ='<a href="';
  $toscreen .=$href;
  $toscreen .='" class="';
  $toscreen .=$class.'" ';
  if ($onclick) $toscreen .= 'onclick="'.$onclick.'"';
  if ($id) $toscreen .= 'id="'.$id.'"';
  if ($options) $toscreen .= $options;
  $toscreen .='>';
  echo $toscreen;
}
function c_a(){
  echo '</a>';
}
function o_spa($class,$id=false,$options=false){
  $toscreen ='<span class="';
  $toscreen .=$class.'" ';
  if ($id) $toscreen .= 'id="'.$id.'"';
  if ($options) $toscreen .= $options;
  $toscreen .='>';
  echo $toscreen;
}
function c_spa(){
  echo '</span>';
}
function im($src,$border=false,$class=false,$width=false,$height=false,$name=false,$id=false,$options=false){
  $toscreen ='<img src="';
  $toscreen .=$src.'"';
  if ($border || $border=='0') $toscreen .= ' border="'.$border.'"';
  if ($class) $toscreen .= ' class="'.$class.'"';
  if ($width) $toscreen .= ' width="'.$width.'"';
  if ($height) $toscreen .= ' height="'.$height.'"';
  if ($name) $toscreen .= ' name="'.$name.'"';
  if ($id) $toscreen .= ' id="'.$id.'"';
  if ($options) $toscreen .= $options;
  $toscreen .='>';
  echo $toscreen;
}
function fin(){
  //echo '<script>var ie4 = (document.all)? true:false;
    //     if(ie4) { window.attachEvent("onload", correctPNG);}</script>';
         
  echo '</body></html>';

}
function open_cadre($titre='',$width=600,$align='left'){
  //désactivation car utilisation du border-radius.htc
 /* if (eregi('msie', $_SERVER['HTTP_USER_AGENT']) || eregi('opera', $_SERVER['HTTP_USER_AGENT'])){
  //version ie et opera
    $conf=getconf();
    $skin=$conf['skin'];
?><TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0" WIDTH="<? echo $width ?>" align="<? echo $align ?>" >
<TR> 
<TD width="5" height="2" align="right" valign="bottom"><IMG SRC="../skins/<? echo $skin; ?>/c_chg.gif"></TD> 
<TD valign="bottom"><IMG SRC="../skins/<? echo $skin;?>/c_ht.gif" WIDTH="100%" height="1"></TD> 
<TD width="5" valign="bottom"><IMG SRC="../skins/<? echo $skin; ?>/c_chd.gif"></TD>

</TR> 
<TR> 
<TD align="right"><IMG SRC="../skins/<? echo $skin;?>/c_btg.gif"></TD> 
<TD BGCOLOR="#032635"><B><FONT SIZE="-2" COLOR="#ffffff">
<? echo ($titre) ?>
</FONT></B></TD> 
<TD><IMG SRC="../skins/<? echo $skin;?>/c_btd.gif"></TD> 
</TR> 
<TR> 
<TD  align="right"><IMG SRC="../skins/<? echo $skin;?>/c_bmg.gif"></TD> 
<TD><IMG SRC="../skins/<? echo $skin;?>/c_bt.gif" WIDTH="100%" height="2"></TD> 
<TD><IMG SRC="../skins/<? echo $skin;?>/c_bmd.gif"></TD> 
</TR> 
<TR> 
<TD BACKGROUND="../skins/<? echo $skin;?>/c_mg.gif"></TD> 
<TD bgcolor="#ffffff"><TABLE CELLPADDING="2" CELLSPACING="2" BORDER="0"><tr><td>
<?
  }else{ */
    //version firefox, konqueror, safari, chrome
    o_di('','cadre_gen','style="width:'.$width.'px;"');
      o_spa('cadre_titre','');
        echo $titre;
      c_spa();
      o_di('','cadre_content');
  //}
}

function close_cadre(){
  //désactivation car utilisation du border-radius.htc
 /*if (eregi('msie', $_SERVER['HTTP_USER_AGENT']) || eregi('opera', $_SERVER['HTTP_USER_AGENT'])){
  //version ie et opera
    $conf=getconf();
    $skin=$conf['skin'];
?>
</td></TR></table></TD> 
<TD BACKGROUND="../skins/<? echo $skin;?>/c_md.gif"></TD>
</TR>
<TR>
<TD  align="right"><IMG SRC="../skins/<? echo $skin;?>/c_cbg.gif"></TD>
<TD><IMG SRC="../skins/<? echo $skin;?>/c_bb.gif" WIDTH="100%"  height="4"></TD>
<TD><IMG SRC="../skins/<? echo $skin;?>/c_cbd.gif"></TD>
</TR> 
</TABLE>
<?
  }else{*/
  //version firefox, konqueror, safari, chrome
    c_di();
  c_di();
  //}
}
function o_tab($id=false,$class=false,$border=0,$width=false,$options=false){
  $toscreen='<table ';
  if ($id) $toscreen.='id="'.$id.'" ';
  if ($class) $toscreen.='class="'.$class.'" ';
  if ($border>0) $toscreen.='border="'.$border.'" ';
  if ($width) $toscreen.='width="'.$width.'" ';
  if ($options) $toscreen.=$options;
  $toscreen .='>';
  echo $toscreen;
}
function c_tab(){
  echo '</table>';
}
function o_tr($id=false,$class=false,$options=false){
  $toscreen='<tr ';
  if ($id) $toscreen.='id="'.$id.'" ';
  if ($class) $toscreen.='class="'.$class.'" ';
  if ($options) $toscreen.=$options;
  $toscreen .='>';
  echo $toscreen;
}
function c_tr(){
  echo '</tr>';
}
function o_td($id=false,$class=false,$options=false){
  $toscreen='<td ';
  if ($id) $toscreen.='id="'.$id.'" ';
  if ($class) $toscreen.='class="'.$class.'" ';
  if ($options) $toscreen.=$options;
  $toscreen .='>';
  echo $toscreen;
}
function c_td(){
  $toscreen='</td>';
  echo $toscreen;
}
function o_form($name,$action,$enctype=false,$onsubmit=false,$class=false,$options=false,$id=false){
  $toscreen='<script>$(document).ready(function(){$("#'.$name.'").validationEngine();});</script>';
  $toscreen.='<form ';
  $toscreen.='name="'.$name.'" ';
  $toscreen.='action="'.$action.'" ';
  if ($enctype) $toscreen.='ENCTYPE="multipart/form-data" ';
  if ($onsubmit) $toscreen.='onsubmit="'.$onsubmit.'" ';
  if ($id) $toscreen.='id="'.$id.'" ';
  else $toscreen.='id="'.$name.'" ';
  if ($class) $toscreen.='class="'.$class.'" ';
  if ($options) $toscreen.=$options;
  $toscreen .='>';
  echo $toscreen;
}
function c_form(){
  echo '</form>';
}
function inp($type,$name,$value=false,$onclick=false,$class=false,$options=false,$id=false){
  if ($type=='ta') $toscreen='<textarea ';
  else {
    $toscreen='<input type="';
    if ($type=='t') $toscreen.='text';
    if ($type=='c') $toscreen.='checkbox';
    if ($type=='r') $toscreen.='radio';
    if ($type=='b') $toscreen.='button';
    if ($type=='h') $toscreen.='hidden';
    if ($type=='f') $toscreen.='file';
    if ($type=='p') $toscreen.='password';
    if ($type=='s') $toscreen.='submit';
    if ($type=='res') $toscreen.='reset';
    $toscreen.='" ';
  }
  $toscreen.='name="'.$name.'" ';
  if ($onclick) $toscreen.='onclick="'.$onclick.'" ';
  if ($id) $toscreen.='id="'.$id.'" ';
  else $toscreen.='id="'.$name.'" ';
  if ($class) {
    if ($class=='SPA_req')$toscreen.='class="validate[required]" ';
    else if ($class=='SPA_tel')$toscreen.='class="validate[required,custom[telephone]]" ';
    else if ($class=='SPA_email')$toscreen.='class="validate[required,custom[email]]" ';
    else if ($class=='SPA_npc')$toscreen.='class="validate[required,custom[noSpecialCaracters]]" ';
    else $toscreen.='class="'.$class.'" ';
  }
  if ($options) $toscreen.=$options.' ';
  if ($value || $value =="0") {
    if ($type!='ta') $toscreen.='value="'.$value.'" ';
    else $toscreen.='>'.$value;
    }else{
      if ($type=='ta') $toscreen.='>';
    }
  if ($type=='ta') $toscreen.='</textarea> ';
  else if ($type!='ta') $toscreen.='>';
  echo $toscreen;
}
function o_sel($name,$onchange=false,$class=false,$options=false,$id=false){
  $toscreen='<select ';
  $toscreen.='name="'.$name.'" ';
  if ($onchange) $toscreen.='onchange="'.$onchange.'" ';
  if ($id) $toscreen.='id="'.$id.'" ';
  else $toscreen.='id="'.$name.'" ';
  if ($class) $toscreen.='class="'.$class.'" ';
  if ($options) $toscreen.=$options;
  $toscreen .='>';
  echo $toscreen;
}
function opt_sel($mention,$value=false,$id=false,$selected=false,$class=false,$options=false){
  $toscreen='<option ';
  if ($id) $toscreen.='id="'.$id.'" ';
  if ($class) $toscreen.='class="'.$class.'" ';
  if ($options) $toscreen.=$options.' ';
  if ($value) $toscreen.='value="'.$value.'" ';
  if ($selected) $toscreen.='selected="selected" ';
  $toscreen.='>'.$mention.'</option>';
  echo $toscreen;
}
function c_sel(){
  echo '</select>';
}
function pt($bla){
  echo ($bla);
}
function rc(){
  echo '<br/>';
}
?>

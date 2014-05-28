<?php function preloader_canvas($sound_path, $images_path, $function_finish) {
if($images_path) {
	$betterArrayImages = Array();
	$tmpArrayImages = get_directory_listing($images_path);
	foreach($tmpArrayImages["file"] as $image) {
		$array_tmp = explode(".",$image["name"]);
		array_pop($array_tmp);
		$nom_case = implode(".",$array_tmp);
		$betterArrayImages[$nom_case] = $image["name"];
	}
}
if($sound_path) {
	$betterArraySounds = Array();
	$tmpArraySounds = get_directory_listing($sound_path);
	foreach($tmpArraySounds["file"] as $sound) {
		$array_tmp = explode(".",$sound["name"]);
		array_pop($array_tmp);
		$nom_case = implode(".",$array_tmp);
		if(strtolower(substr($sound["name"],-4)) == ".ogg") $betterArraySounds[$nom_case] = $sound["name"];
	}
}
$length_array = count($betterArrayImages);
echo "var length_preload = ".$length_array.";\n"; 
?>
var index_preload = 1;

//-------------------- PRELOADER ------------------//
var preloads=new Array(length_preload);
var test_preloads=new Array(length_preload);
function preloader() {
	
	// preload images //
	if (document.images) {
		<?php
		$instance_preload = "";
		$instance_init_preload = "";
		$index = 1;
		foreach($betterArrayImages as $k => $v) {
			$instance_preload .= 'preloads["'.$k.'"]= new Image();';	
			$instance_preload .= 'preloads["'.$k.'"].src="'.$images_path.$v.'";'."\n\t\t";		
			$instance_init_preload .= 'test_preloads['.$index.']=preloads["'.$k.'"];';
			$index ++;
		}
		echo $instance_preload."\n\t\t";
		echo $instance_init_preload."\n";
		?>
	}
	
	// preload sons //
	<?php
	$instance_preload = "";
	foreach($betterArraySounds as $k => $v) {
		$instance_preload .= 'preloads["'.$k.'"]= new Audio();';	
		$instance_preload .= 'preloads["'.$k.'"].src="'.$sound_path.$v.'";'."\n\t\t";		
	}
	echo $instance_preload."\n";
	?>
} 

//------------------ TEST PRELOADER ---------------//
function testpreload() {
	if (test_preloads[index_preload].complete) {
		self.statut = String(index_preload); // IE affiche dans la barre de statut	
		if (index_preload < length_preload) {
			index_preload ++;
			setTimeout('testpreload()',100);
		}
		else <?php echo $function_finish; ?>
	} else setTimeout('testpreload()',100);
}

function preload_site() {
	preloader(); 
	testpreload();
}
<?php } ?>

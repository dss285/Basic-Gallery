<?php
	function galleryModule($galleryDirectory) {
		$lookDirectory = scandir($galleryDirectory); $lookDirectory = array_diff($lookDirectory, array(".", ".."));
		foreach($lookDirectory as $file) {
			$fileSave = $file; $file = $galleryDirectory."/".$file."/";
			if(is_dir($file)) {
				echo "\n<div id='category'><h1>".$fileSave."\n</h1><br>";
				$textCategory = glob($file."*.info.txt"); /* SEARCH CATEGORY TEXT */
				foreach($textCategory as $textCategoryProcessing) {
					$textCategoryProcessed = file_get_contents($textCategoryProcessing);
				}
				echo nl2br($textCategoryProcessed); /* CATEGORY TEXT */
				$lookSubDirectory = scandir($file); /* SCAN FOR GALLERIES */ $lookSubDirectory = array_diff($lookSubDirectory, array(".", "..")); /* REMOVE CURRENT DIRECTORY AND PARENT DIRECTORY */$number = 0;
				foreach($lookSubDirectory as $sub_File) {
					$sub_File_Save = $sub_File; $sub_File = $file.$sub_File;
					$number++;
					if(is_dir($sub_File)) {
							$sub_File = $sub_File."/";
							echo "<h2>".nl2br($sub_File_Save)."</h2>"; echo "\r\n\n<br><BR><button class='unshow'>Show/Unshow Gallery</button>\n\n";							
							echo "\n<div id='gallery' class='".$number."'>\n\n"; echo "<br>\n\n"; $sub_File = glob($sub_File."*.{jpg,png,gif,JPG,PNG,GIF}", GLOB_BRACE);
							foreach($sub_File as $image) 
							{

							$number_class = count($sub_File); $image_text = basename($image).PHP_EOL; $info = pathinfo($image_text);
							$image_text = basename($image_text, '.'.$info['extension']); $image = basename($image).PHP_EOL;
							echo "\n\n<a class='preview'><div id='subDiv'><p><img src='".$galleryDirectory."/image.php?image=".$fileSave."/".$sub_File_Save."/".$image."' class='image' id='image' alt='".$image_text."'><br>".$image_text."</p></div></a>"; 
							}
							echo "\n</div>\n";
					}
				}
				echo "\n</div>\n";
			} 
		}
	}
	?>
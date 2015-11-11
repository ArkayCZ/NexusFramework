<?php

class LayoutManager {
	
	private static $layoutFolders = array();
	private static $layouts = array();	
		
	public static function addLayoutFolder($folder) {
		self::$layoutFolders[] = $folder;
	}
	
	public static function getLayout($layout) {
		if(array_contains($this->layouts, $layout))
			return "Layout not found!";
		
		foreach(self::$layoutFolders as $folder) {
			if(Files::exists($folder . "/" . $layout . ".php"))
				return Files::readString($folder . "/" . $layout . ".php");	
		}
	}
	
	public static function indexLayouts() {
		foreach(self::$layoutFolders as $folder) {
			$layouts = Files::getChildren($folder);
			foreach($layouts as $layout) {
				$this->layouts[] = $layout;
			}
		}
	}
}
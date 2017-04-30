<?php
class DisplayHelper extends AppHelper {
  public function show($text){
  return isset($text);
  }
  public function formatUnit($unit) {
	$Unit = classRegistry::init('Unit');
	return $Unit->formatData($unit);
  }
}
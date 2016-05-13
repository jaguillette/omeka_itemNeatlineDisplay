<?php
if ($neatlineExhibit = metadata('item', array('Neatline Display','Neatline Exhibit'))) {
	if ($neatlineRecord = metadata('item', array('Neatline Display','Neatline Record'))) {
		# neatlineRecord is set
	} else { $neatlineRecord = "";}
}
?>
<div id="item-neatline-display">
	<iframe src="<?php echo url('neatline/fullscreen/'.$neatlineExhibit.'#'.$neatlineRecord); ?>" width="100%" height="500"></iframe>
</div>
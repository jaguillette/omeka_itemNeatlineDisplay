<?php
if ($exhibitId = metadata('item', array('Neatline Display','Neatline Exhibit'))):
	$neatlineExhibit = get_record('NeatlineExhibit',array('id'=>$exhibitId))['slug'];
	if ($neatlineRecord = metadata('item', array('Neatline Display','Neatline Record'))) {
		# neatlineRecord is set
	} else { $neatlineRecord = "";}
?>
<div id="item-neatline-display">
	<iframe src="<?php echo url('neatline/fullscreen/'.$neatlineExhibit.'#records/'.$neatlineRecord); ?>" width="100%" height="500"></iframe>
	<a href="<?php echo url('neatline/fullscreen/'.$neatlineExhibit.'#records/'.$neatlineRecord); ?>">View Fullscreen</a>
</div>
<?php endif ?>

<?php

$recordType = get_class($item);
$elements = get_db()->getTable('Element')->findBySet('Neatline Display');
$filterName = array('ElementSetForm', $recordType, 'Neatline Display');
$elements = apply_filters(
	$filterName,
	$elements,
	array('record_type' => $recordType, 'record' => $item, 'element_set_name' => 'Neatline Display')
);?>

<?php
# Get the parameters for the exhibit select input
$exhibitName = "Elements[".$elements[0]["id"]."][0][text]";
$exhibitValue = metadata('item', array('Neatline Display', 'Neatline Exhibit'));
$exhibitAttributes = array("class"=>"neatline-exhibit");
$exhibitOptions = array(""=>"[None Selected]");
$exhibits = get_records('NeatlineExhibit',array(),999);
foreach ($exhibits as $exhibit) {
	$exhibitOptions += array($exhibit['id'] => $exhibit['title']);
}

# Get the parameters for the record select input
$recordName = "Elements[".$elements[1]["id"]."][0][text]";
$recordValue = metadata('item', array('Neatline Display', 'Neatline Record'));
$recordAttributes = array('class'=>'neatline-exhibit');
$recordOptions = array(""=>"[None Selected]");
# If there is a selected Neatline exhibit, filter records to that exhibit. Otherwise, do not filter.
if ($exhibitValue) {
	$selectedExhibit = get_record('NeatlineExhibit',array('id'=>$exhibitValue));
	$recordFilter = array('exhibit_id'=>$selectedExhibit['id']);
} else {
	$recordFilter = array();
}
# Get the options for the select input.
# Titles default to 'title', then 'item_title', then simply 'id'
$records = get_records('NeatlineRecord',$recordFilter,999);
foreach ($records as $record) {
	if ($record['title'] != "") {
		$recordTitle = $record['title'];
	} elseif ($record['item_title'] != "") {
		$recordTitle = $record['item_title'];
	} else {
		$recordTitle = $record['id'];
	}
	$recordOptions += array($record['id'] => $recordTitle);
}
?>
<p>
	<label for="<?php echo $exhibitName; ?>">Neatline Exhibit: </label>
	<?php echo get_view()->formSelect($exhibitName, $exhibitValue, $exhibitAttributes, $exhibitOptions); ?>
</p>

<p>
	<label for="<?php echo $recordName; ?>">Neatline Record: </label>
	<?php echo get_view()->formSelect($recordName, $recordValue, $recordAttributes, $recordOptions); ?>
</p>

<?php
header('Content-Type: application/json');

if($_GET['action'] === 'get_status'){
	echo json_encode(qiniu_get_pfop_status($_GET['task_id']));
}
elseif($_GET['action'] === 'concat_video'){
	echo json_encode(qiniu_concat_video($_GET['paths']));
}
<?php

$ac = array();
$i = 0;
$count = $activityLike->count();

foreach ($activityLike as $activity)
{
  if ($i<20)
  {
    $list['activity_id'] = $activity->getActivityDataId();
    $list['member'] = op_api_member($activity->getMember());
    $ac[] = $list;
  }
  else
  {
    $rest = $count - $i - 1;
    $list['member']['name'] = '他 '.$rest.'人';
    $ac[] = $list;
    continue;
  }
}

return array(
  'status' => 'success',
  'data' => $ac,
);

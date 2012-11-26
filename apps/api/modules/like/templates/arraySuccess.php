<?php

$ac = array();

foreach ($activityLike as $activity)
{
  $list['activity_id'] = $activity->getActivityDataId();
  $list['member'] = op_api_member($activity->getMember());
  $ac[] = $list;
}

return array(
  'status' => 'success',
  'data' => $ac,
);

<?php

/**
 * like actions.
 *
 * @package    OpenPNE
 * @subpackage like
 * @author     Shouta Kashiwagi <kashiwagi@php.net>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class likeActions extends opJsonApiActions
{
 /**
  * Executes post action
  *
  * @param sfRequest $request A request object
  */
  public function executePost(sfWebRequest $request)
  {
    $activityId = $request['activity_id'];
    $this->forward400Unless(isset($activityId), 'activity_id parameter is required.');
    $memberId = $this->getUser()->getMemberId();
    $builder = opActivityQueryBuilder::create()->setViewerId($memberId); 
    $builder
      ->includeSns()
      ->includeFriends()
      ->includeSelf();
    $query = $builder->buildQuery();
    $query->addWhere('id = ?', $activityId);
    $data = $query->execute();
    if (!$data[0]->getId())
    {
      $this->forward404('This activity data does not exist.');
    }

    $activityLike = Doctrine::getTable('ActivityLike')->findByActivityDataIdAndMemberId($activityId, $memberId);
    if (!$activityLike[0]->getId())
    {
      $activityLike = new ActivityLike();
      $activityLike->setMemberId($memberId);
      $activityLike->setActivityDataId($activityId);
      $activityLike->save();
    }
    else
    {
      $activityLike->delete();
    }
    $activityLike = Doctrine::getTable('ActivityLike')->findByActivityDataId($activityId);
    $count = $activityLike->count();

    return $this->renderJSON(array('status' => 'success', 'data' => array('like_count' => $count)));
  }

  public function executeList(sfWebRequest $request)
  {
    $activityId = $request['activity_id'];
    $this->forward400Unless(isset($activityId), 'activity_id parameter is required.');
    $builder = opActivityQueryBuilder::create()->setViewerId($memberId); 
    $builder
      ->includeSns()
      ->includeFriends()
      ->includeSelf();
    $query = $builder->buildQuery();
    $query->addWhere('id = ?', $activityId);
    $data = $query->execute();
    if (!$data[0]->getId())
    {
      $this->forward404('This activity data does not exist.');
    }
    $this->activityLike = Doctrine::getTable('ActivityLike')->findByActivityDataId($activityId);
     
    $this->setTemplate('array');

  }
}

<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * friend actions.
 *
 * @package    OpenPNE
 * @subpackage friend
 * @author     Kousuke Ebihara <ebihara@tejimaya.com>
 */
class friendActions extends opFriendAction
{
  public function preExecute()
  {
    parent::preExecute();

    if ($this->id == $this->getUser()->getMemberId())
    {
      sfConfig::set('sf_nav_type', 'default');
    }
  }

  public function executeList(sfWebRequest $request)
  {
    $this->forwardIf($request->isSmartphone(), 'friend', 'smtList');

    $this->size = 50;

    return parent::executeList($request);
  }

  public function executeSmtList($request)
  {
    $this->member = Doctrine::getTable('Member')->find($this->id);
    $this->getResponse()->setDisplayMember($this->member);

    return sfView::SUCCESS;
  }

  public function executeLink(opWebRequest $request)
  {
    $this->forwardIf($request->isSmartphone(), 'friend', 'smtLink');

    return parent::executeLink($request);
  }

  public function executeSmtLink(opWebRequest $request)
  {
    $result = parent::executeLink($request);

    $this->getResponse()->setDisplayMember($this->member);

    return $result;
  }
}

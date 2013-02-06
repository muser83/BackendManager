<?php

/**
 * DocsController.php
 * Created on Feb 6, 2013 6:03:39 AM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   license.wittestier.nl
 * @copyright 2013 WitteStier - copyright.wittestier.nl
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    Admin\Doctrine\Helper AS EntityHelper;

/**
 * COMMENTME
 */
class DocsController
    extends AbstractActionController
{

    /**
     * Common action description.
     *
     * @return Zend\View\Model\JsonModel
     */
    public function indexAction()
    {
        $result = new ViewModel();
        $result->setTerminal(true);

        // End.
        return $result;
    }

}
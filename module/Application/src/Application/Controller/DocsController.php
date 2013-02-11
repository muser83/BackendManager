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
    Michelf\Markdown,
    Admin\Doctrine\Helper AS EntityHelper;

/**
 * COMMENTME
 */
class DocsController
    extends AbstractActionController
{

    /**
     * Return the HTML documentation based on the given document id.
     *
     * @return Zend\View\Model\JsonModel
     */
    public function indexAction()
    {
        $params = $this->params();
        $documentId = $params->fromRoute('documentId');
        $mdDocumentation = $this->getMdDocumentation($documentId);
        $htmlDocumentation = Markdown::defaultTransform($mdDocumentation);

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setVariable('htmlDocumentation', $htmlDocumentation);

        // End.
        return $viewModel;
    }

    /**
     * Return the markdown documentation based on the given document id.
     * If the documentation file could not be found the application module
     * doc-not-found.md content will be returned.
     * 
     * @param string $documentId
     */
    private function getMdDocumentation($documentId)
    {
        $unCamelcaseId = strtolower(
            preg_replace('/([A-Z])/', '/$1', (string) $documentId)
        );

        $documentFile = sprintf(
            '%s/../../../../../public/docs/%s.md', __DIR__, $unCamelcaseId
        );

        if (!file_exists($documentFile)) {
            // The requested documentation does not exist.
            // Return the doc-not-found document.
            $documentFile = sprintf(
                '%s/../../../../../public/docs/application/doc-not-found.md', __DIR__
            );
        }

        // Get the markdown source.
        $mdDocumentation = file_get_contents($documentFile);

        // End.
        return $mdDocumentation;
    }

}


<?php

namespace Fucodo\EasyMail\Domain\Finishers;

use Psr\Http\Message\RequestInterface;
use TYPO3\CMS\Core\Site\Entity\Site;
use TYPO3\CMS\Form\Domain\Finishers\Exception\FinisherException;

/**
 * This Finisher Wraps around the Emailfinisher to get rid of faulty settings made by users
 */
class EmailFinisher extends \TYPO3\CMS\Form\Domain\Finishers\EmailFinisher
{
    protected function getEnforcedOptions(): array
    {
        $senderName = $GLOBALS['TYPO3_CONF_VARS']['MAIL']['defaultMailFromName'];

        $site = $this->getRequest()->getAttribute('site');
        if ($site instanceof Site) {
            $senderName = trim($site->getConfiguration()['websiteTitle'] ?? $GLOBALS['TYPO3_CONF_VARS']['MAIL']['defaultMailFromName']);
        }

        return [
            'senderAddress' => $GLOBALS['TYPO3_CONF_VARS']['MAIL']['defaultMailFromAddress'],
            'senderName' => $senderName,
        ];
    }

    /**
     * Executes this finisher
     * @see AbstractFinisher::execute()
     *
     * @throws FinisherException
     */
    protected function executeInternal()
    {
        $this->options = array_replace(
            $this->options,
            $this->getEnforcedOptions()
        );
        parent::executeInternal();
    }

    protected function getRequest(): RequestInterface
    {
        return $GLOBALS['TYPO3_REQUEST'];
    }
}

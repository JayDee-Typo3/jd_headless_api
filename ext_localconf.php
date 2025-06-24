<?php

use JD\JdHeadlessApi\Controller\ApiController;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die('Access denied');

(function () {
    ExtensionUtility::configurePlugin(
        'JdHeadlessApi',
        'Api',
        [
            ApiController::class => 'index'
        ],
        [],
        ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
    );
})();

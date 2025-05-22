<?php

use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\GeneralUtility;

(function(Typo3Version $version) {
    switch ($version->getMajorVersion()) {
        // TYPO3 10 uses a different namespace for the yaml in the formdefinition
        case 10:
            \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptSetup(
                '
                    # Settings for the backend
                    module.tx_form {
                        settings {
                            yamlConfigurations {
                                1747854210 = EXT:form_easy_mail/Configuration/Yaml-10/FormSetup.yaml
                            }
                        }
                    }

                    # settings for the frontend
                    plugin.tx_form {
                        settings {
                            yamlConfigurations {
                                1747854210 = EXT:form_easy_mail/Configuration/Yaml-10/FormSetup.yaml
                            }
                        }
                    }
                '
            );
            break;
        // TYPO3 11 prefixes the  namespace for the yaml in the formdefinition with TYPO3.CMS.Form
        case 11:
        default:
            \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptSetup(
                '
                    # Settings for the backend
                    module.tx_form {
                        settings {
                            yamlConfigurations {
                                1747854211 = EXT:form_easy_mail/Configuration/Yaml-11/FormSetup.yaml
                            }
                        }
                    }

                    # settings for the frontend
                    plugin.tx_form {
                        settings {
                            yamlConfigurations {
                                1747854211 = EXT:form_easy_mail/Configuration/Yaml-11/FormSetup.yaml
                            }
                        }
                    }
                '
            );
    }
})(
    GeneralUtility::makeInstance(Typo3Version::class)
);


<?php

/*
 * 2007-2018 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 *  @author PrestaShop SA <contact@prestashop.com>
 *  @copyright  2007-2018 PrestaShop SA
 *  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */

namespace PrestaShop\Module\AutoUpgrade\TaskRunner\Backup;

use PrestaShop\Module\AutoUpgrade\TaskRunner\AbstractTask;
use PrestaShop\Module\AutoUpgrade\UpgradeContainer;

/**
 * Ends the backup process and displays the success message.
 */
class Backup extends AbstractTask
{
    public function run()
    {
        // Example: V1.6.1.23_20190703-164600-1d09134a
        $backupName = sprintf(
            'V%s_%s-%s',
            $this->container->getProperty(UpgradeContainer::PS_VERSION),
            date('Ymd-His'),
            dechex(mt_rand(0, min(0xffffffff, mt_getrandmax())))
        );
        $this->container->getState()->setBackupName($backupName);

        $this->next = 'backupFiles';
        $this->logger->info(
            $this->translator->trans(
                'Starting backup process. Now backing up files...',
                [],
                'Modules.Autoupgrade.Admin'
        ));
    }
}
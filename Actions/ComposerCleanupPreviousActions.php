<?php
namespace axenox\PackageManager\Actions;

use exface\Core\Interfaces\Actions\iModifyData;
use exface\Core\CommonLogic\AbstractAction;
use axenox\PackageManager\StaticInstaller;
use exface\Core\CommonLogic\Constants\Icons;

/**
 * This action cleans up all remains of previous composer actions if something went wrong.
 * Thus, if composer
 * exits with an exception, the temp downloaded apps do not get installed. This action will install them.
 *
 * @author Andrej Kabachnik
 *        
 */
class ComposerCleanupPreviousActions extends AbstractAction implements iModifyData
{

    /**
     *
     * {@inheritdoc}
     *
     * @see \axenox\PackageManager\Actions\AbstractComposerAction::init()
     */
    protected function init()
    {
        parent::init();
        $this->setIcon(Icons::WRENCH);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \axenox\PackageManager\Actions\AbstractComposerAction::perform()
     */
    protected function perform()
    {
        $installer = new StaticInstaller();
        $result = '';
        $result .= $installer::composerFinishInstall();
        $result .= $installer::composerFinishUpdate();
        $this->setResultMessage($result);
        $this->setResult('');
    }
}
?>
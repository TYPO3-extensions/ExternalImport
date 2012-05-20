<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Francois Suter (typo3@cobweb.ch)
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *  A copy is found in the textfile GPL.txt and important notices to the license
 *  from the author is found in LICENSE.txt distributed with these scripts.
 *
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Controller for the backend module
 *
 * @author		Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package		TYPO3
 * @subpackage	tx_externalimport
 *
 * $Id$
 */
class Tx_ExternalImport_Controller_ListingController extends Tx_Extbase_MVC_Controller_ActionController {
	/**
	 * @var Tx_ExternalImport_Domain_Repository_ConfigurationRepository
	 */
	protected $configurationRepository;

	/**
	 * Injects an instance of the configuration repository
	 *
	 * @param Tx_ExternalImport_Domain_Repository_ConfigurationRepository $configurationRepository
	 * @return void
	 */
	public function injectConfigurationRepository(Tx_ExternalImport_Domain_Repository_ConfigurationRepository $configurationRepository) {
		$this->configurationRepository = $configurationRepository;
	}

	/**
	 * Renders the list of all synchronizable tables
	 *
	 * This is pretty simple as most logic is encapsulated in an ExtJS-powered data grid
	 *
	 * @return void
	 */
	public function syncAction() {
			// If the Scheduler is loaded, check full write access rights
			// (i.e. if user has write-rights to every table with external data)
		if (t3lib_extMgm::isLoaded('scheduler', FALSE)) {
			$globalWriteAccess = $this->configurationRepository->findGlobalWriteAccess();

			// If the Scheduler is not loaded, no sync can be done or defined anyway
		} else {
			$globalWriteAccess = 'none';
		}
		$this->view->assign('globalWriteAccess', $globalWriteAccess);
	}

	/**
	 * Renders the list of all non-synchronizable tables
	 *
	 * This is pretty simple as most logic is encapsulated in an ExtJS-powered data grid
	 *
	 * @return void
	 */
	public function noSyncAction() {
	}
}
?>
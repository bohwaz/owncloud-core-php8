<?php

/**
 * ownCloud
 *
 * @author Paurakh Sharma Humagain <paurakh@jankaritech.com>
 * @copyright Copyright (c) 2018 Paurakh Sharma Humagain paurakh@jankaritech.com
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License,
 * as published by the Free Software Foundation;
 * either version 3 of the License, or any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>
 *
 */

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\MinkExtension\Context\RawMinkContext;
use Page\AdminAppsSettingsPage;

/**
 * WebUI AdminAppsSettings context.
 */
class WebUIAdminAppsSettingsContext extends RawMinkContext implements Context {
	private $adminAppsSettingsPage;
	
	/**
	 *
	 * @var WebUIGeneralContext
	 */
	private $webUIGeneralContext;
	
	/**
	 * WebUIAdminAdminSettingsContext constructor.
	 *
	 * @param AdminAppsSettingsPage $adminAppsSettingsPage
	 */
	public function __construct(
		AdminAppsSettingsPage $adminAppsSettingsPage
	) {
		$this->adminAppsSettingsPage = $adminAppsSettingsPage;
	}

	/**
	 * @When the admin browses to the admin apps settings page
	 * @Given the admin has browsed to the admin apps settings page
	 *
	 * @return void
	 */
	public function theAdminBrowsesToTheAdminAppsSettingsPage() {
		$this->webUIGeneralContext->adminLogsInUsingTheWebUI();
		$this->adminAppsSettingsPage->open();
		$this->adminAppsSettingsPage->waitForAjaxCallsToStartAndFinish(
			$this->getSession()
		);
	}

	/**
	 * @Given the admin has browsed to disabled apps page
	 *
	 * @return void
	 */
	public function theAdminHasBrowsedToDisabledAppsPage() {
		$this->adminAppsSettingsPage->browseToDisabledAppsPage();
		$this->adminAppsSettingsPage->waitForAjaxCallsToStartAndFinish(
			$this->getSession()
		);
	}

	/**
	 * @When the admin disables the app :app using the webUI
	 *
	 * @param string $appName
	 *
	 * @return void
	 */
	public function theAdminDisablesTheAppUsingTheWebUI($appName) {
		$this->adminAppsSettingsPage->disableApp($appName);
		$this->adminAppsSettingsPage->waitForAjaxCallsToStartAndFinish(
			$this->getSession()
		);
	}

	/**
	 * @When the admin enables the app :app using the webUI
	 *
	 * @param string $appName
	 *
	 * @return void
	 */
	public function theAdminEnablesTheAppUsingTheWebui($appName) {
		$this->adminAppsSettingsPage->enableApp($appName);
		$this->adminAppsSettingsPage->waitForAjaxCallsToStartAndFinish(
			$this->getSession()
		);
	}

	/**
	 * This will run before EVERY scenario.
	 * It will set the properties for this object.
	 *
	 * @BeforeScenario @webUI
	 *
	 * @param BeforeScenarioScope $scope
	 *
	 * @return void
	 */
	public function before(BeforeScenarioScope $scope) {
		// Get the environment
		$environment = $scope->getEnvironment();
		// Get all the contexts you need in this context
		$this->webUIGeneralContext = $environment->getContext('WebUIGeneralContext');
	}
}

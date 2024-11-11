<?php

declare(strict_types=1);

/**
 * @copyright Copyright (c) 2021 Paweł Kuffel <pawel@kuffel.io>
 *
 * @author Paweł Kuffel <pawel@kuffel.io>
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 */
namespace OCA\Nexthooks\AppInfo;

use OCA\Nexthooks\Listeners\CalendarObjectCreatedListener;
use OCA\Nexthooks\Listeners\CalendarObjectUpdatedListener;
use OCA\Nexthooks\Listeners\CalendarObjectDeletedListener;
use OCA\Nexthooks\Listeners\CalendarObjectMovedToTrashListener;
use OCA\Nexthooks\Listeners\CalendarObjectRestoredFromTrashListener;
use OCA\Nexthooks\Listeners\UserLiveStatusListener;
use OCA\Nexthooks\Listeners\LoginFailedListener;
use OCA\Nexthooks\Listeners\PasswordUpdatedListener;
use OCA\Nexthooks\Listeners\ShareCreatedListener;
use OCA\Nexthooks\Listeners\UserChangedListener;
use OCA\Nexthooks\Listeners\UserCreatedListener;
use OCA\Nexthooks\Listeners\UserDeletedListener;
use OCA\Nexthooks\Listeners\UserLoggedInListener;
use OCA\Nexthooks\Listeners\UserLoggedOutListener;

use OCA\DAV\Events\CalendarObjectCreatedEvent;
use OCA\DAV\Events\CalendarObjectDeletedEvent;
use OCA\DAV\Events\CalendarObjectMovedToTrashEvent;
use OCA\DAV\Events\CalendarObjectRestoredEvent;
use OCA\DAV\Events\CalendarObjectUpdatedEvent;
use OCA\Nexthooks\Flow\RegisterFlowOperationsListener;
use OCP\Authentication\Events\LoginFailedEvent; 
use OCP\Share\Events\ShareCreatedEvent;
use OCP\User\Events\UserChangedEvent;
use OCP\User\Events\UserCreatedEvent;
use OCP\User\Events\UserDeletedEvent;
use OCP\User\Events\UserLoggedInEvent;
use OCP\User\Events\UserLoggedOutEvent;

use OCP\AppFramework\App;
use OCP\AppFramework\Bootstrap\IBootContext;
use OCP\AppFramework\Bootstrap\IBootstrap;
use OCP\AppFramework\Bootstrap\IRegistrationContext;
use OCP\User\Events\PasswordUpdatedEvent;
use OCP\User\Events\UserLiveStatusEvent;
use OCP\WorkflowEngine\Events\RegisterOperationsEvent;

/**
 * Class Application
 *
 * @package OCA\Nexthooks\AppInfo
 */
class Application extends App implements IBootstrap {

	public function __construct() {
		parent::__construct('nexthooks');
	}

	public function register(IRegistrationContext $context):void {		
		$context->registerEventListener(CalendarObjectCreatedEvent::class, CalendarObjectCreatedListener::class);
		$context->registerEventListener(CalendarObjectUpdatedEvent::class, CalendarObjectUpdatedListener::class);
		$context->registerEventListener(CalendarObjectDeletedEvent::class, CalendarObjectDeletedListener::class);
		$context->registerEventListener(CalendarObjectMovedToTrashEvent::class, CalendarObjectMovedToTrashListener::class);
		$context->registerEventListener(CalendarObjectRestoredEvent::class, CalendarObjectRestoredFromTrashListener::class);
		$context->registerEventListener(LoginFailedEvent::class, LoginFailedListener::class);
		$context->registerEventListener(PasswordUpdatedEvent::class, PasswordUpdatedListener::class);
		$context->registerEventListener(ShareCreatedEvent::class, ShareCreatedListener::class);
		$context->registerEventListener(UserChangedEvent::class, UserChangedListener::class);
		$context->registerEventListener(UserCreatedEvent::class, UserCreatedListener::class);
		$context->registerEventListener(UserDeletedEvent::class, UserDeletedListener::class);
		$context->registerEventListener(UserLiveStatusEvent::class, UserLiveStatusListener::class);
		$context->registerEventListener(UserLoggedInEvent::class, UserLoggedInListener::class);
		$context->registerEventListener(UserLoggedOutEvent::class, UserLoggedOutListener::class);

		$context->registerEventListener(RegisterOperationsEvent::class, RegisterFlowOperationsListener::class);
	}

	public function boot(IBootContext $context): void {}

	public static function getAllConfigNames() {
		return array(
			"Calendar Object Created" => CalendarObjectCreatedListener::CONFIG_NAME,
			"Calendar Object Updated" => CalendarObjectUpdatedListener::CONFIG_NAME,
			"Calendar Object Deleted" => CalendarObjectDeletedListener::CONFIG_NAME,
			"Calendar Object Moved to Trash" => CalendarObjectMovedToTrashListener::CONFIG_NAME,
			"Calendar Object Restored from Trash" => CalendarObjectRestoredFromTrashListener::CONFIG_NAME,
			"Login Failed" => LoginFailedListener::CONFIG_NAME,
			"Password Updated" => PasswordUpdatedListener::CONFIG_NAME,
			"Share Created" => ShareCreatedListener::CONFIG_NAME,
			"User Changed" => UserChangedListener::CONFIG_NAME,
			"User Created" => UserCreatedListener::CONFIG_NAME,
			"User Deleted" => UserDeletedListener::CONFIG_NAME,
			"User Live Status" => UserLiveStatusListener::CONFIG_NAME,
			"User Logged In" => UserLoggedInListener::CONFIG_NAME,
			"User Logged Out" => UserLoggedOutListener::CONFIG_NAME,
		);
	}
}
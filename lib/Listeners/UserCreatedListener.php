<?php

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
namespace OCA\Nexthooks\Listeners;

use OCA\Nexthooks\Utils\DtoExtractor;
use OCP\EventDispatcher\Event;
use OCP\EventDispatcher\IEventListener;
use OCP\User\Events\UserCreatedEvent;

/**
 * Class UserCreatedListener
 *
 * @package OCA\Nexthooks\Listeners
 */
class UserCreatedListener extends AbstractListener implements IEventListener {

	public const CONFIG_NAME = "nexthooks_user_created_url";

	public function handleIncomingEvent(Event $event) {
		if (!($event instanceOf UserCreatedEvent)) {
			return;
		} 

		$user = $event->getUser();

		return array(
			"user" => DtoExtractor::buildUserDto($user),
		);
	}
}
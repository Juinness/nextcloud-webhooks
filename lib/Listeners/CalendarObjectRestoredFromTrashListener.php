<?php

/**
 * @copyright Copyright (c) 2024 Sebastian Sternfeld <sternfeld@gonicus.de>
 *
 * @author Sebastian Sternfeld <sternfeld@gonicus.de>
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

use OCP\EventDispatcher\Event;
use OCP\EventDispatcher\IEventListener;
use OCA\DAV\Events\CalendarObjectRestoredEvent;

/**
 * Class CalendarObjectUpdatedListener
 *
 * @package OCA\Nexthooks\Listeners
 */
class CalendarObjectRestoredFromTrashListener extends AbstractListener implements IEventListener {

	public const CONFIG_NAME = "nexthooks_calendar_object_restore_from_trash_url";

	public function handleIncomingEvent(Event $event) {
		if (!($event instanceOf CalendarObjectRestoredEvent)) {
			return;
		} 

		return array(
			"calendarId" => $event->getCalendarId(),
			"calendarData" => $event->getCalendarData(),
			"shares" => $event->getShares(),
			"objectData" => $event->getObjectData(),
		);
	}
}
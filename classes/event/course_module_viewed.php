<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * The mod_lesson course module viewed event.
 *
 * @package    mod_lanebs
 * @since      Moodle 2.7
 * @copyright  2013 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_lanebs\event;

defined('MOODLE_INTERNAL') || die();

/**
 * The mod_lanebs course module viewed event class.
 *
 * @package    mod_lanebs
 * @since      Moodle 3.7
 * @copyright  2013 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class course_module_viewed extends \core\event\course_module_viewed {

    /**
     * Create instance of event.
     *
     * @since Moodle 3.7
     *
     * @param \stdClass $lanebs
     * @param \context_module $context
     * @return \mod_lanebs\event\course_module_viewed
     */
    public static function create_from_lanebs(\stdClass $lanebs, \context_module $context) {
        $data = array(
            'context' => $context,
            'objectid' => $lanebs->id
        );
        /** @var course_module_viewed $event */
        $event = self::create($data);
        $event->add_record_snapshot('lanebs', $lanebs);
        return $event;
    }

    /**
     * Set basic properties for the event.
     */
    protected function init() {
        $this->data['objecttable'] = 'lanebs';
        $this->data['crud'] = 'r';
        $this->data['edulevel'] = self::LEVEL_PARTICIPATING;
    }

    public static function get_objectid_mapping() {
        return array('db' => 'lanebs', 'restore' => 'lanebs');
    }
}

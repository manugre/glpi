<?php
/**
 * ---------------------------------------------------------------------
 * GLPI - Gestionnaire Libre de Parc Informatique
 * Copyright (C) 2015-2018 Teclib' and contributors.
 *
 * http://glpi-project.org
 *
 * based on GLPI - Gestionnaire Libre de Parc Informatique
 * Copyright (C) 2003-2014 by the INDEPNET Development Team.
 *
 * ---------------------------------------------------------------------
 *
 * LICENSE
 *
 * This file is part of GLPI.
 *
 * GLPI is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * GLPI is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with GLPI. If not, see <http://www.gnu.org/licenses/>.
 * ---------------------------------------------------------------------
 */

if (!defined('GLPI_ROOT')) {
   die("Sorry. You can't access this file directly");
}

/// Location class
class Location extends CommonTreeDropdown {

   use MapGeolocation;

   // From CommonDBTM
   public $dohistory          = true;
   public $can_be_translated  = true;

   static $rightname          = 'location';



   function getAdditionalFields() {

      return [
         [
            'name'  => $this->getForeignKeyField(),
            'label' => __('As child of'),
            'type'  => 'parent',
            'list'  => false
         ], [
            'name'   => 'address',
            'label'  => __('Address'),
            'type'   => 'text',
            'list'   => true
         ], [
            'name'   => 'postcode',
            'label'  => __('Postal code'),
            'type'   => 'text',
            'list'   => true
         ], [
            'name'   => 'town',
            'label'  => __('Town'),
            'type'   => 'text',
            'list'   => true
         ], [
            'name'   => 'state',
            'label'  => _x('location', 'State'),
            'type'   => 'text',
            'list'   => true
         ], [
            'name'   => 'country',
            'label'  => __('Country'),
            'type'   => 'text',
            'list'   => true
         ], [
            'name'  => 'building',
            'label' => __('Building number'),
            'type'  => 'text',
            'list'  => true
         ], [
            'name'  => 'room',
            'label' => __('Room number'),
            'type'  => 'text',
            'list'  => true
         ], [
            'name'   => 'setlocation',
            'type'   => 'setlocation',
            'label'  => __('Location on map'),
            'list'   => false
         ], [
            'name'  => 'latitude',
            'label' => __('Latitude'),
            'type'  => 'text',
            'list'  => true
         ], [
            'name'  => 'longitude',
            'label' => __('Longitude'),
            'type'  => 'text',
            'list'  => true
         ], [
            'name'  => 'altitude',
            'label' => __('Altitude'),
            'type'  => 'text',
            'list'  => true
         ]
      ];
   }


   static function getTypeName($nb = 0) {
      return _n('Location', 'Locations', $nb);
   }


   static public function rawSearchOptionsToAdd() {
      $tab = [];

      $tab[] = [
         'id'                 => '3',
         'table'              => 'glpi_locations',
         'field'              => 'completename',
         'name'               => __('Location'),
         'datatype'           => 'dropdown'
      ];

      $tab[] = [
         'id'                 => '101',
         'table'              => 'glpi_locations',
         'field'              => 'address',
         'name'               => __('Address'),
         'massiveaction'      => false,
         'datatype'           => 'string'
      ];

      $tab[] = [
         'id'                 => '102',
         'table'              => 'glpi_locations',
         'field'              => 'postcode',
         'name'               => __('Postal code'),
         'massiveaction'      => false,
         'datatype'           => 'string'
      ];

      $tab[] = [
         'id'                 => '103',
         'table'              => 'glpi_locations',
         'field'              => 'town',
         'name'               => __('Town'),
         'massiveaction'      => false,
         'datatype'           => 'string'
      ];

      $tab[] = [
         'id'                 => '104',
         'table'              => 'glpi_locations',
         'field'              => 'state',
         'name'               => _x('location', 'State'),
         'massiveaction'      => false,
         'datatype'           => 'string'
      ];

      $tab[] = [
         'id'                 => '105',
         'table'              => 'glpi_locations',
         'field'              => 'country',
         'name'               => __('Country'),
         'massiveaction'      => false,
         'datatype'           => 'string'
      ];

      $tab[] = [
         'id'                 => '91',
         'table'              => 'glpi_locations',
         'field'              => 'building',
         'name'               => __('Building number'),
         'massiveaction'      => false,
         'datatype'           => 'string'
      ];

      $tab[] = [
         'id'                 => '92',
         'table'              => 'glpi_locations',
         'field'              => 'room',
         'name'               => __('Room number'),
         'massiveaction'      => false,
         'datatype'           => 'string'
      ];

      $tab[] = [
         'id'                 => '93',
         'table'              => 'glpi_locations',
         'field'              => 'comment',
         'name'               => __('Location comments'),
         'massiveaction'      => false,
         'datatype'           => 'text'
      ];

      $tab[] = [
         'id'                 => '998',
         'table'              => 'glpi_locations',
         'field'              => 'latitude',
         'name'               => __('Latitude'),
         'massiveaction'      => false,
         'datatype'           => 'text'
      ];

      $tab[] = [
         'id'                 => '999',
         'table'              => 'glpi_locations',
         'field'              => 'longitude',
         'name'               => __('Longitude'),
         'massiveaction'      => false,
         'datatype'           => 'text'
      ];

      return $tab;
   }

   function rawSearchOptions() {
      $tab = parent::rawSearchOptions();

      $tab[] = [
         'id'                 => '11',
         'table'              => 'glpi_locations',
         'field'              => 'building',
         'name'               => __('Building number'),
         'datatype'           => 'text',
         'autocomplete'       => true,
      ];

      $tab[] = [
         'id'                 => '12',
         'table'              => 'glpi_locations',
         'field'              => 'room',
         'name'               => __('Room number'),
         'datatype'           => 'text',
         'autocomplete'       => true,
      ];

      $tab[] = [
         'id'                 => '15',
         'table'              => 'glpi_locations',
         'field'              => 'address',
         'name'               => __('Address'),
         'massiveaction'      => false,
         'datatype'           => 'string'
      ];

      $tab[] = [
         'id'                 => '17',
         'table'              => 'glpi_locations',
         'field'              => 'postcode',
         'name'               => __('Postal code'),
         'massiveaction'      => true,
         'datatype'           => 'string'
      ];

      $tab[] = [
         'id'                 => '18',
         'table'              => 'glpi_locations',
         'field'              => 'town',
         'name'               => __('Town'),
         'massiveaction'      => true,
         'datatype'           => 'string'
      ];

      $tab[] = [
         'id'                 => '21',
         'table'              => 'glpi_locations',
         'field'              => 'latitude',
         'name'               => __('Latitude'),
         'massiveaction'      => false,
         'datatype'           => 'string',
         'autocomplete'       => true,
      ];

      $tab[] = [
         'id'                 => '20',
         'table'              => 'glpi_locations',
         'field'              => 'longitude',
         'name'               => __('Longitude'),
         'massiveaction'      => false,
         'datatype'           => 'string',
         'autocomplete'       => true,
      ];

      $tab[] = [
         'id'                 => '22',
         'table'              => 'glpi_locations',
         'field'              => 'altitude',
         'name'               => __('Altitude'),
         'massiveaction'      => false,
         'datatype'           => 'string',
         'autocomplete'       => true,
      ];

      $tab[] = [
         'id'                 => '101',
         'table'              => 'glpi_locations',
         'field'              => 'address',
         'name'               => __('Address'),
         'datatype'           => 'string',
         'autocomplete'       => true,
      ];

      $tab[] = [
         'id'                 => '102',
         'table'              => 'glpi_locations',
         'field'              => 'postcode',
         'name'               => __('Postal code'),
         'datatype'           => 'string',
         'autocomplete'       => true,
      ];

      $tab[] = [
         'id'                 => '103',
         'table'              => 'glpi_locations',
         'field'              => 'town',
         'name'               => __('Town'),
         'datatype'           => 'string',
         'autocomplete'       => true,
      ];

      $tab[] = [
         'id'                 => '104',
         'table'              => 'glpi_locations',
         'field'              => 'state',
         'name'               => _x('location', 'State'),
         'datatype'           => 'string',
         'autocomplete'       => true,
      ];

      $tab[] = [
         'id'                 => '105',
         'table'              => 'glpi_locations',
         'field'              => 'country',
         'name'               => __('Country'),
         'datatype'           => 'string',
         'autocomplete'       => true,
      ];

      return $tab;
   }


   function defineTabs($options = []) {

      $ong = parent::defineTabs($options);
      $this->addStandardTab('Netpoint', $ong, $options);
      $this->addStandardTab('Document_Item', $ong, $options);
      $this->addStandardTab(__CLASS__, $ong, $options);

      return $ong;
   }


   function cleanDBonPurge() {

      Rule::cleanForItemAction($this);
      Rule::cleanForItemCriteria($this, 'users_locations');
   }


   /**
    * @since 0.85
    *
    * @see CommonTreeDropdown::getTabNameForItem()
   **/
   function getTabNameForItem(CommonGLPI $item, $withtemplate = 0) {

      if (!$withtemplate) {
         switch ($item->getType()) {
            case __CLASS__ :
               $ong    = [];
               $ong[1] = $this->getTypeName(Session::getPluralNumber());
               $ong[2] = _n('Item', 'Items', Session::getPluralNumber());
               return $ong;
         }
      }
      return '';
   }


   /**
    * @since 0.85
   **/
   static function displayTabContentForItem(CommonGLPI $item, $tabnum = 1, $withtemplate = 0) {

      if ($item->getType() == __CLASS__) {
         switch ($tabnum) {
            case 1 :
               $item->showChildren();
               break;
            case 2 :
               $item->showItems();
               break;
         }
      }
      return true;
   }


   /**
    * Print the HTML array of items for a location
    *
    * @since 0.85
    *
    * @return void
   **/
   function showItems() {
      global $DB, $CFG_GLPI;

      $locations_id = $this->fields['id'];
      $itemtype     = Session::getSavedOption(__CLASS__, 'criterion', '');

      if (!$this->can($locations_id, READ)) {
         return false;
      }

      $queries = [];
      $itemtypes = $itemtype ? [$itemtype] : $CFG_GLPI['location_types'];
      foreach ($itemtypes as $itemtype) {
         $table = getTableForItemType($itemtype);
         $itemtype_criteria = [
            'SELECT' => [
               "$table.id",
               new \QueryExpression($DB->quoteValue($itemtype) . ' AS ' . $DB->quoteName('type')),
            ],
            'FROM'   => $table,
            'WHERE'  => [
               "$table.locations_id"   => $locations_id,
            ] + getEntitiesRestrictCriteria($table, 'entities_id')
         ];
         $item = new $itemtype();
         if ($item->maybeDeleted()) {
            $itemtype_criteria['WHERE']['is_deleted'] = 0;
         }
         $queries[] = $itemtype_criteria;
      }
      $criteria = count($queries) === 1 ? $queries[0] : ['FROM' => new \QueryUnion($queries)];

      $start  = (isset($_REQUEST['start']) ? intval($_REQUEST['start']) : 0);
      $criteria['START'] = $start;
      $criteria['LIMIT'] = $_SESSION['glpilist_limit'];

      $iterator = $DB->request($criteria);
      $number = count($iterator);;
      if ($start >= $number) {
         $start = 0;
      }
      // Mini Search engine
      echo "<table class='tab_cadre_fixe'>";
      echo "<tr class='tab_bg_1'><th colspan='2'>".__('Type')."</th></tr>";
      echo "<tr class='tab_bg_1'><td class='center'>";
      echo __('Type')."&nbsp;";
      Dropdown::showItemType($CFG_GLPI['location_types'],
                             ['value'      => $itemtype,
                                   'on_change'  => 'reloadTab("start=0&criterion="+this.value)']);
      echo "</td></tr></table>";

      if ($number) {
         echo "<div class='spaced'>";
         Html::printAjaxPager('', $start, $number);

         echo "<table class='tab_cadre_fixe'>";
         echo "<tr><th>".__('Type')."</th>";
         echo "<th>".__('Entity')."</th>";
         echo "<th>".__('Name')."</th>";
         echo "<th>".__('Serial number')."</th>";
         echo "<th>".__('Inventory number')."</th>";
         echo "</tr>";

         while ($data = $iterator->next()) {
            $item = getItemForItemtype($data['type']);
            $item->getFromDB($data['id']);
            echo "<tr class='tab_bg_1'><td class='center top'>".$item->getTypeName()."</td>";
            echo "<td class='center'>".Dropdown::getDropdownName("glpi_entities",
                                                                 $item->getEntityID());
            echo "</td><td class='center'>".$item->getLink()."</td>";
            echo "<td class='center'>".
                  (isset($item->fields["serial"])? "".$item->fields["serial"]."" :"-");
            echo "</td>";
            echo "<td class='center'>".
                  (isset($item->fields["otherserial"])? "".$item->fields["otherserial"]."" :"-");
            echo "</td></tr>";
         }
      } else {
         echo "<p class='center b'>".__('No item found')."</p>";
      }
      echo "</table></div>";

   }

   function displaySpecificTypeField($ID, $field = []) {
      switch ($field['type']) {
         case 'setlocation':
            $this->showMap();
            break;
         default:
            throw new \RuntimeException("Unknown {$field['type']}");
      }
   }
}

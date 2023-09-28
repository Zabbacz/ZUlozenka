<?php
defined('_JEXEC') or die('Restricted access');
?>
<select name="ulozenka_pobocky" id="ulozenka_pobocky" class="inputbox" style="min-width: 200px;">
<option><?=JText::_('VMSHIPMENT_ZULOZENKA_SELECT_BRANCH') ?></option>
<?php 
$services = array('ulozenka', 'ulozenka_partner', 'ulozenka_parcelshop');
$services = "'".implode("','",$services ) . "'";
$db = JFactory::getDbo();
$query  = $db->getQuery(true)
                ->select($db->quotename(array('name', 'branch_id')))
                ->from($db->quotename('#__ulozenka_branches'))
                ->where($db->quotename('state')." LIKE ". $db->quote("CZE"))
                ->where($db->quotename('active')." = ".  $db->quote('1'))
                ->where($db->quotename('transport_service_alias')." IN (".$services.")")
                ->order($db->quotename('name').'ASC');
$db->setQuery($query);
$result = $db->loadObjectList();

 foreach ($result as $ppp)
 {
    $pobocka = str_replace('"','',$ppp->name);
         $option = '<option ';
        $option .= 'value="'.$ppp->branch_id.'">'.$pobocka.'</option>';
        echo $option;
 }
 ?>
</select>
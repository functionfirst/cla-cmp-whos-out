<?php
/**
 * A quick component to display who is in/out
 *
 * Component currently take no attributes
 */
class HpWhoOutComponent extends TemplaterComponentTmpl
{
	public function Show($attributes)
	{
		$args = array();
		HpViewWhosOut::Draw($args);
		$args['everyone_in.visible'] = true;
		foreach ($args['day_types.datasrc'] as $k=>&$ar)
		{
			if (count($ar['users_list.datasrc']) > 0)
			{
				foreach ($ar['users_list.datasrc'] as &$v)
				{
					$v['user_href.title'] = $ar['day_type_name.body'];
				}
				$ar['day_type.visible'] = true;
				$args['everyone_in.visible'] = false;
				break;
			}
		}
		$day = date('w');
		if ($args['everyone_in.visible'] == true && ($day == 0 || $day == 6))
		{
			$args['everyone_in.body'] = 'Everyone\'s in today! But then it is a ' . ($day == 0 ? 'Sunday' : 'Saturday') . '...';
		}
		return $this->CallTemplater('holidays/who_out_component.html', $args);
	}
}
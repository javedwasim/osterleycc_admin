<?php

class Address
{
	public $street_address_1;
	public $street_address_2;
	public $city_name;
	public $postal_code;
	public $subdivision_name;
	public $country_name;
	
	//creating dynamic properties
	
	//protected methods
	
	protected $_address_id;
	protected $_time_created;
	protected $_time_updated;
	protected $_postal_code;
	
	function __get($name)
	{
		if(!$this->_postal_code)
		{
			$this->_postal_code = $this->_postal_code_guess();
		}
	
	//Atempt to return to protected property name
	
	$protected_property_name = '_'.$name;
	if(property_exists($this, $protected_property_name))
	{
		return $this->$protected_property_name;
	}
	
	trigger_error('Undefined Property via __get:', $name);
	return NULL;
	
	}
	protected function _postal_code_guess()
	{
		return 'Lookup';
	}	
	
	function __set($name, $value)
	{
		if('postal_code'==$name)
		{
			$this->$name = $value;
			return ;
		}
		
		trigger_error('Undefined or unallowable property __set:', $name);
	}

	
	function display()
	{
		$output = '';
		$output .= $this->street_address_1;
		if($this->street_address_2)
		{
			$output .= '<br/>' . $this->street_address_2;
		}
		$output .= '<br/>'. $this->city_name .'&nbsp; ,'. $this->postal_code;
		$output .= '<br/>'. $this->subdivision_name;
		$output .= '<br/>'. $this->country_name;
		return $output;
	}
}

$addr = new Address;
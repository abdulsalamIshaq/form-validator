<?php
declare(strict_types = 1);

namespace FormValidator;

class Form 
{
	public $fields;
	public $errors = [];	
	protected $method;

	public function __construct($request_method) 
	{
		$this->method = $request_method;
	}
	
	public function input(string $field)
	{
		return strip_tags(trim($this->method[$field]));
	}

	public function validate(array $fields)
	{
		if(is_array($fields))
		{
			foreach ($fields as $key => $value) 
			{
				//echo "<pre>";
				//echo $key;
				$input = $this->input($key);
				$rules = explode('|', $value);
				//print_r($rules);
				if(in_array('required', $rules))
				{
					if(empty($input)) 
					{
						if(!isset($this->errors[$key])) 
							$this->errors[$key] = $key . ' field is required';
					}
				}
				if(in_array('string', $rules)) 
				{
					if(!filter_var($input, FILTER_SANITIZE_STRING)) 
					{
						if(!isset($this->errors[$key])) 
							$this->errors[$key] = $key . ' is not a valid string';
					}
				}

				if(in_array('email', $rules)) 
				{
					if(!filter_var($input, FILTER_VALIDATE_EMAIL)) 
					{
						if(!isset($this->errors[$key])) 
							$this->errors[$key] = $key . ' is not a valid email';
					}
				}

				if(in_array('numeric', $rules)) 
				{
					if(!is_numeric($input)) 
					{
						if(!isset($this->errors[$key])) 
							$this->errors[$key] = $key . ' is not a valid number';
					}

				}

				if(in_array('int', $rules)) 
				{
					if(!filter_var($input, FILTER_VALIDATE_INT)) 
					{
						if(!isset($this->errors[$key])) 
							$this->errors[$key] = $key . ' is not a valid integer';
					}
				}

				if(in_array('float', $rules)) 
				{
					if(!filter_var($input, FILTER_VALIDATE_FLOAT)) 
					{
						if(!isset($this->errors[$key])) 
							$this->errors[$key] = $key . ' is not a valid float';
					}
				}

				if(in_array('ip', $rules)) 
				{
					if(!filter_var($input, FILTER_VALIDATE_IP)) 
					{
						if(!isset($this->errors[$key])) 
							$this->errors[$key] = $key . ' is not a valid IP address';
					}
				}

				if(in_array('url', $rules))
				{
					if(!filter_var($input, FILTER_VALIDATE_URL)) 
					{
						if(!isset($this->errors[$key])) 
							$this->errors[$key] = $key . ' is not a valid url';
					}
				}

				if(in_array('min', $rules)) 
				{
					$index = array_search('min', $rules);
					$index_value = $index + 1;
					$min_value = $rules[$index_value];
					if(strlen($input) < $min_value) 
					{
						if(!isset($this->errors[$key])) 
							$this->errors[$key] = $key . ' minimum value is ' . $min_value;
					}
				}
				if(in_array('max', $rules)) 
				{
					$index = array_search('max', $rules);
					$index_value = $index + 1;
					$min_value = $rules[$index_value];
					if(strlen($input) > $min_value) 
					{
						if(!isset($this->errors[$key])) 
							$this->errors[$key] = $key . ' maximum value is ' . $min_value;
					}
				}
				
			} 
		}
	}

	public function passed() 
	{
		if(empty($this->errors))
		{
			return true;
		} else {
			return false;
		}
	}
}
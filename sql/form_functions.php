<?php
	// this is a behind the scenes php doc that will hold all functions for form elements
	
	//first we create a function for the label element on a form
	function formLabel($label,$for="")
	{
		return "\r\n<label" . (!empty($for) ? " for=\"$for\"" : "") . ">$label</label>";
	}
	
	//creating a function that enables us to create text boxes
	function textBox($name,$value="",$maxlength=30,$size=30)
	{
		return "\r\n<input type=\"text\" name=\"$name\" id=\"$name\" size=\"$size\" maxlength=\"$maxlength\" value=\"$value\">";
	}
        function textBoxFunction($name,$value="",$onchange="",$maxlength=30,$size=30)
	{
		return "\r\n<input type=\"text\" name=\"$name\" id=\"$name\" size=\"$size\" maxlength=\"$maxlength\" value=\"$value\"  onchange=\"$onchange\">";
	}
        function textBoxFunctionReadonly($name,$value="",$onchange="",$maxlength=30,$size=30,$readonly="readonly")
	{
		return "\r\n<input type=\"text\" name=\"$name\" id=\"$name\" size=\"$size\" maxlength=\"$maxlength\" value=\"$value\"  onchange=\"$onchange\" $readonly>";
	}
	function textBoxRequired($name,$value="",$maxlength=30,$size=30)
	{
		return "\r\n<input type=\"text\" name=\"$name\" id=\"$name\" size=\"$size\" maxlength=\"$maxlength\" value=\"$value\", required>";
	}
        //creating a function that enables us to create text boxes that are readonly
	function textBoxreadonly($name,$value="",$maxlength=30,$size=30,$readonly="readonly")
	{
		return "\r\n<input type=\"text\" name=\"$name\" id=\"$name\" size=\"$size\" maxlength=\"$maxlength\" value=\"$value\" $readonly>";
	}
        
	//creating a function that enables us to create password boxes
	function password($name,$maxlength=30,$size=30)
	{
		return "\r\n<input type=\"password\" name=\"$name\" id=\"$name\" size=\"$size\" maxlength=\"$maxlength\">";
	}
	
	//creating a function for a textarea
	function textArea($name,$value="",$rows=5,$cols=24)
	{
		return "\r\n<textarea name=\"$name\" id=\"$name\" rows=\"$rows\" cols=\"$cols\">$value</textarea>";
	}
        function textAreaRequired($name,$value="",$rows=5,$cols=24)
	{
		return "\r\n<textarea name=\"$name\" id=\"$name\" rows=\"$rows\" cols=\"$cols\" required>$value</textarea>";
	}
	
	//creating a function for a checkBox
	function checkBox($name,$value,$label)
	{
		return "\r\n<input type=\"checkbox\" name=\"$name\" id=\"$name\" value=\"$value\">$label";
	}

	//function for a hidden field
	function hidden($name,$value)
	{
		return "\r\n<input type=\"hidden\" name=\"$name\" value=\"$value\">";
	}
	
	//function for a dropdown list
	function select($name,$options,$value="")
	{
		$output="\r\n<select name=\"$name\">";
		foreach ($options as $option)
		{
			$output.="\r\n<option value=\"{$option["value"]}\"";
			if ($value==$option["value"])
			{
				$output.=" selected";
			}
			$output.=">{$option["name"]}</option>";
		}
		$output.="\r\n</select>";
		return $output;
	}
        
	//function for a submit button
	function submit($value)
	{
		return "\r\n<input type=\"submit\" value=\"$value\">";
	}
	

?>
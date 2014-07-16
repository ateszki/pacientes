<?php namespace Extensions;

class CustomCollection extends \Illuminate\Database\Eloquent\Collection {
    // define custom methods here, for example
	public function toArrayFechas()
		{
			return array_map(function($value)
			{
			return $value instanceof ArrayableInterface ? $value->toArrayFechas() : $value->toArrayFechas();
			}, $this->items);
		}
}


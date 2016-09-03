<?php
/**
 * ハート
 */
class Heart extends Card {
	/**
	 * コンストラクタ
	 * @param int $number 数字
	 */
	public function __construct($number) {
		parent::__construct("H", $number);
	}
}
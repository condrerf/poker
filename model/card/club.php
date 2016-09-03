<?php
/**
 * クラブ
 */
class Club extends Card {
	/**
	 * コンストラクタ
	 * @param int $number 数字
	 */
	public function __construct($number) {
		parent::__construct("C", $number);
	}
}
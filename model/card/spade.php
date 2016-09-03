<?php
/**
 * スペード
 */
class Spade extends Card {
	/**
	 * コンストラクタ
	 * @param int $number 数字
	 */
	public function __construct($number) {
		parent::__construct("S", $number);
	}
}
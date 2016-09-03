<?php
/**
 * ハイカード
 */
class HighCards extends Hand {
	/**
	 * コンストラクタ
	 */
	public function __construct() {
		parent::__construct("ハイカード", 9);
	}

	/**
	 * 指定されたカードが役を満たしているかどうかを返す
	 * @param array $card_array カード配列
	 * @return true:満たしている false:満たしていない
	 */
	public function isValid(array $card_array) {
		// 当関数が呼ばれることはないはず
		return true;
	}
}
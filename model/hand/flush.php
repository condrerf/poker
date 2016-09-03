<?php
/**
 * フラッシュ
 */
class Flush extends Hand {
	/**
	 * コンストラクタ
	 */
	public function __construct() {
		parent::__construct("フラッシュ", 4);
	}

	/**
	 * 指定されたカードが役を満たしているかどうかを返す
	 * @param array $card_array カード配列
	 * @return true:満たしている false:満たしていない
	 */
	public function isValid(array $card_array) {
		if (count($card_array) != 5) {
			return false;
		}

		// 同じスートのカード5枚で構成されている場合
		$count_array = parent::createSuitCountArray($card_array);
		foreach ($count_array as $count) {
			if ($count == 5) {
				return true;
			}
		}

		return false;
	}
}
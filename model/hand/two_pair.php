<?php
/**
 * ツーペア
 */
class TwoPair extends Hand {
	/**
	 * コンストラクタ
	 */
	public function __construct() {
		parent::__construct("ツーペア", 7);
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

		// 同じ数の2枚組を2組と他のカード1枚で構成されている場合
		$two_count_number_count = 0;
		$count_array = parent::createNumberCountArray($card_array);
		foreach ($count_array as $count) {
			if ($count == 2) {
				$two_count_number_count++;
			}
		}

		$is_valid = ($two_count_number_count == 2);
		return $is_valid;
	}
}
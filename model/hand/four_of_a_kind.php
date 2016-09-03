<?php
/**
 * フォー・オブ・ア・カインド
 */
class FourOfAKind extends Hand {
	/**
	 * コンストラクタ
	 */
	public function __construct() {
		parent::__construct("フォー・オブ・ア・カインド", 2);
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

		// 同じ数字のカードが4枚含まれる場合
		$four_count_number_count = 0;
		$count_array = parent::createNumberCountArray($card_array);
		foreach ($count_array as $count) {
			if ($count == 4) {
				$four_count_number_count++;
			}
		}

		$is_valid = ($four_count_number_count == 1);
		return $is_valid;
	}
}
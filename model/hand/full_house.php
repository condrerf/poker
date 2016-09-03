<?php
/**
 * フルハウス
 */
class FullHouse extends Hand {
	/**
	 * コンストラクタ
	 */
	public function __construct() {
		parent::__construct("フルハウス", 3);
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

		// 同じ数字のカード3枚と、別の同じ数字のカード2枚で構成されている場合
		$three_count_number_count = 0;
		$two_count_number_count = 0;
		$count_array = parent::createNumberCountArray($card_array);
		foreach ($count_array as $count) {
			if ($count == 3) {
				$three_count_number_count++;
			} else if ($count == 2) {
				$two_count_number_count++;
			}
		}

		$is_valid = ($three_count_number_count == 1 && $two_count_number_count == 1);
		return $is_valid;
	}
}
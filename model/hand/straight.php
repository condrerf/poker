<?php
/**
 * ストレート
 */
class Straight extends Hand {
	/**
	 * コンストラクタ
	 */
	public function __construct() {
		parent::__construct("ストレート", 5);
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

		// 数字が連続した5枚のカードによって構成されている場合
		$is_valid = false;
		$valid_number_count = 0;
		$is_ace_valid = false;
		$count_array = parent::createNumberCountArray($card_array);
		foreach ($count_array as $index => $count) {
			if ($count == 1) {
				$valid_number_count++;
				if ($valid_number_count == 5) {
					$is_valid = true;
					break;
				}
				if ($index == 0) {
					$is_ace_valid = true;
				}
			} else {
				if ($valid_number_count > 0) {
					break;
				}
			}
		}
		if (!$is_valid && $is_ace_valid) {
			// Aが入っている場合は10～Kがあれば有効
			if ($count_array[9] == 1 && $count_array[10] == 1 && $count_array[11] == 1 && $count_array[12] == 1) {
				$is_valid = true;
			}
		}

		return $is_valid;
	}
}
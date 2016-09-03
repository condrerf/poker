<?php
/**
 * ストレート・フラッシュ
 */
class StraightFlush extends Hand {
	/**
	 * コンストラクタ
	 */
	public function __construct() {
		parent::__construct("ストレート・フラッシュ", 1);
	}

	/**
	 * 指定されたカードが役を満たしているかどうかを返す
	 * @param array $card_array カード配列
	 * @return true:満たしている false:満たしていない
	 */
	public function isValid(array $card_array) {
		// 同じスートで数字が連続する5枚のカードで構成されている場合
		$straight = new Straight();
		$is_staright = $straight->isValid($card_array);
		$flush = new Flush();
		$is_flush = $flush->isValid($card_array);

		return ($is_staright && $is_flush);
	}
}
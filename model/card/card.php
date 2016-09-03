<?php
/**
 * カード基底クラス
 */
abstract class Card {
	/** スート配列 */
	private static $suit_array = array("S", "H", "D", "C");

	/** スート */
	private $suit;

	/** 数字 */
	private $number;

	/**
	 * コンストラクタ
	 * @param string $suit スート
	 * @param int $number 数字
	 */
	public function __construct($suit, $number) {
		$this->suit = $suit;
		$this->number = $number;
	}

	/**
	 * スート配列を返す
	 */
	public static function getSuitArray() {
		return self::$suit_array;
	}

	/**
	 * スートを返す
	 */
	public function getSuit() {
		return $this->suit;
	}

	/**
	 * 数字を返す
	 */
	public function getNumber() {
		return $this->number;
	}

	/**
	 * シンボル(スートと数字の組み合わせ)を返す
	 */
	public function getSymbol() {
		return "{$this->suit}{$this->number}";
	}

	/**
	 * 自身が妥当なカードかどうかを返す
	 * @return boolean true:妥当 false:妥当でない
	 */
	public function isValid() {
		if (!in_array($this->suit, self::$suit_array)) {
			return false;
		}

		if ($this->number < 1 || $this->number > 13) {
			return false;
		}

		return true;
	}

	/**
	 * 指定されたシンボルに該当するカードインスタンスを生成する
	 * @param string $symbol シンボル
	 * @return NULL|Spade|Heart|Diamond|Club
	 */
	public static function create($symbol) {
		if (!preg_match("/^([SHDC])(\d{1,2})$/", $symbol, $elements)) {
			return null;
		}
		$suit = $elements[1];
		$number = $elements[2];

		$card = null;
		switch ($suit) {
			case "S":
				$card = new Spade($number);
				break;
			case "H":
				$card = new Heart($number);
				break;
			case "D":
				$card = new Diamond($number);
				break;
			case "C":
				$card = new Club($number);
				break;
		}
		if (!$card->isValid()) {
			return null;
		}

		return $card;
	}
}
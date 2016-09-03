<?php
/**
 * 役基底クラス
 */
abstract class Hand {
	/** 役名 */
	private $name;

	/** 優先度 */
	private $priority;

	/**
	 * コンストラクタ
	 * @param string $name 役名
	 * @param int $priority 優先度
	 */
	public function __construct($name, $priority) {
		$this->name = $name;
		$this->priority = $priority;
	}

	/**
	 * 役名を返す
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * 優先度を返す
	 */
	public function getPriority() {
		return $this->priority;
	}

	/**
	 * 指定されたカードが役を満たしているかどうかを返す
	 * @param array $card_array カード配列
	 * @return true:満たしている false:満たしていない
	 */
	public abstract function isValid(array $card_array);

	/**
	 * 指定されたカードを解析し、スート別に枚数を集計した配列を返す
	 * @param array $card_array カード配列
	 * @return スート別の枚数集計配列
	 */
	protected function createSuitCountArray(array $card_array) {
		$count_array = array();
		foreach (Card::getSuitArray() as $suit) {
			$count_array[$suit] = 0;
		}
		foreach ($card_array as $card) {
			if ($card instanceof Card && $card->isValid()) {
				$count_array[$card->getSuit()]++;
			}
		}

		return $count_array;
	}

	/**
	 * 指定されたカードを解析し、番号別に枚数を集計した配列を返す
	 * @param array $card_array カード配列
	 * @return 番号別の枚数集計配列
	 */
	protected function createNumberCountArray(array $card_array) {
		$count_array = array_fill(0, 13, 0);
		foreach ($card_array as $card) {
			if ($card instanceof Card && $card->isValid()) {
				$count_array[$card->getNumber() - 1]++;
			}
		}

		return $count_array;
	}

	/**
	 * 指定されたカードに該当する役を返す
	 * @param array $card_array カード配列
	 * @return 役
	 */
	public static function find(array $card_array) {
		if (count($card_array) != 5) {
			return null;
		}

		$straight_flush = new StraightFlush();
		if ($straight_flush->isValid($card_array)) {
			return $straight_flush;
		}

		$four_of_a_kind = new FourOfAKind();
		if ($four_of_a_kind->isValid($card_array)) {
			return $four_of_a_kind;
		}

		$full_house = new FullHouse();
		if ($full_house->isValid($card_array)) {
			return $full_house;
		}

		$flush = new Flush();
		if ($flush->isValid($card_array)) {
			return $flush;
		}

		$straight = new Straight();
		if ($straight->isValid($card_array)) {
			return $straight;
		}

		$three_of_a_kind = new ThreeOfAKind();
		if ($three_of_a_kind->isValid($card_array)) {
			return $three_of_a_kind;
		}

		$two_pair = new TwoPair();
		if ($two_pair->isValid($card_array)) {
			return $two_pair;
		}

		$one_pair = new OnePair();
		if ($one_pair->isValid($card_array)) {
			return $one_pair;
		}

		// 該当する役がなかったらハイカード
		$high_cards = new HighCards();
		return $high_cards;
	}
}